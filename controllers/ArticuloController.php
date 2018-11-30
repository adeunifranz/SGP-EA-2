<?php

namespace app\controllers;

use Yii;
use app\models\Articulo;
use app\models\ArticuloSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\Modal;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\response;


/**
 * ArticuloController implements the CRUD actions for Articulo model.
 */
class ArticuloController extends Controller
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
     * Lists all Articulo models.
     * @return mixed
     */

    public function actionPrueba()
    {
      $model = new Articulo();
      echo '<pre>';
      print_r($model);
      echo '</pre>';
    }

    public function actionIndex()
    {
        $searchModel = new ArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionValidate()
    {
        //$this->layout=false;
        $model = new \app\models\accesorio;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

    }

    public function actionAccesorio($id)
    {
      // if (Yii::$app->request->isAjax) {
      //     $data = Yii::$app->request->post();
      //     $id= explode(":", $data['id']);
      //     $search = $id.' correcto!!';
      //     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      //     return [
      //         'search' => $search
      //     ];
      //   }
       // $data = Yii::$app->request->post('id');
       // $tipo = Yii::$app->request->post();
       //  echo '<pre>';
       //    print_r($tipo);
       //  echo '</pre>';exit;
        switch ($id) {
          case 'accesorio':
               $model = new \app\models\Accesorio();
                return $this->renderAjax('_form_accesorio', ['model' => $model]);
          break;
          case 'computadora':
               $model = new \app\models\Computadora();
                return $this->renderAjax('_form_computadora', ['model' => $model]);
          break;
          default:
            # code...
          break;
        }
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::info("hola");
            return ActiveForm::validate($model);
        }
    }

    /**
     * Displays a single Articulo model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        // $model2 = \app\models\Accesorio::find()
        // ->where(['ARTI_ACC' => $id])
        // ->one();
        // if ($model2 != null) {
        //     $tipo='accesorio';
        // } else {
        //     $model2 = \app\models\Computadora::find()->where(['ARTI_COM' => $id])->one();
        //     if ($model2 != null) {
        //         $tipo='computadora';
        //     } else {
        //         $model2 = \app\models\Monitor::find()->where(['ARTI_MON' => $id])->one();
        //         if ($model2 != null) {
        //             $tipo='monitor';
        //         } else {
        //             $model2 = \app\models\Mouse::find()->where(['ARTI_MOU' => $id])->one();
        //             if ($model2 != null) {
        //                 $tipo='mouse';
        //             } else {
        //                 $model2 = \app\models\Parlante::find()->where(['ARTI_PAR' => $id])->one();
        //                 if ($model2 != null) {
        //                     $tipo='parlante';
        //                 } else {
        //                     $model2 = \app\models\Teclado::find()->where(['ARTI_TEC' => $id])->one();
        //                     if ($model2 != null) {
        //                         $tipo='teclado';
        //                     } else {
        //                         $model2 = \app\models\Varios::find()->where(['ARTI_VAR' => $id])->one();
        //                         if ($model2 != null) {
        //                             $tipo='varios';
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
        // $model=$this->findModel($id);
        // $model->tipo_art=$tipo;
/*        echo '<pre>'; print_r($model2);echo '</pre>';
        echo '<pre>'; print_r($this->findModel($id));exit;echo '</pre>';
*/        return $this->render('view', [
            'model' => $model,
            // 'model2'=> $model2
        ]);
    }

    /**
     * Creates a new Articulo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    //

    public function actionCreate2()
    {
        $model = new Articulo();
        if ($model->load(Yii::$app->request->post())&&$model->save()) {
                return $this->redirect(['view', 'id' => $model->ID_ART]);
            } else {

                return $this->render('create', [
                    'model' => $model,
                ]);
            }
    }

    public function actionCreate()
    {
        $model = new Articulo();

            if ($model->load(Yii::$app->request->post())&&$model->save()) {
                $image = UploadedFile::getInstance($model, 'foto');
                if ($image === null) {
                    echo 'no se subio ninguna foto';
                } else {
                    $imageName=str_replace(" ","-",$model->DETA_ART) . '.' . $image->getExtension();
                    //echo Yii::getAlias('@articuloImgPath'.'/').$imageName;exit;
                    $image->saveAs(Yii::getAlias('@articuloImgPath').'/'.$imageName);
                    $model->FOTO_ART = $imageName;
                    $model->save();
                }
                switch ($model->tipo_art) {
                  case 'accesorio'  : $model2 = new \app\models\Accesorio();
                                      $model2->ARTI_ACC = $model->ID_ART;
                                      $model2->ESPE_ACC = $model->ESPE_ACC;
                                      $model2->FUNC_ACC = $model->FUNC_ACC;
                       break;
                  case 'computadora': $model2 = new \app\models\Computadora();
                                      $model2->SIOP_COM = $model->SIOP_COM;
                                      $model2->PROC_COM = $model->PROC_COM;
                                      $model2->MEMO_COM = $model->MEMO_COM;
                                      $model2->DIDU_COM = $model->DIDU_COM;
                                      $model2->TAVI_COM = $model->TAVI_COM;
                                      $model2->TIPO_COM = $model->TIPO_COM;
                                      $model2->ARTI_COM = $model->ID_ART;
                       break;
                  case 'monitor'    : $model2 = new \app\models\Monitor();
                                      $model2->TAMA_MON = $model->TAMA_MON;
                                      $model2->TIPO_MON = $model->TIPO_MON;
                                      $model2->ENTR_MON = $model->ENTR_MON;
                                      $model2->ARTI_MON = $model->ID_ART;
                       break;
                  case 'mouse'      : $model2 = new \app\models\Mouse();
                                      $model2->TIPO_MOU = $model->TIPO_MOU;
                                      $model2->ENTR_MON = $model->ENTR_MON;
                                      $model2->ARTI_MOU = $model->ID_ART;
                       break;
                  case 'parlante'   : $model2 = new \app\models\Parlante();
                                      $model2->NELE_PAR = $model->NELE_PAR;
                                      $model2->ENTR_PAR = $model->ENTR_PAR;
                                      $model2->ARTI_PAR = $model->ID_ART;
                       break;
                  case 'teclado'    : $model2 = new \app\models\Teclado();
                                      $model2->DIST_TEC = $model->DIST_TEC;
                                      $model2->ENTR_TEC = $model->ENTR_TEC;
                                      $model2->ARTI_TEC = $model->ID_ART;
                       break;
                  case 'varios'     : $model2 = new \app\models\Varios();
                                      $model2->DETA_VAR = $model->DETA_VAR;
                                      $model2->ARTI_VAR = $model->ID_ART;
                       break;
                }
              //$model->save();
              if ($model2->validate()&&$model->validate()) {
                  $model2->save();
              } else {
                  echo 'ERROR AL GUARDAR REGISTRO!!!';
                  echo '<pre>'; print_r($model->attributes);echo '</pre>';
                  echo '<pre>'; print_r($model2->attributes);echo '</pre>';
                  echo '<h1><strong>'.Html::a('Revise los datos', ['volver'], ['class' => 'btn btn-default']).'</strong></h1>';
                  exit;
              }
                return $this->redirect(['view', 'id' => $model->ID_ART]);
            } else {

                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    /**
     * Updates an existing Articulo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model2 = \app\models\Accesorio::find()
        ->where(['ARTI_ACC' => $id])
        ->one();
        if ($model2 != null) {
            $tipo='accesorio';
            $model->ESPE_ACC=$model2->ESPE_ACC;
            $model->FUNC_ACC=$model2->FUNC_ACC;
            $model->ARTI_ACC=$model2->ARTI_ACC;
        } else {
            $model2 = \app\models\Computadora::find()->where(['ARTI_COM' => $id])->one();
            if ($model2 != null) {
                $tipo='computadora';
                $model->SIOP_COM=$model2->SIOP_COM;
                $model->PROC_COM=$model2->PROC_COM;
                $model->MEMO_COM=$model2->MEMO_COM;
                $model->DIDU_COM=$model2->DIDU_COM;
                $model->TAVI_COM=$model2->TAVI_COM;
                $model->TIPO_COM=$model2->TIPO_COM;
                $model->ARTI_COM=$model2->ARTI_COM;
            } else {
                $model2 = \app\models\Monitor::find()->where(['ARTI_MON' => $id])->one();
                if ($model2 != null) {
                    $tipo='monitor';
                    $model->TAMA_MON=$model2->TAMA_MON;
                    $model->TIPO_MON=$model2->TIPO_MON;
                    $model->ENTR_MON=$model2->ENTR_MON;
                    $model->ARTI_MON=$model2->ARTI_MON;
                } else {
                    $model2 = \app\models\Mouse::find()->where(['ARTI_MOU' => $id])->one();
                    if ($model2 != null) {
                        $tipo='mouse';
                        $model->TIPO_MOU=$model2->TIPO_MOU;
                        $model->ENTR_MOU=$model2->ENTR_MOU;
                        $model->ARTI_MOU=$model2->ARTI_MOU;                        
                    } else {
                        $model2 = \app\models\Parlante::find()->where(['ARTI_PAR' => $id])->one();
                        if ($model2 != null) {
                            $tipo='parlante';
                            $model->NELE_PAR=$model2->NELE_PAR;
                            $model->ENTR_PAR=$model2->ENTR_PAR;
                            $model->ARTI_PAR=$model2->ARTI_PAR;
                        } else {
                            $model2 = \app\models\Teclado::find()->where(['ARTI_TEC' => $id])->one();
                            if ($model2 != null) {
                                $tipo='teclado';
                                $model->DIST_TEC=$model2->DIST_TEC;
                                $model->ENTR_TEC=$model2->ENTR_TEC;
                                $model->ARTI_TEC=$model2->ARTI_TEC;
                            } else {
                                $model2 = \app\models\Varios::find()->where(['ARTI_VAR' => $id])->one();
                                if ($model2 != null) {
                                    $tipo='varios';
                                    $model->DETA_VAR=$model2->DETA_VAR;
                                    $model->ARTI_VAR=$model2->ARTI_VAR;
                                }
                            }
                        }
                    }
                }
            }
        }

       $model->tipo_art = $tipo;
       if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $image = UploadedFile::getInstance($model, 'foto');
            if ($image!=null) {
                  $imageName=str_replace(" ","-",$model->DETA_ART) . '.' . $image->getExtension();
                  if (!$model->FOTO_ART===null)
                    unlink(Yii::getAlias('@articuloImgPath').'/'.$model->FOTO_ART);
                 $image->saveAs(Yii::getAlias('@articuloImgPath').'/'.$imageName);
                 $model->FOTO_ART = $imageName;
                 $model->save();
                 Yii::$app->cache->flush();
            }

            switch ($model->tipo_art) {
              case 'accesorio': 
                $model2->ESPE_ACC=$model->ESPE_ACC;
                $model2->FUNC_ACC=$model->FUNC_ACC;
                $model2->ARTI_ACC=$model->ID_ART;
                $model2->validate();
                $model2->save();
                break;                
              case 'computadora': 
                $model2->SIOP_COM=$model->SIOP_COM;
                $model2->PROC_COM=$model->PROC_COM;
                $model2->MEMO_COM=$model->MEMO_COM;
                $model2->DIDU_COM=$model->DIDU_COM;
                $model2->TAVI_COM=$model->TAVI_COM;
                $model2->TIPO_COM=$model->TIPO_COM;
                $model2->ARTI_COM=$model->ID_ART;
                $model2->validate();
                $model2->save();
                break;                
              case 'monitor': 
                $model2->TAMA_MON=$model->TAMA_MON;
                $model2->TIPO_MON=$model->TIPO_MON;
                $model2->ENTR_MON=$model->ENTR_MON;
                $model2->ARTI_MON=$model->ID_ART;
                $model2->validate();
                $model2->save();
                break;                
              case 'mouse': 
                $model2->TIPO_MOU=$model->TIPO_MOU;
                $model2->ENTR_MOU=$model->ENTR_MOU;
                $model2->ARTI_MOU=$model->ID_ART;
                $model2->validate();
                $model2->save();
                break;                
              case 'parlante': 
                $model2->NELE_PAR=$model->NELE_PAR;
                $model2->ENTR_PAR=$model->ENTR_PAR;
                $model2->ARTI_PAR=$model->ID_ART;
                $model2->validate();
                $model2->save();
                break;                
              case 'teclado': 
                $model2->DIST_TEC=$model->DIST_TEC;
                $model2->ENTR_TEC=$model->ENTR_TEC;
                $model2->ARTI_TEC=$model->ID_ART;
                $model2->validate();
                $model2->save();
                break;                
              case 'varios': 
                $model2->DETA_VAR=$model->DETA_VAR;
                $model2->ARTI_VAR=$model->ID_ART;
                $model2->validate();
                $model2->save();
                break;                
              #default:
                # code...
                #break;
            }
            return $this->redirect(['view', 'id' => $model->ID_ART]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
     /**
     * Deletes an existing Articulo model.
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
     * Finds the Articulo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Articulo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articulo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
