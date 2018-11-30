<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AmbienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ambientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ambiente-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Ambiente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php 
        $pisos= yii\helpers\ArrayHelper::map(\app\models\Piso::find()->all(), 'NOMB_PIS', 'NOMB_PIS');
        $ambientes= yii\helpers\ArrayHelper::map(\app\models\Ambiente::find()->all(), 'NOMB_AMB', 'NOMB_AMB');
     ?>

<?php Pjax::begin(); ?>
<?php
echo GridView::widget([
    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            // 'filter' => Select2::widget([
            //     'name' => 'AmbienteSearch[PISO]',
            //     'data' => 
            //     yii\helpers\ArrayHelper::map(\app\models\Piso::find()->all(), 'NOMB_PIS', 'NOMB_PIS'),
            //     'options' => [
            //         'placeholder' => 'FILTRAR POR ...',
            //     ],
            // ]),

            // 'value' => function ($model, $key, $index, $widget) { 
            //     return Html::a($model->PISO,  
            //         '#', 
            //         ['title' => 'View author detail', 'onclick' => 'alert("This will open the author page.\n\nDisabled for this demo!")']);
            // },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => $ambientes, 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Todos'],
            'format' => 'raw',
            // 'filter' => Html::activeDropDownList($searchModel, 'PISO', yii\helpers\ArrayHelper::map(\app\models\Piso::find()->all(), 'NOMB_PIS', 'NOMB_PIS'),['class'=>'form-control','prompt' => 'FILTRAR POR ...']),
            'attribute'=>'NOMB_AMB',
        ],

        [
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => $pisos, 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Todos'],
            'format' => 'raw',
            // 'filter' => Html::activeDropDownList($searchModel, 'PISO', yii\helpers\ArrayHelper::map(\app\models\Piso::find()->all(), 'NOMB_PIS', 'NOMB_PIS'),['class'=>'form-control','prompt' => 'FILTRAR POR ...']),
            'label' => 'UBICACION DE LA PLANTA',
            'attribute'=>'PISO',
        ],

        ['class' => 'yii\grid\ActionColumn'],
    ],
    'pjax'=>true,
    'pjaxSettings'=>[
        'neverTimeout'=>true,
        // 'beforeGrid'=>'My fancy content before.',
        // 'afterGrid'=>'My fancy content after.',
    ]
]);
  ?>
<?php Pjax::end(); ?>  
</div>
