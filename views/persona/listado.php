<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use mdm\admin\components\Helper;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-listado">

    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php $dataProvider->pagination = ['pageSize' => 5]; ?> 
    <?php $Nombrecompleto = ArrayHelper::map(app\models\Persona::find()->all(), 'Nombrecompleto', 'Nombrecompleto'); ?>
    <?php $REUN_PER = ArrayHelper::map(app\models\Persona::find()->all(), 'REUN_PER', 'REUN_PER'); ?>

    <?php if (Helper::checkRoute('persona')) {?>
        <p align="right">
            <?= Html::a('<i class="fa fa-reply"></i> Anterior', ['/persona'], ['class' => 'btn btn-xs bg-purple']) ?>
        </p>
    <?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class'=>'table table bordered'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $Nombrecompleto, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true, 'tags'=>true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
                //'label' => '',
                'attribute'=>'Nombrecompleto',
            ],
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $REUN_PER, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true, 'tags'=>true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
                //'label' => '',
                'attribute'=>'REUN_PER',
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => Helper::filterActionColumn('{view} {update} {delete} ')],        ],
    ]);?>
</div>
