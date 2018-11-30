<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use mdm\admin\components\Helper;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticuloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articulos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-index">

    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php $dataProvider->pagination = ['pageSize' => 5]; ?> 
    <p>
        <?php if (Helper::checkRoute('create')) {?>
            <?= Html::a('Nuevo Articulo', ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>


       <?php $DISP_ART =  [0=>'Disponible', 1=>'Prestado', 2=>'Baja']; ?>
       <?php $FEAL_ART = ArrayHelper::map(app\models\Articulo::find()->all(), 'FEAL_ART', 'FEAL_ART'); ?>
       <?php $MARC_ART = ArrayHelper::map(app\models\Articulo::find()->all(), 'MARC_ART', 'MARC_ART'); ?>
       <?php $SERI_ART = ArrayHelper::map(app\models\Articulo::find()->all(), 'SERI_ART', 'SERI_ART'); ?>
       <?php $DETA_ART = ArrayHelper::map(app\models\Articulo::find()->all(), 'DETA_ART', 'DETA_ART'); ?>

<?php Pjax::begin(); ?>
    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' =>function($data){if($data->DISP_ART==0){
                                        return ['style'=>'background-color:rgba(0,255,0,0.2);color:green'];
                                      } else if ($data->DISP_ART==1) {
                                        return ['style'=>'background-color:rgba(0,0,255,0.2)'];
                                      }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $MARC_ART, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
                'attribute'=>'MARC_ART',
            ],            
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $SERI_ART, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
                'attribute'=>'SERI_ART',
            ],            
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $DETA_ART, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
                'attribute'=>'DETA_ART',
            ],            
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $FEAL_ART, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
                'attribute'=>'FEAL_ART',
            ],
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $DISP_ART, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
            // 'value' => function ($model, $key, $index, $widget) { 
            //     return Html::a($model->PISO,  
            //         '#', 
            //         ['title' => 'View author detail', 'onclick' => 'alert("This will open the author page.\n\nDisabled for this demo!")']);
            // },

                'attribute'=>'DISP_ART',
                'value' => function($data){
                    $val = ($data->DISP_ART==1) ?
                        Html::a(app\models\Articulo::getEstado($data->DISP_ART),
                        '#',
                        ['title'=> ($data->DISP_ART==1) ? $data->Persona : null]
                        ) : app\models\Articulo::getEstado($data->DISP_ART);
                    return 
                        $val;
                },
            ],            
            ['class' => 'yii\grid\ActionColumn', 'template' => Helper::filterActionColumn('{view} {update} {delete} ')],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
