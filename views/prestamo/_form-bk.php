<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prestamo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prestamo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'FECH_PRE')->textInput() ?>

    <?= $form->field($model, 'HORA_PRE')->textInput() ?>

    <?= $form->field($model, 'PERS_PRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LUGA_PRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FEDE_PRE')->textInput() ?>

    <?= $form->field($model, 'HODE_PRE')->textInput() ?>

    <?= $form->field($model, 'DOCU_PRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ENCA_PRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OBSE_PRE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
