<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Devuelto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="devuelto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DEVO_DVS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ARTI_DVS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRES_DVS')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
