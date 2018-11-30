<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use mdm\admin\components\Helper;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel app\models\DevolucionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Devoluciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devolucion-index">

    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php $dataProvider->pagination = ['pageSize' => 5]; ?> 
        <?php if (Helper::checkRoute('create')) {?>
            <p>
                <?= Html::a('Nueva Devolucion', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        <?php } ?>
    <?php $FECH_DEV = ArrayHelper::map(app\models\Devolucion::find()->all(), 'FECH_DEV', 'FECH_DEV'); ?>
    <?php $HORA_DEV = ArrayHelper::map(app\models\Devolucion::find()->all(), 'HORA_DEV', 'HORA_DEV'); ?>
    <?php $Personal = ArrayHelper::map(app\models\Devolucion::find()->all(), 'Personal', 'Personal'); ?>    
<?php Pjax::begin(); ?>
    <?php echo
     GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $FECH_DEV, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
                //'label' => '',
                'attribute'=>'FECH_DEV',
            ],
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $HORA_DEV, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
                //'label' => '',
                'attribute'=>'HORA_DEV',
            ],
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $Personal, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
                //'label' => '',
                'attribute'=>'Personal',
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => Helper::filterActionColumn('{view}')],
        ],
    ]); ?>
<?php Pjax::end(); ?>

</div>
