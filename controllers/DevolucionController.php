<?php

namespace app\controllers;

use Yii;
use app\models\Devolucion;
use app\models\DevolucionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * DevolucionController implements the CRUD actions for Devolucion model.
 */
class DevolucionController extends Controller
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
     * Lists all Devolucion models.
     * @return mixed 
     */
    public function actionIndex()
    {
        $searchModel = new DevolucionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Devolucion model.
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
     * Creates a new Devolucion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionObjetosPrestados($id)
    {
        $objetos = Devolucion::objetos($id);
        echo Json::encode($objetos);
    }    

    public function actionLista()
    {

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $ID_PER = $data['id'];

            $objetos = Devolucion::objetos($ID_PER);

            // echo '<pre>';
            // print_r($objetos);
            // echo '</pre>';exit;
            // /*echo '<table class=table table bordered table striped><tr><th>DETALLE</th><th>FECHA</th><th>HORA</th><th>OBS.</th></tr>';*/


            // $lista='<tr>
            //             <th></th>
            //             <th>DETALLE</th>
            //             <th>FECHA</th>
            //             <th>HORA</th>
            //             <th>OBS.</th>
            //             </tr>
            //             <tr>
            //             <td>';

            //$lista=sizeof($objetos)-1;
            $tama=sizeof($objetos);
            if($tama>0) {
                $lista='<table class="table table bordered table striped">
                            <tr>
                            <th></th>
                            <th>#</th>
                            <th>DETALLE</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            <th>OBS.</th>
                            </tr>';
                $c=1;

                foreach ($objetos as $objeto) {
                    // $lista.='<tr><td><input type="checkbox" name="Devolucion[Prestado][]" value="'.$objeto['ID_ART'].'"><td>'
                    $lista.='<tr><td>'.$form->field($model, 'Prestado[]')->checkbox().'"><td>'                    .$c++.'<td>'.$objeto['articulo'].'<td>'.$objeto['FECH_PRE'].'<td>'.$objeto['HORA_PRE'].'<td>'.$objeto['OBSE_ART'].'</tr>';
                    $tama--;
                }

                $lista.='</td>
                         </tr>
                    </table>';

                //     // echo '<tr><td><input type="checkbox" name="Devolucion[Prestado][]" value="'.$objeto['ID_ART'].'"> '.$objeto['articulo'].'</td><td>'.$objeto['FECH_PRE'].'</td><td>'.$objeto['HORA_PRE'].'</td>';
                //     // if ($objeto['OBSE_ART']!=null) {
                //     //     echo '<td><button class="btn-warning" href="">SI</button></td>';
                //     // }
                //     // echo '</tr>';

            $lista.='<br><strong><p>Seleccione objetos a devolver</p></strong>';
            } else {
                $lista='ACTUALMENTE NO TIENE NINGUN PRESTAMO';
            }

            return $lista;

        } 
    }

    // public function actionValidate()
    // {
    //     //$this->layout=false;
    //     $model = new Devolucion;

    //     if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
    //         Yii::$app->response->format = Response::FORMAT_JSON;
    //         return ActiveForm::validate($model);
    //     }
    // }


    public function actionCreate()
    {
        $model = new Devolucion();

        if ($model->load(Yii::$app->request->post())
            && $model->Prestado!=null
            ) {
                $elegidos=0;
                $prestado=null;
                foreach ($model->Prestado as $elemento) {
                    if($elemento!=0) {
                        $elegidos++;
                        $prestado=\app\models\Prestado::find()
                            ->where([
                                'VIGE_PRS'=>1,
                                'ARTI_PRS'=>$elemento
                                ])->one();
                        $prestado->VIGE_PRS=0;
                        $prestado->save();
                        $model->PRES_DEV=$prestado->PRES_PRS;
                        $model->save();
                        $articulo=\app\models\Articulo::find()
                            ->where([
                                'ID_ART'=>$elemento
                                ])->one();
                        $articulo->DISP_ART=0;
                        $articulo->tipo_art=$articulo->tipo();
                        $articulo->save();
                        $devuelto=new \app\models\Devuelto();
                        $devuelto->DEVO_DVS=$model->ID_DEV;
                        $devuelto->ARTI_DVS=$elemento;
                        $devuelto->save();
                    }
                }
            return $this->redirect(['view', 'id' => $model->ID_DEV]);
        } else {
            if (Devolucion::qdevo()!=null) {
                return $this->render('create', ['model' => $model]);
            } else {
                return $this->render('no-disp');
            }
        }
    }
 


    /**
     * Updates an existing Devolucion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    /**
     * Finds the Devolucion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Devolucion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Devolucion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
