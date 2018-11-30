<?php

namespace app\controllers;

use Yii;
use app\models\Prestamo;
use app\models\PrestamoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Prestado;
use app\models\Persona;

/**
 * PrestamoController implements the CRUD actions for Prestamo model.
 */
class PrestamoController extends Controller
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
     * Lists all Prestamo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrestamoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    
/*        $model = Prestamo::find()->all();
        return $this->render('index', [
            'model' => $model]);*/
    }

    /**
     * Displays a single Prestamo model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Prestamo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Prestamo;
        $model2 = new Prestado;
             $model->ENCA_PRE=5;

        if (($model->load(Yii::$app->request->post()))&&
            ($model2->load(Yii::$app->request->post()))) {
            
            $model->save(false); // skip validation as model is already validated
            $model2->PRES_PRS = $model->ID_PRE; // no need for validation rule on user_id as you set it yourself
            $model2->save(false); 
            
            return $this->redirect(['view', 'id' => $model->ID_PRE]);
        } else {
            return $this->render('create', [
                'model' => $model,'model2'=>$model2,
            ]);
        }
    }

    public function action____Create()
    {

        $model = new Prestamo();
        $model2 = new Prestado();
             $model->ENCA_PRE=5;
        $arti=null;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // echo '<pre>'; print_r($model);echo '</pre>';
             //$arti = UploadedFile::getInstance($model, 'ARTICULO');
             //$model2->ARTI_PRS = $arti->ARTICULO;
             $model2->PRES_PRS = $model->ID_PRE;
             echo '<pre>'; print_r($model);echo'</pre>';
             echo '<pre>'; print_r($model2);exit;echo'</pre>';
             $model2->save();
            return $this->redirect(['view', 'id' => $model->ID_PRE]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model2'=> $model2,
            ]);
        }
    }

    /**
     * Updates an existing Prestamo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_PRE]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Prestamo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Prestamo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Prestamo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prestamo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

