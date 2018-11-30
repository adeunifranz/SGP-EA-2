<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */
$this->registerJS('
    $(".alert-success").
    $("#signup-username").val="";
');
$this->title = 'Registrar usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>

    <p>Por favor rellene los datos para registrarse:</p>
    <?= Html::errorSummary($model)?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
