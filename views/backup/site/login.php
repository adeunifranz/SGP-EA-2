<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\LoginAsset;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */


LoginAsset::register($this);
/*Yii::$app->assetManager->bundles = [
'yii\bootstrap\BootstrapPluginAsset' => false,
'yii\bootstrap\BootstrapAsset' => false,
'yii\web\JqueryAsset' => false,
'dmstr\web\AdminLteAsset' => false,
];
*/
 // $asset = Yii::$app->assetManager;
 // print_r($asset);

Yii::$app->assetManager->bundles['dmstr\web\AdminLteAsset']['skin']= null;
Yii::$app->assetManager->bundles = ['dmstr\web\AdminLteAsset' => false,];



$this->title = 'Iniciar sesion';
$this->params['breadcrumbs'][] = $this->title;

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>",
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<div class="container">
    <img src="img/boy-512.png" class="w3-circle">

        <!-- /.login-logo -->
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

            <?= $form
                ->field($model, 'username', $fieldOptions1)
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

            <?= $form
                ->field($model, 'password', $fieldOptions2)
                ->label(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

            <div class="row">
                <div class="col-xs-8"><br>
                    <?= $form->field($model, 'rememberMe')->checkbox(['value'=>false])->label('Recuerdeme') ?>
                </div><br>
            <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['user/request-password-reset']) ?>.
                For new user you can <?= Html::a('signup', ['user/signup']) ?>.
            </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <?= Html::submitButton('Ingresar', ['class' => 'btn-login', 'name' => 'login-button']) ?>
                </div>
                <!-- /.col -->
            </div>


            <?php ActiveForm::end(); ?>

        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
</div>


?>
