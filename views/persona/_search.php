<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_PER') ?>

    <?= $form->field($model, 'NOMB_PER') ?>

    <?= $form->field($model, 'APPA_PER') ?>

    <?= $form->field($model, 'APMA_PER') ?>

    <?= $form->field($model, 'CAID_PER') ?>

    <?php // echo $form->field($model, 'DIRE_PER') ?>

    <?php // echo $form->field($model, 'TELE_PER') ?>

    <?php // echo $form->field($model, 'REUN_PER') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
