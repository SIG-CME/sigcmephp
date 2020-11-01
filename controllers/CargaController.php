<?php

namespace app\controllers;

use Yii;
use app\models\Carga;
use app\models\CargaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ExpurgoMaterialSearch;
use app\components\MyFormatter;

/**
 * CargaController implements the CRUD actions for Carga model.
 */
class CargaController extends Controller
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
     * Lists all Carga models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CargaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Carga model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new ExpurgoMaterialSearch();
                
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['carga_id' => $id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'materiais' => $dataProvider
        ]);
    }

    /**
     * Creates a new Carga model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Carga();
        date_default_timezone_set('America/Sao_Paulo');
        $model->data = date("yy/m/d H:i");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->data = MyFormatter::convert($model->data, 'datetime');
            #Atualiza as requisições
            Yii::$app->db->createCommand("UPDATE expurgo_material SET carga_id = $model->id WHERE carga_id is null and material_id in (select id from material where categoriaid = $model->categoriaid);")->execute();

            Yii::$app->db->createCommand("UPDATE requisicao SET status = 'Processada' WHERE status = 'Expurgo' AND expurgo_id > 0 AND expurgo_id not in (SELECT expurgo_id FROM expurgo_material WHERE carga_id IS NULL) ")->execute();
            
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Carga model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Carga model.
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
     * Finds the Carga model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Carga the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Carga::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
