<?php

namespace app\controllers;

use Yii;
use app\models\RequisicaoMaterial;
use app\models\RequisicaoMaterialSearch;
use app\models\Material;
use app\models\MaterialSearch;
use app\models\Requisicao;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequisicaoMaterialController implements the CRUD actions for RequisicaoMaterial model.
 */
class RequisicaoMaterialController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ]
        ];
    }

    /**
     * Lists all RequisicaoMaterial models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequisicaoMaterialSearch();
        
        $session = Yii::$app->session;
        $id_requisicao = $session['id_requisicao'];
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['requisicao_id' => $id_requisicao]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RequisicaoMaterial model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RequisicaoMaterial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RequisicaoMaterial();
        $session = Yii::$app->session;
        $id_requisicao = $session['id_requisicao'];
        $model->requisicao_id = $id_requisicao;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create']);
        }

        # Carrega materiais
        $searchModel = new RequisicaoMaterialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['requisicao_id' => $model->requisicao_id]);

        $idsJaSelecionados = RequisicaoMaterial::find()->where(['requisicao_id' => $model->requisicao_id])->select(['material_id']);
        $materiaisDisponiveis = Material::find()->where(['not in','id',$idsJaSelecionados])->all();

        return $this->render('create', [
            'model' => $model,
            'materiais' => $dataProvider,
            'materiaisDisponiveis' => $materiaisDisponiveis
        ]);
    }

    /**
     * Updates an existing RequisicaoMaterial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $session = Yii::$app->session;
        $id_requisicao = $session['id_requisicao'];
        $model->requisicao_id = $id_requisicao;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

         # Carrega materiais
         $searchModel = new RequisicaoMaterialSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $dataProvider->query->where(['requisicao_id' => $model->requisicao_id]);
 
         $materiaisDisponiveis = Material::find()->all();
 
         return $this->render('create', [
             'model' => $model,
             'materiais' => $dataProvider,
             'materiaisDisponiveis' => $materiaisDisponiveis
         ]);
    }

    /**
     * Deletes an existing RequisicaoMaterial model.
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
     * Finds the RequisicaoMaterial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequisicaoMaterial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequisicaoMaterial::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
