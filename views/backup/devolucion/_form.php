<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\TimePicker;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Devolucion */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
if ($model->isNewRecord) {
    $model->FECH_DEV = date("Y-m-d");
    $model->HORA_DEV = date("H:i:s");
}
else {
    $model->FECH_DEV = Yii::$app->formatter->asDate($model->FECH_DEV, 'php:Y-m-d');
}
?>


<div class="devolucion-form">

        <div class="container">
          <div class="col-lg-offset-3 col-lg-6">

            <?php $form = ActiveForm::begin(); ?>
        
            <?= $form->field($model, 'PRES_DEV')->dropdownList($model->get_articulos(),
                ['prompt'=>'Elija una opcion']
            );?>

          <div class="col-lg-6">
            <?php echo $form->field($model, 'FECH_DEV')->textInput(['readonly'=>false, 'type'=>'date']); ?>
          </div>
          <div class="col-lg-6">
            <?php echo $form->field($model, 'HORA_DEV')->widget(TimePicker::classname(), [
              'name' => 'HOAL_ART',
                  'pluginOptions' => [
                      'showSeconds' => true,
                      'showMeridian' => false,
                      'minuteStep' => 1,
                      'secondStep' => 5,
                  ]
              ]); ?>
          </div>

            <?= $form->field($model, 'OBSE_DEV')->textarea(['rows' => 6, 'style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>

            <?= $form->field($model, 'ENCA_DEV')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>   

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success col-lg-6' : 'btn btn-primary col-lg-6']) ?>
                    <?= Html::a('Cancelar', Yii::$app->request->referrer, ['class' => 'btn btn-default col-lg-6'])  ?>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
