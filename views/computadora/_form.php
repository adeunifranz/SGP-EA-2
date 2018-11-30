<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Computadora */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="computadora-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php require('__form.php'); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg col-lg-6' : 'btn btn-primary btn-lg col-lg-6']) ?>
        <?= Html::a('Cancelar', ['/articulo'], ['class' => 'btn btn-default btn-lg col-lg-6',])  ?>        
    </div>

    <?php ActiveForm::end(); ?>

</div>
