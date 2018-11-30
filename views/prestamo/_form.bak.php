<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\TimePicker;
use kartik\widgets\Select2;
use yii\widgets\Pjax;

$this->registerJS('
    $(document).on("ready",function($){
            if (document.getElementById("modalbutton").lenght) {
                alert("existe");
            } else {
                alert("no existe");
            }            
    });
    $("#prestamo-pers_pre").on("change",function(){
        if($("#prestamo-pers_pre").val()==""){
            $("#modalbutton").show();
        } else {
            $("#modalbutton").hide();
        }
    });
    $("#submitpers").on("click",function(){
        if($("#prestamo-pers_pre").val()!=""){
            $("#modalbutton").hide();
            $("#submitpers").hide();
        }
    });
    ');
/* @var $this yii\web\View */
/* @var $model app\models\Prestamo */
/* @var $form yii\widgets\ActiveForm */
/*$model2 = new Prestado;*/
?>
              <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
              <div class="modal-dialog modal-md" style="padding: 0;margin: 0">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="modal-title" id="myModalLabel"><h3><strong>Agregar registro de persona</strong></h3></div>
                  </div>
                  <div class="modal-body">


                    <div class="persona-form">
                      <div class="container">
                        <div class="col-lg-6">
                        <?php $form = ActiveForm::begin(); ?>

                        <?php /*echo $form->field($modelp, 'ID_PER')->textInput(['maxlength' => true, 'value'=>$modelp->ID_PER, 'readonly'=>'readonly']) */?>

                        <?= $form->field($modelp, 'NOMB_PER',[
                            'inputOptions' => [
                                    'class' => 'form-control transparent',
                                    'placeholder' => 'escriba su nombre',
                                    'style'=>'text-transform: uppercase',
                                    'onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($modelp, 'APPA_PER',[
                            'inputOptions' => [
                                'class' => 'form-control transparent',
                                'placeholder' => 'escriba su apellido paterno',
                                    'style'=>'text-transform: uppercase',
                                    'onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($modelp, 'APMA_PER',[
                            'inputOptions' => [
                                'class' => 'form-control transparent',
                                'placeholder' => 'escriba su apellido materno',
                                    'style'=>'text-transform: uppercase',
                                    'onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($modelp, 'CAID_PER',[
                            'inputOptions' => [
                                'class' => 'form-control transparent',
                                'placeholder' => 'escribe su carnet de identidad',
                                    'style'=>'text-transform: uppercase',
                                    'onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($modelp, 'DIRE_PER',[
                            'inputOptions' => [
                                'class' => 'form-control transparent',
                                'placeholder' => 'escribe su direccion',
                                    'style'=>'text-transform: uppercase',
                                    'onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($modelp, 'TELE_PER')->textInput(['class'=>'form-control','maxlength' => true,
                                    'style'=>'text-transform: uppercase',
                                    'onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>

                        <?= $form->field($modelp, 'REUN_PER')->dropdownList([
                            'ADMINISTRATIVO'  => 'ADMINISTRATIVO',
                            'DOCENTE'       => 'DOCENTE',
                            'ESTUDIANTE'    => 'ESTUDIANTE'
                        ],
                            ['prompt'=>'--Seleccione--']
                        ); ?>

                    </div>
                    </div>

                    </div>


                  </div>

                  <div class="modal-footer">
                            <?= Html::submitButton('Agregar', ['class' => 'btn  btn-primary', 'id' => 'submitpers']) ?>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  </div>
                        <?php ActiveForm::end(); ?>
                </div>
              </div>
            </div>

<div class="prestamo-form">
<div class="row">
  <div class="container">
    <div class="col-lg-6">

    <?php 
    if ($model->isNewRecord) {
      $model->FECH_PRE = date("Y-m-d");
      $model->HORA_PRE = date("H:i:s");
    }
    else {
      $model->FECH_PRE = Yii::$app->formatter->asDate($model->FECH_PRE, 'php:Y-m-d');
    }
     ?>

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-12" style="padding-left: 0;padding-right: 0;">
    <div class="col-lg-11" style="padding-left: 0;padding-right: 0;">
    <?php Pjax::begin(); ?>
    <?php 
        /*echo $form->field($model, 'PERS_PRE')->dropDownList($personas,['prompt'=>'--Seleccione--']);*/
        echo 
        $form->field($model, 'PERS_PRE')->widget(Select2::classname(), [
            'data'          => $personas,
            'language'      => 'es',
            'options'       => ['placeholder'=>'--Seleccione--'],
            'pluginOptions' => ['allowClear'=>true]
    ]);
    ?>
    <?php Pjax::end(); ?>
    </div>
        <a type="button" class="btn btn-default" style="margin-top: 25px;" data-toggle="modal" data-target="#largeModal" id="modalbutton">
            <i class="fa fa-user-plus"></i></a>
    </div>
    <div class="col-lg-11">
    <?php 
/*        if ($model->isNewRecord) {
*/            /*echo $form->field($model, 'articulo')->dropDownList($articulos,['prompt'=>'--Seleccione--']);*/
        echo 
            $form->field($model, 'articulo')->widget(Select2::classname(), [
                'data'          => $articulos,
                'language'      => 'es',
                'options'       => ['placeholder'=>'--Seleccione--'],
                'pluginOptions' => ['allowClear'=>true]
        ]);
/*        }*/
    ?>
    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'FECH_PRE')->textInput(['type'=>'date']) ?>
    </div>
    <div class="col-lg-5">
    <?= $form->field($model, 'HORA_PRE')->widget(TimePicker::classname(), [
        'name' => 'HORA_PRE',
            'pluginOptions' => [
                'showSeconds' => true,
                'showMeridian' => false,
                'minuteStep' => 1,
                'secondStep' => 5,
            ]
        ]); ?>
    </div>
    <?php /*echo $form->field($model, 'PERS_PRE')->textInput(['maxlength' => true])*/ ?>

    <?php /*echo $form->field($model, 'LUGA_PRE')->textInput(['maxlength' => true])*/ ?>
<?php 
    /*echo $form->field($model, 'LUGA_PRE')->dropDownList($ambientes,['prompt'=>'--Seleccione--']);*/
    echo 
        $form->field($model, 'LUGA_PRE')->widget(Select2::classname(), [
            'data'          => $ambientes,
            'language'      => 'es',
            'options'       => ['placeholder'=>'--Seleccione--'],
            'pluginOptions' => ['allowClear'=>true]
    ]);
?>
    <?= $form->field($model, 'DOCU_PRE')->dropdownList([
        'CREDENCIAL' => 'CREDENCIAL',
        'CARNET' => 'CARNET',
    ],
        ['prompt'=>'Elija una opcion']
    );?>
</div>
    <div class="col-lg-5">
<?php 
    // $items = ArrayHelper::map(app\models\User::find()->all(), 'id', 'username');
    // echo $form->field($model, 'ENCA_PRE')->dropDownList($items,['prompt'=>'--Seleccione--']);
?>
    <?php $model->ENCA_PRE=Yii::$app->user->identity->id;?>
    
    <?= $form->field($model, 'ENCA_PRE')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>

    <?= $form->field($model, 'OBSE_PRE')->textarea(['rows' => 6, 'style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>


    <div class="form-group col-lg-12">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Actualizar', 
        ['class' => $model->isNewRecord ? 'btn btn-lg btn-success col-lg-6' : 'btn btn-lg btn-primary col-lg-6']) ?>
        <?= Html::a('Cancelar', ['/prestamo'], ['class' => 'btn btn-lg btn-default col-lg-6',])  ?>        
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
