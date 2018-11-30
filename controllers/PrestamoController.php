<?php

namespace app\controllers;

use Yii;
use app\models\Prestamo;
use app\models\PrestamoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Prestado;
use app\models\PrestadoSearch;

use app\models\Articulo;
use app\models\ArticuloSearch;

use app\models\Persona;
use app\models\PersonaSearch;

use yii\data\ActiveDataProvider;

use yii\helpers\ArrayHelper;

/**
 * PrestamoController implements the CRUD actions for Prestamo model.
 */
class PrestamoController extends Controller
{
    /**
     * @inheritdoc
     */

    public function actionVolver()
    {
        $this->goBack();
    }

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
//        $sql = "(SELECT *  FROM [prestamo] INNER JOIN [persona] WHERE [PERS_PRE]=[ID_PER]";

        //$totalCount = \Yii::$app->db->createCommand("SELECT COUNT(*) FROM $sql AS [c]")->queryScalar();

        //$query = Prestamo::find();

        // $dataProvider = new ActiveDataProvider([
        //     'query'         => $query,
        //     'pagination'    => [
        //         'pageSize'  => 5
        //     ],
        //     'sort' => [
        //         'defaultOrder' => ['FECH_PRE' => SORT_ASC, 'HORA_PRE' => SORT_ASC]
        //     ]
        // ]);

        // return $this->render('index', [
        //     'dataProvider' => $dataProvider, 
        // ]);
    }

    /**
     * Displays a single Prestamo model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $query = Prestado::find()
        ->where(['PRES_PRS'=>$id]);
        $dataProvider = new ActiveDataProvider(['query'=>$query]);
        return $this->render('view', [
            'model' => $this->findModel($id), 'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Prestamo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatep()
    {
        $modelp = new Persona();
        if ($modelp->load(Yii::$app->request->post()) && $modelp->save()) {
            echo "<script>alert('Registro almacenado con éxito')</script>";
        } else {
            return $this->render('create', ['modelp' => $modelp]);
        }
    }
    function tart($arti)
    {
        $tipo=null;
        $tarti = \app\models\Accesorio::find()
        ->where(['ARTI_ACC' => $arti])
        ->one();
        if ($tarti != null) {
            $tipo='accesorio';
        } else {
            $tarti = \app\models\Computadora::find()->where(['ARTI_COM' => $arti])->one();
            if ($tarti != null) {
                $tipo='computadora';
            } else {
                $tarti = \app\models\Monitor::find()->where(['ARTI_MON' => $arti])->one();
                if ($tarti != null) {
                    $tipo='monitor';
                } else {
                    $tarti = \app\models\Mouse::find()->where(['ARTI_MOU' => $arti])->one();
                    if ($tarti != null) {
                        $tipo='mouse';
                    } else {
                        $tarti = \app\models\Parlante::find()->where(['ARTI_PAR' => $arti])->one();
                        if ($tarti != null) {
                            $tipo='parlante';
                        } else {
                            $tarti = \app\models\Teclado::find()->where(['ARTI_TEC' => $arti])->one();
                            if ($tarti != null) {
                                $tipo='teclado';
                            } else {
                                $tarti = \app\models\Varios::find()->where(['ARTI_VAR' => $arti])->one();
                                if ($tarti != null) {
                                    $tipo='varios';
                                }
                            }
                        }
                    }
                }
            }
        }
        return $tipo;
    }

    public function actionCreate()
    {
        $model = new Prestamo();
        $modelp = new Persona();
        if (count(Prestamo::Articulos())==0) {
            /*echo count($articulos);*/
            return $this->render('not-disp');
        }
        else {
            if ($modelp->load(Yii::$app->request->post()) && $modelp->save()) {
                /*echo '
                        <script>
                                alert("Registro almacenado con éxito");
                        </script>
                '
                ;*/
                $personas = ArrayHelper::map(\app\models\Persona::find()->all(), 'ID_PER', 'Nombrecompleto');
                $model->PERS_PRE=$modelp->ID_PER;
            }
            if ($model->load(Yii::$app->request->post()) 
                    
                ) {
                $usuario = Yii::$app->user->identity->username;

                $modelx = \app\models\User::find()->where(['username'=>$usuario])->one();

                $model->ENCA_PRE = $modelx->id;

                // echo '<pre>';
                //     print_r($model->ENCA_PRE);
                // echo '<pre>';exit;


                if(!$model->validate()){
                                echo '<pre>';
                                    print_r($model->getErrors());
                                echo '<pre>';exit;
                } else {
                    $model->save();
                }
                if($model->articulo!==null){
                    foreach ($model->articulo as $arti) {
                        if($arti!=null) {
                            $tarti = new Prestado();
                            //$model3 = new Articulo();
                            $tarti->ARTI_PRS = $arti;
                            $tarti->PRES_PRS = $model->ID_PRE;
                            if ($tarti->validate()) {
                                $tarti->save();
                            } else { echo ' no se guardo ';}
                            $model3 = Articulo::findOne($arti);
                            $model3->DISP_ART=1;
                            $tipo=$this->tart($arti);
                            $model3->tipo_art = $tipo;
                            if ($model3->validate()) {
                                $model3->save();
                            } else {echo ' error <br>';
                                echo '<pre>';
                                print_r($model3);
                                echo '</pre>';
                                echo '<pre>';
                                print_r($model3->getErrors());
                                echo '</pre>';exit;
                            }
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->ID_PRE]);
            } else {
                return $this->render('create', [
                                            'model'=>$model,
                                            'modelp' => $modelp
                                ]);
            }
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
        $modelp = new Persona();
        $personas = ArrayHelper::map(\app\models\Persona::find()->all(), 'ID_PER', 'Nombrecompleto');
        $ambientes = ArrayHelper::map(\app\models\Ambiente::find()->all(), 'ID_AMB', 'NOMB_AMB');
        $artdbo = Yii::$app->db->createCommand('SELECT ID_ART, DETA_ART, DISP_ART, CONCAT(DETA_ART, " => SN: " ,SERI_ART) AS Detallado FROM articulo WHERE (DISP_ART=0) OR (ID_ART IN (SELECT ARTI_PRS FROM prestado WHERE PRES_PRS='.$model->ID_PRE.'))')->queryAll();
        $articulos = ArrayHelper::map($artdbo, 'ID_ART', 'Detallado');
        //$art_actual=Prestado::find()->where(['PRES_PRS'=>$id])->one()->ARTI_PRS;
        $mprestado=Prestado::find()->where(['PRES_PRS'=>$id])->all();
        foreach ($mprestado as $item) {
            $art_actual[]=$item->ARTI_PRS;
        }
        if ($modelp->load(Yii::$app->request->post()) && $modelp->save()) {
            /*echo '
                    <script>
                            alert("Registro almacenado con éxito");
                    </script>
            '
            ;*/
            $personas = ArrayHelper::map(\app\models\Persona::find()->all(), 'ID_PER', 'Nombrecompleto');
            $model->PERS_PRE=$modelp->ID_PER;
        }
        
        if ($model->load(Yii::$app->request->post())) {

            #PRUEBA DE ACTUALIZACION DE ARTICULOS PRESTADOS

            // echo '<pre>';
            // echo '<strong>ARTICULOS ANTERIORES</strong><br>';
            // print_r($art_actual);
            // echo '<pre>';

            // echo '<pre>';
            // echo '<strong>ARTICULOS NUEVOS</strong><br>';
            // print_r($model->articulo);
            // echo '<pre>';

            // exit;

            $model->save();
            // pregunta si cambio el articulo
            if ($art_actual!=$model->articulo) { 
                //actualizar DISPOSICION ARTICULO
                foreach ($art_actual as $arti_act) {
                    $model2 = new Articulo();
                    $model2 = Articulo::findOne($arti_act);
                    if ($model2!==NULL) {
                        $model2->DISP_ART=0;
                        $model2->tipo_art=$this->tart($model2->ID_ART);
                        $model2->validate();
                        $model2->save();
                    Prestado::deleteAll(['ARTI_PRS'=>$model2->ID_ART, 'PRES_PRS'=>$model->ID_PRE]);
                    }
                }
                foreach ($model->articulo as $arti_new) {
                    $model2 = Articulo::findOne($arti_new);
                    $model2->DISP_ART=1;
                    $model2->tipo_art=$this->tart($model2->ID_ART);
                    if($model2->validate()) {
                        $model2->save();
                    } else {
                        echo 'error'.'<br>';
                        echo '<pre>';
                        print_r($model2);
                        echo '<pre>';exit;
                    }
                    //actualizar ARTICULO PRESTADO
                    $model2 = new Prestado();
                    //$model2=Prestado::find()->where(['PRES_PRS'=>$id])->one();   
                    $model2->ARTI_PRS = $arti_new;
                    $model2->PRES_PRS = $model->ID_PRE;
                    $model2->validate();
                    $model2->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->ID_PRE]);
        } else {
            $model->articulo=$art_actual;
            // echo '<pre>'.print_r($art_actual).'<br>';
            // print_r($model->articulo).'<br>';
            // echo '</pre>';exit;
            return $this->render('update', [
                'model'     =>  $model, 
                'modelp'    =>  $modelp
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

        $mprestado=Prestado::find()->where(['PRES_PRS'=>$id])->all();

        foreach ($mprestado as $reg) {
            $model2 = Articulo::findOne($reg->ARTI_PRS);
            $model2->DISP_ART=0;           
            $model2->tipo_art=$this->tart($model2->ID_ART);
            $model2->validate();
            $model2->save();            
        }

        Prestado::deleteAll(['PRES_PRS'=>$id]);

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
