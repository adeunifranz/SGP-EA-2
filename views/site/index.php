<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */

$this->title = \Yii::$app->name;

$this->registerJS('
    $(".alert-success").animate({opacity: 1.0}, 3000).fadeOut("slow");
    $(".carousel-inner").hide();
    setTimeout(function() {
        $(".jumbotron h1, .jumbotron .h1").fadeOut("fast");
    }, 2500);
    setTimeout(function() {
        $(".content-wrapper .content-header").fadeIn("slow");
        $(".box-body").fadeIn("slow");
        $(".carousel-inner").fadeIn("slow");
    }, 3500);
');

$this->registerCSS('
    .content-header>h1
    {
        text-align:right;
    }
    .content-wrapper .content-header {
        display:none;
    }
    .carousel-indicators
    {
        display: none;
    }    
');
?>

<div class="site-index" style="background: rgba(255,255,255,0.1);">

    <div class="jumbotron">       
        <h1 class="bienvenido"><?=\Yii::t('app','Bienvenido!')?></h1>
        <p class="lead"><?= \Yii::t('app','Sistema de gestion de prestamos');?></p>
        <?php
        if(Yii::$app->user->isGuest)
        {
            echo
                  Html::beginForm(['/site/login'])
                . Html::submitButton(
                    \Yii::t('app','Iniciar sesión'),
                    ['class' => 'btn btn-default']
                )
                . Html::endForm();

        }
        else
        {
            echo '<strong>'.Yii::t('app','usuario:  ').'</strong>'.Yii::$app->user->identity->username
                /*. Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    \Yii::t('app','Desconectar'),
                    ['class' => 'btn btn-default']
                )
                . Html::endForm()*/;
        }
        ?>
    </div>


    <!--marquee direction="right">
        <img alt="" src="img/unifranz-internacionalizate.jpg"/>
        <img alt="" src="img/blank.png"/>
        <img alt="" src="img/unifranz-negro.png"/>
        <img alt="" src="img/blank.png"/>
        <img alt="" src="img/unifranz logo.jpg"/>
        <img alt="" src="img/blank.png"/>
        <img alt="" src="img/Unifranz_Sede_El_Alto.jpg"/>
        <img alt="" src="img/blank.png"/>
    </marquee-->

    <div class="row">
        <div class="box-body" style="display:none">

              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                  <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">

                    <div class="item active">
                        <img alt="" src="img/Unifranz_Sede_El_Alto.jpg"/>
                    </div>

                    <div class="item">
                        <img alt="" src="img/unifranz-negro.png"/>
                    </div>
                
                    <div class="item">
                        <img alt="" src="img/unifranz logo.jpg"/>
                    </div>

                    <div class="item">
                        <img src="img/unifranz-internacionalizate.jpg">
                    </div>

                </div>
              
                </div>

              </div>
        </div>


    </div>