<?php

namespace app\controllers;

use Yii;
use app\models\Ambiente;
use app\models\AmbienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AmbienteController implements the CRUD actions for Ambiente model.
 */
class AmbienteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ambiente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AmbienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ambiente model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Ambiente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ambiente();

        if ($model->load(Yii::$app->request->post())) {
            $model_piso=\app\models\Piso::find()->where(['or',["NOMB_PIS"=>$model->NOMB_PISO], ["ID_PIS"=>$model->NOMB_PISO]])->one();
            if($model_piso==null) {
                $model_piso = new \app\models\Piso();
                $model_piso->NOMB_PIS = $model->NOMB_PISO;
                $model_piso->save();
            }
            $model->PISO_AMB = $model_piso->ID_PIS;
            // echo '<pre>';
            //     print_r($model);
            // echo '</pre>';exit;
            if (!$model->save()){
                echo '<pre>';
                    print_r($model->getErrors());
                echo '</pre>';exit;
            }
            return $this->redirect(['view', 'id' => $model->ID_AMB]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ambiente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model_piso=\app\models\Piso::find()->where(['or',["NOMB_PIS"=>$model->NOMB_PISO], ["ID_PIS"=>$model->NOMB_PISO]])->one();
            if($model_piso==null) {
                $model_piso = new \app\models\Piso();
                $model_piso->NOMB_PIS = $model->NOMB_PISO;
                $model_piso->save();
            }
            $model->PISO_AMB = $model_piso->ID_PIS;
            // echo '<pre>';
            //     print_r($model);
            // echo '</pre>';exit;
            if (!$model->save()){
                echo '<pre>';
                    print_r($model->getErrors());
                echo '</pre>';exit;
            }
            return $this->redirect(['view', 'id' => $model->ID_AMB]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ambiente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {       
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Ambiente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ambiente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ambiente::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
