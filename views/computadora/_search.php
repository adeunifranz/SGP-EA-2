<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ComputadoraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="computadora-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_COM') ?>

    <?= $form->field($model, 'SIOP_COM') ?>

    <?= $form->field($model, 'PROC_COM') ?>

    <?= $form->field($model, 'MEMO_COM') ?>

    <?= $form->field($model, 'DIDU_COM') ?>

    <?php // echo $form->field($model, 'TAVI_COM') ?>

    <?php // echo $form->field($model, 'ARTI_COM') ?>

    <?php // echo $form->field($model, 'TIPO_COM') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
