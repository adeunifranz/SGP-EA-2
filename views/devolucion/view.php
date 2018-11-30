<?php

use yii\helpers\Html;
use mdm\admin\components\Helper;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Devolucion */

$this->title = 'Registro N° '.$model->ID_DEV;
$this->params['breadcrumbs'][] = ['label' => 'Devoluciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php /*echo Html::encode($this->title)*/ ?></h1>
<div class="devolucion-view">
    <p>
        <?= Html::a('Volver', ['/site'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Devoluciones', ['index'], ['class' => 'btn btn-warning']) ?>
    </p>
<div class="col-lg-6">
    <?= $this->render('_view', [
        'model' => $model
    ]) ?>
</div>

<div class="col-lg-6">
<?php 
$dataProvider = new yii\data\ActiveDataProvider([
	'query'=>app\models\Devuelto::find()->where(["DEVO_DVS"=>$model->ID_DEV]),
	'pagination'=>false,
]);
 ?>
	    <?php echo
     GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'articulos',
		]      
      ]);
        ?>
</div>
</div>