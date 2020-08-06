<?php

namespace app\controllers;

use Yii;
use app\models\Requisicao;
use app\models\RequisicaoSearch;
use app\models\RequisicaoMaterialSearch;
use app\models\Expurgo;
use app\models\ExpurgoMaterial;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\MyFormatter;
use app\models\RequisicaoMaterial;
use yii\helpers\Url;
use yii\web\Session;
use yii\db\Expression;
use yii\db\Query;

/**
 * RequisicaoController implements the CRUD actions for Requisicao model.
 */
class RequisicaoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Requisicao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequisicaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Requisicao model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new RequisicaoMaterialSearch();
                
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['requisicao_id' => $id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'materiais' => $dataProvider
        ]);
    }

    /**
     * Creates a new Requisicao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Requisicao();
        date_default_timezone_set('America/Sao_Paulo');
        $model->data = date("d/m/yy H:i");
        $model->status = 'Coleta';
        $model->tipo = 'Coleta';

        if ($model->load(Yii::$app->request->post())) {
            $model->data = MyFormatter::convert($model->data, 'datetime');
            if ($model->save()) {
                $session = Yii::$app->session;
                $session['id_requisicao'] = $model->id;
                $url = Url::to(['/requisicao-material/create']);
                return $this->redirect($url);
            } 
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Requisicao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = Requisicao::findOne($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Requisicao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Requisicao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Requisicao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Requisicao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionMateriais($id)
    {
        $session = Yii::$app->session;
        $session['id_requisicao'] = $id;
        $url = Url::to(['/requisicao-material/index']);
        return $this->redirect($url);
    }

    public function actionDistribuicao($id)
    {
        $modelOrigem = $this->findModel($id);
        
        $model = new Requisicao;
        $model->tipo = 'Distribuicao';
        $model->unidadeid = $modelOrigem->unidadeid;
        $model->status = 'Distribuicao';

        date_default_timezone_set('America/Sao_Paulo');
        $model->data = date("d/m/yy H:i");

        $model->data = MyFormatter::convert($model->data, 'datetime');
        $model->oldAttributes = null;
        
        if ($model->save()) {
            $session = Yii::$app->session;
            $session['id_requisicao'] = $model->id;

            #Carrega todos materiais da requisição original
            $result = new \yii\db\Query();
            $result->select(['rm.material_id','rm.quantidade'])
                ->from('requisicao_material rm')
                ->where(['rm.requisicao_id'=>$id])
                ->all();
                
            $command = $result->createCommand();
            $data = $command->queryAll();
            
            foreach ($data as $row) {
                $quantidade = $row['quantidade'];
                $material_id = $row['material_id'];
                
                $requisicaoMaterial = new RequisicaoMaterial;
                $requisicaoMaterial->requisicao_id = $model->id;
                $requisicaoMaterial->material_id = $material_id;
                $requisicaoMaterial->quantidade = $quantidade;

                if(!$requisicaoMaterial->save()){
                    var_dump($requisicaoMaterial->getErrors());
                    return;
                }
            }
            $url = Url::to(['/requisicao/view?id=$id']);
            return $this->redirect($url);
        }

        var_dump($model->getErrors());
    }

    /**
     * Creates a new Requisicao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateExpurgo()
    {
        # Primeiro executa a query pra verificar se existe alguma requisição de coleta
        $result = new \yii\db\Query();
        $result->select(['rm.material_id','SUM(rm.quantidade) AS quantidade'])
               ->from('requisicao r')
               ->where(['r.status'=>'Coleta'])
               ->innerJoin('requisicao_material rm','r.id = rm.requisicao_id')
               ->groupBy(['rm.material_id'])
               ->all();
               
        $command = $result->createCommand();
        $data = $command->queryAll();

        if (count($data)==0){
            Yii::$app->session->setFlash('error','Não foi possível criar expurgo pois não há requisições com status [Coleta].');
            return $this->actionIndex();
        }
        

        $expurgo = new Expurgo;
        date_default_timezone_set('America/Sao_Paulo');
        
        $expurgo->data = date("d/m/yy H:i");
        $expurgo->data = MyFormatter::convert($expurgo->data, 'datetime');
        $expurgo->status = 'Expurgo';
        
        if(!$expurgo->save()){
            var_dump($expurgo->getErrors());
        }

        foreach ($data as $row) {
            $quantidade = $row['quantidade'];
            $material_id = $row['material_id'];
            
            $expurgoMaterial = new ExpurgoMaterial;
            $expurgoMaterial->expurgo_id = $expurgo->id;
            $expurgoMaterial->material_id = $material_id;
            $expurgoMaterial->quantidade = $quantidade;

            if(!$expurgoMaterial->save()){
                var_dump($expurgoMaterial->getErrors());
                return;
            }
            //$id = $row['id'];
        }

        #Atualiza as requisições
        Yii::$app->db->createCommand("UPDATE requisicao SET status = 'Expurgo' WHERE status = 'Coleta'")->execute();

        $url = Url::to(['/requisicao']);
        return $this->redirect($url);
    }
}
