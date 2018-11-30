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

$this->title = 'Cambiar contraseña';
?>

<div class="user-changePassword">
 
    <?php $form = ActiveForm::begin(); ?>
 
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'confirm_password')->passwordInput() ?>
 
        <div class="form-group">
            <?= Html::submitButton('Cambiar', ['class' => 'btn btn-primary', 'id'=>'btnCambiar']) ?>
        </div>
    <?php ActiveForm::end(); ?>
 
</div>