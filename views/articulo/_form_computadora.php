<?php

use yii\bootstrap\Dropdown;
//use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\helpers\Html;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Persona */
/* @var $form yii\widgets\ActiveForm */

?>
    <?php $form = ActiveForm::begin([
                          "enableAjaxValidation"    => true,
                          "id"                      => "computadora"
    ]); ?>

    <?= $form->field($model, 'SIOP_COM',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'sistema operativo',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                        ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROC_COM',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'procesador',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MEMO_COM',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'memoria RAM',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DIDU_COM',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'disco duro o memoria interna',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TAVI_COM',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'tarjeta de video (si tiene)',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true]) ?>

<?php 
   $tipos_computadora = [
              '1' => 'PC',
              '2' => 'LAPTOP',
              '3' => 'CELULAR',
              '4' => 'TABLET',
    ];

 ?>

    <?= 
        $form->field($model, 'TIPO_COM')->dropdownList($tipos_computadora);
     ?>


    <?= $form->field($model, 'ARTI_ACC')->hiddenInput(['value'=>1])->label(false); ?>

    <?php ActiveForm::end(); ?>