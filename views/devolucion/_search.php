<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DevolucionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="devolucion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_DEV') ?>

    <?= $form->field($model, 'FECH_DEV') ?>

    <?= $form->field($model, 'HORA_DEV') ?>

    <?= $form->field($model, 'OBSE_DEV') ?>

    <?= $form->field($model, 'ENCA_DEV') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
