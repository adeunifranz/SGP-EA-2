<?php

namespace app\controllers;

use Yii;
use app\models\Persona;
use app\models\PersonaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * PersonaController implements the CRUD actions for Persona model.
 */
class PersonaController extends Controller
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
     * Lists all Persona models.
     * @return mixed
     */

    public function actionTest() {       
        $model = \app\models\Prestamo::get_VIGENTE(1);
        echo "<pre>";
        print_r($model);
        echo "</pre>";
    }


    public function actionVigente() {
        $this->layout=false;
        return $this->render('vigente', [
            'model'=>new \app\models\Prestamo(),
            'id'=>$id,
            'inicio'=>$inicio,
            'fin'=>$fin
        ],false);
    }

    public function actionReporte() {       
        $model = new \app\models\Reporte();
        if ($model->load(Yii::$app->request->post())) {
            // echo "<pre>";
            // print_r($model);
            // echo "</pre>";exit;
            $data=null;
            if($model->todo) {
                $data=['pdf', 'id' => $model->seleccion];
            } else {
                $data=['pdf', 
                        'id' => $model->seleccion,
                        'inicio'=>$model->fecha_ini,
                        'fin'=>$model->fecha_fin,
                    ];
            }
            return $this->redirect($data);
        } else {           
            //SELECT * FROM `prestamo` JOIN `persona` ON PERS_PRE=ID_PER WHERE PERS_PRE=ID_PER
            $perdbo=Yii::$app->db->createCommand('
                SELECT 
                    ID_PER,
                    CONCAT(APPA_PER," ",APMA_PER," ",NOMB_PER) AS NOMBRE
                FROM `prestamo` 
                JOIN `persona`
                ON PERS_PRE=ID_PER
                WHERE PERS_PRE=ID_PER
                ')->queryAll();
            $personas = yii\helpers\ArrayHelper::map($perdbo, 'ID_PER', 'NOMBRE');

            return $this->render('_reporte', [
                'model'=>$model,'personas' => $personas, 
            ]);
        }
    }

    public function actionPdf($id, $inicio=null, $fin=null) {
        // get your HTML raw content without any layouts or scripts
        $content = '<div style="z-index:1">';
        $this->layout=false;
        $content.= $this->renderPartial('vigente', [
            'model'=>new \app\models\Prestamo(),
            'id'=>$id,
            'inicio'=>$inicio,
            'fin'=>$fin],
        false);
        $content .= '</div>';
        // setup kartik\mpdf\Pdf component
        $header = '
                <table style="
                        border:0px;
                        vertical-align: bottom;
                        font-family: serif;
                        font-size: 9pt;
                        color: #222;"
                        width="100%"
                        z-index:1
                        >
                    <tbody>
                        <tr>
                            <td rowspan="3">
                                <img src="img/unifranz logo.jpg" style="
                                        display: cell;
                                        width:200px;
                                        margin:0;
                                        padding:0;
                                        z-index:1;
                                ">
                            </td>
                            <td  width="30">
                            <table>
                            <tr><th>Usuario:</th><td>'.Yii::$app->user->identity->username.'</td></tr>
                            <tr><th>Fecha:</th><td>'.date("d-m-Y").'</td></tr>
                            <tr><th>Hora:</th><td>'.date("H:i:s").'</td></tr>
                            </table>
                            </td>
                        <tr>
                    </tbody>
                </table>     
                ';
        $footer = '
                <br>
                <p style="
                        text-align:center;
                        color:#222;
                        z-index:1;
                        ">{PAGENO} - {nb}</p>
            ';

        $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_CORE, 
        // A4 paper format
        'format' => Pdf::FORMAT_LETTER, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT, 
        //'orientation' => Pdf::ORIENT_LANDSCAPE, 
        // stream to browser inline
        'marginLeft' => 10,
        'marginRight' => 10,
        'marginTop' => 40,
        'marginBottom' => 40,
        'marginHeader' => 5,
        'marginFooter' => 10,
        //'cssInline' => '.tr{border: 5px solid black;}',
        'destination' => Pdf::DEST_BROWSER, 

        ]);

        $mpdf = $pdf->api; // fetches mpdf api

        $mpdf->SetTitle('Reporte personas');

        $mpdf->SetWatermarkImage(
            'img/plantilla-reporte.jpg', 
            0.9, 
            'P'//, 
//            array(160,10)
        );
        $mpdf->SetHeader($header);
        $mpdf->SetHTMLFooter($footer);
        $mpdf->showWatermarkImage = true;
        // echo $content;
        // exit;
        $mpdf->WriteHtml($content); // call mpdf write html
//        echo $mpdf->Output('filename', 'D'); // call the mpdf api output as needed
       
        //$pdf->SetWatermarkImage('images/logo.jpg');
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    public function actionListado()
    {
        $searchModel = new PersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('listado', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * Displays a single Persona model.
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
     * Creates a new Persona model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Persona();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_PER]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Persona model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_PER]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Persona model.
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
     * Finds the Persona model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Persona the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Persona::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
