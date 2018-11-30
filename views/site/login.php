<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\LoginAsset;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
//Yii::$app->layout = false;

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

// Yii::$app->assetManager->bundles = ['dmstr\web\AdminLteAsset' => false,];
// Yii::$app->assetManager->bundles = ['dmstr\web\AdminLteAsset']['skin'] => false;
Yii::$app->assetManager->bundles = null;

// echo '<pre>';
//     print_r(Yii::$app->assetManager->bundles);
// echo '</pre>';exit;


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
<div id="content">
<div class="bg"></div>

<div class="container-login">
    <img src="img/boy-512.png" class="w3-circle">

        <!-- /.login-logo -->
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

            <?= $form
                ->field($model, 'username', $fieldOptions1)
                ->label(false)
                ->textInput([
                    'placeholder'   => $model->getAttributeLabel('username'),
                    'autocomplete'  => "off",
                    'class'         => 'input',
                    'autofocus'     => true
                    ]) ?>

            <?= $form
                ->field($model, 'password', $fieldOptions2)
                ->label(false)
                ->passwordInput([
                    'placeholder'   => $model->getAttributeLabel('password'),
                    'autocomplete'  => "off",
                    'class'         => 'input'                   
                    ]) ?>

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
</div>