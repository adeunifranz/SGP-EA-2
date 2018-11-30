<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 
/* @var $this yii\web\View */
/* @var $model frontend\models\ChangePasswordForm */
/* @var $form ActiveForm */

$this->registerJS('
    $("#btnCambiar").on("click",function(e){
    	$("#w0-success").fadeOut(3000);
    });
    ');

$this->title = 'modificar nombre';
?>

<div class="user-changePassword">
 
    <?php $form = ActiveForm::begin(); ?>
 
        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'confirm_password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Modificar', ['class' => 'btn btn-primary', 'id'=>'btnCambiar']) ?>
            <?= Html::a('Cancelar', ['update'], ['class' => 'btn btn-default',])  ?>
        </div>
    <?php ActiveForm::end(); ?>
 
</div>