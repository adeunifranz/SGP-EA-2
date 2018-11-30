<?php

use yii\helpers\Html;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$CSS=<<<CSS
/*-------------------------
	Simple reset
--------------------------*/


*{
	margin:0;
	padding:0;
}


/*-------------------------
	General Styles
--------------------------*/

a.menu{
	font-size: 3em;
	border-bottom-left-radius:3px;
	border-bottom-right-radius:3px;
	# margin: 10px;
	padding: 0;
	padding-top: 10px;
	height: 150px;
	overflow:hidden;
	color: rgba(255,255,255,0.5);
	border-radius: 0px 0px 50px;
	border: 10px solid rgba(255, 255, 255, 0.7);
	-webkit-transition: font-weight text-shadow 0.9s box-shadow border background-color color 0.4s linear;
	-moz-transition: font-weight text-shadow 0.9s box-shadow border background-color color 0.4s linear;
	transition: font-weight text-shadow 0.9s box-shadow border background-color color 0.4s linear;
}
a.menu span {
    font-size: 0.5em;
	position: absolute;
	top: 75px;
	left: 110px;
}
a.menu.rojo{
	background-color:#ea5080;
}
a.menu.azul{
	background-color:#53bfe2;
	font-size: 3.7em;
}
a.menu.amarillo{
	background-color:#f8c54d;
}
a.menu.purpura{
	background-color:#df6dc2;
}

a.menu:hover{
	font-weight: bold;
	text-shadow: 5px 5px 5px rgba(55, 55, 55, 0.3); 
	box-shadow: 5px 5px 10px rgba(100, 100, 100, 0.2) inset, 5px 5px 10px #CCC;
	border: 12px solid rgba(255, 255, 255, 0.9);
}
a.menu.rojo:hover{
	background-color:#ea6080;
	color:#ffffff;
}
a.menu.azul:hover{
	background-color:#53cfe2;
	color:#ffffff;
}
a.menu.amarillo:hover{
	background-color:#f8d54d;
	color:#ffffff;
}
a.menu.purpura:hover{
	background-color:#df7dc2;
	color:#ffffff;
}
h2.icon-title{
	text-align: center;
	font-size: 3em;
	color:rgba(0,0,0,0.4);
	margin-top: -10px;
}
h2.icon-title i{
	font-size: 4em;
}
div.cell{
	display:table-cell;
	text-align: center;
	height: 180px;	
	vertical-align: middle;
}
div.row{
	display: table-row;
}
section.content-header{
	display: none;
}
CSS;
$this->registerCSS($CSS);

$this->title = 'Personas';
// $this->params['breadcrumbs'][] = $this->title;
?>


<div class="persona-index" id="form-persona">
	<div class="box-body pad table-responsive">
		<div class="row col-lg-12">
		<h2 class="icon-title"><i class="fa fa-address-book-o"></i><br><?= $this->title  ?></h2>
    <?php if (Helper::checkRoute('listado')) {?>
			<div class="col-lg-6 cell">
	        <?= Html::a(
	        	'<i class="fa fa-search"></i>&nbsp;Consulta', 
	        	['/persona/listado'], ['class' => 'btn menu amarillo col-lg-11',])
	        ?>
	<?php } ?>	        
    <?php if (Helper::checkRoute('reporte')) {?>	
			</div>
			<div class="col-lg-6 cell">
	        <?= Html::a(
	        	'<i class="fa fa-file-pdf-o"></i>&nbsp;Reporte<span>Historial de prestamos</span>', 
	        	['/persona/reporte'], ['class' => 'btn menu rojo col-lg-11',])
	        ?>
	<?php } ?>	        
			</div>
		</div>
		<div class="row col-lg-12">
	    <?php if (Helper::checkRoute('create')) {?>
			<div class="col-lg-6 cell">
	        <?= Html::a(
	        	'<i class="fa fa-save"></i>&nbsp;Registro', 
	        	['/persona/create'], ['class' => 'btn menu purpura col-lg-11',])
	        ?>
	    <?php } ?>
			</div>
	    <?php if (Helper::checkRoute('estadistica')) {?>
			<div class="col-lg-6 cell">
	        <?= Html::a(
	        	'<i class="fa fa-bar-chart"></i>&nbsp;Estadistica', 
	        	['/persona/create'], ['class' => 'btn menu azul col-lg-11',])
	        ?>
		<?php } ?>        
			</div>
		</div>
	</div>
</div>