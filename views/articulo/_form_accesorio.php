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
                          "id"                      => "accesorio"
    ]); ?>

    <?= $form->field($model, 'ESPE_ACC',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'especificaciones tecnicas',
                'style'         => 'text-transform: uppercase',
                'rows'          => 6,
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                        ])->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'FUNC_ACC',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'funcion que cumple el accesorio',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ARTI_ACC')->hiddenInput(['value'=>1])->label(false); ?>

    <?php ActiveForm::end(); ?>
