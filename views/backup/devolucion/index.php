<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DevolucionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Devoluciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devolucion-index">

    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nueva Devolucion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php Pjax::begin(); ?>
    <?php echo
     GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'prestado',
            'PRES_DEV',
            'FECH_DEV', 
            'HORA_DEV', 
            ['class' => 'yii\grid\ActionColumn', 'template' => Helper::filterActionColumn('{view} {update} {delete} ')],
        ],
    ]); ?>
<?php Pjax::end(); ?>

</div>
