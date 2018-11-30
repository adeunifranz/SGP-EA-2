<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArticuloSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articulo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'ID_ART') ?>

    <?php // $form->field($model, 'COAS_ART') ?>

    <?= $form->field($model, 'MARC_ART') ?>

    <?php // $form->field($model, 'SERI_ART') ?>

    <?= $form->field($model, 'DETA_ART') ?>

    <?php // echo $form->field($model, 'FEAL_ART') ?>

    <?php // echo $form->field($model, 'HOAL_ART') ?>

    <?php echo $form->field($model, 'ESTA_ART') ?>

    <?php // echo $form->field($model, 'COLO_ART') ?>

    <?php // echo $form->field($model, 'OBSE_ART') ?>

    <?php // echo $form->field($model, 'FOTO_ART') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
