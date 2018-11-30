<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Piso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="piso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOMB_PIS')->textInput(
        [
            'maxlength'     => true,
            'placeholder'   =>'NOMBRE DEL PISO',
            'style'         =>'text-transform: uppercase',
            'onblur'        =>'javascript:this.value=this.value.toUpperCase().trim().replace(/  +/g, " ");'
        ]
    	) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
