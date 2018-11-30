<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */

$this->title = \Yii::$app->name;
?>
<div class="site-index" style="background: rgba(255,255,255,0.1);">

    <div class="jumbotron">
        <?= 
        '<h1 class="bienvenido">'.\Yii::t('app','Bienvenido!').'</h1>';
         ?>
        <p class="lead"><?= \Yii::t('app','Sistema de gestion de prestamos');?></p>
        <?php
        if(Yii::$app->user->isGuest)
        {
            echo
                  Html::beginForm(['/site/login'])
                . Html::submitButton(
                    \Yii::t('app','Iniciar sesión'),
                    ['class' => 'btn btn-primary btn-sm']
                )
                . Html::endForm();

        }
        else
        {
            echo Yii::t('app','usuario:').'<h2>'.Yii::$app->user->identity->username.'</h2>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    \Yii::t('app','Desconectar'),
                    ['class' => 'btn btn-primary btn-sm']
                )
                . Html::endForm();
        }
        ?>
    </div>

    <div class="body-content"></div>>