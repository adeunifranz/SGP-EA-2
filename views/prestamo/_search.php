<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrestamoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prestamo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_PRE') ?>

    <?= $form->field($model, 'FECH_PRE') ?>

    <?= $form->field($model, 'HORA_PRE') ?>

    <?= $form->field($model, 'PERS_PRE') ?>

    <?= $form->field($model, 'LUGA_PRE') ?>

    <?php // echo $form->field($model, 'DOCU_PRE') ?>

    <?php // echo $form->field($model, 'ENCA_PRE') ?>

    <?php // echo $form->field($model, 'OBSE_PRE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
