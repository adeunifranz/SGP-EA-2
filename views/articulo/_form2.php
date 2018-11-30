<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\widgets\TimePicker;
use kartik\widgets\DatePicker;
use app\assets\ArticuloAsset;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */


ArticuloAsset::register($this);

?>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Articulo</a></li>
    <li><a data-toggle="tab" href="#menu1"></a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">

      <div class="articulo-form">

        <div class="container">
          <div class="col-lg-6">      
          <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
          <?= $form->field($model, 'COAS_ART', [
                  'template' => "{label}\n".
                                "<div class='input-group'>\n".
                                "{input}\n".
                                "<span class='input-group-addon'>ejm. 00-00-00-PB-AAA-12345</span>\n".
                                "</div>\n".
                                "{error}\n".
                                "{hint}"
              ])->textInput(['maxlength' => true,'placeholder'=> '00-00-00-PB-AAA-12345', 'style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>

          <?= $form->field($model, 'MARC_ART')->textInput(['style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>

          <?= $form->field($model, 'SERI_ART')->textInput(['style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>

          <?= $form->field($model, 'DETA_ART')->textInput(['style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>
  
          <?= $form->field($model, 'ESTA_ART')->hiddenInput(['value'=>'BUENO'])->label(false); ?>

          <?php /*echo
          $form->field($model, 'ESTA_ART')->dropdownList([
              'BUENO' => 'BUENO',
              'MALO' => 'MALO',
          ],
              ['prompt'=>'Elija una opcion']
          );*/?>

      </div>

          <div class="col-lg-6">
          <?php 
          if ($model->isNewRecord) {
            $model->FEAL_ART = date("Y-m-d");
            $model->HOAL_ART = date("H:i:s");
          }
          else {
            //$preview = '../web/files/'.$model->FOTO_ART;
            $model->FEAL_ART = Yii::$app->formatter->asDate($model->FEAL_ART, 'php:Y-m-d');
      //      $model->HOAL_ART = Yii::$app->formatter->asDate($model->HOAL_ART, 'php:H:i:s');
            //$model->HOAL_ART = date("H:i:s",strtotime($model->HOAL_ART));
          }
           ?>

          <?= $form->field($model, 'COLO_ART')->textInput(['style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>
          <div class="col-lg-6">
            <?php echo $form->field($model, 'FEAL_ART')->textInput(['readonly'=>false, 'type'=>'date']); ?>
          </div>
          <div class="col-lg-5">
            <?php echo $form->field($model, 'HOAL_ART')->widget(TimePicker::classname(), [
              'name' => 'HOAL_ART',
                  'pluginOptions' => [
                      'showSeconds' => true,
                      'showMeridian' => false,
                      'minuteStep' => 1,
                      'secondStep' => 5,
                  ]
              ]); ?>
          </div>

          <?= $form->field($model, 'OBSE_ART')->textarea(['rows' => 6, 'style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>

           <?= $form->field($model, 'foto')->fileInput(['accept'=>".jpg, .jpeg, .png, .gif", 'class'=>'btn-default']); ?>
          <div class="col-lg-12">
          <?= Html::a('Siguiente&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-circle-o-right"></i>', '#menu1', ['class' => 'btn btn-success btn-lg col-lg-6', 'data-toggle'=>"tab"])  ?>
          </div>

      </div>
      </div>
    </div>
  </div>
    <div id="menu1" class="tab-pane fade">
    <div class="col-lg-6">
        <?= $form->field($model2, 'SIOP_COM')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model2, 'PROC_COM')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model2, 'MEMO_COM')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model2, 'DIDU_COM')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model2, 'TAVI_COM')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model2, 'ARTI_COM')->hiddenInput(['value'=>$model->ID_ART])->label(false); ?>

    <?php 
        echo 
        $form->field($model2, 'TIPO_COM')->widget(Select2::classname(), [
            'data'          => $tipos,
            'language'      => 'es',
            'options'       => ['placeholder'=>'--Seleccione--'],
            'pluginOptions' => ['allowClear'=>true]
    ]);
    ?>
    </div>
           <div class="form-group col-lg-12">
            <?= Html::a('<i class="fa fa-arrow-circle-o-left"></i>&nbsp;&nbsp;&nbsp;Anterior', '#home', ['class' => 'btn btn-primary btn-lg col-lg-4', 'data-toggle'=>"tab"])  ?>
              <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Actualizar', 
              ['class' => $model->isNewRecord ? 'btn  btn-lg btn-success col-lg-4' : 'btn btn-primary btn-lg col-lg-4']) ?>
              <?= Html::a('Cancelar', ['/articulo'], ['class' => 'btn btn-default btn-lg col-lg-4',])  ?>
          </div>

          <?php ActiveForm::end(); ?>
    </div>
  </div>