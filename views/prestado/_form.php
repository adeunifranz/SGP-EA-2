<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prestado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prestado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ARTI_PRS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRES_PRS')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
