<?php
use app\assets\AdminLtePluginAsset;
use yii\helpers\Html;



/* @var $this \yii\web\View */
/* @var $content string */
$JS=<<<JS
var myVar;

$(window).ready(myFunction());
$(".btn-login").click(function(){
    myVar = setTimeout(oculta, 500);
    muestra();
    });
function oculta() {
    $(".container-login").fadeOut();
}
function muestra() {
    $(".container-login").fadeIn("slow");
}
function myFunction() {
    myVar = setTimeout(showPage, 300);
    document.getElementById("content").style.display = "block";
}

function showPage() {
  document.getElementById("animation").style.display = "none";
  document.getElementById("content").style.display = "block"; 
}
JS;
$this->registerJS($JS);

dmstr\web\AdminLteAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
<?php 
$CSS=<<<CSS

CSS;
$this->registerCSS($CSS);

 ?>
</head>
<body class="login-page">
<div id="animation">
	<div id="loader">
	</div>
	<p class="etiqueta-carga">Espere por favor...</p>	
</div>
<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script type="text/javascript">
	myVar = setTimeout(function(){$(".bg").fadeIn()}, 1000);
</script>