<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use mdm\admin\components\Helper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestamos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamo-index">

    <h1><?php //echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Prestamo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $FECH_PRE = ArrayHelper::map(app\models\Prestamo::find()->all(), 'FECH_PRE', 'FECH_PRE'); ?>
    <?php $HORA_PRE = ArrayHelper::map(app\models\Prestamo::find()->all(), 'HORA_PRE', 'HORA_PRE'); ?>
    <?php $LUGA_PRE = ArrayHelper::map(app\models\Ambiente::find()->leftJoin('prestamo','`LUGA_PRE`=`ID_AMB`')->where('`LUGA_PRE`=`ID_AMB`')->all(), 'ID_AMB', 'NOMB_AMB'); ?>
    <?php $PERS_PRE = ArrayHelper::map(app\models\Persona::find()->leftJoin('prestamo','`PERS_PRE`=`ID_PER`')->where('`PERS_PRE`=`ID_PER`')->all(), 'ID_PER', 'Nombrecompleto'); ?>
    <?php $dataProvider->pagination = ['pageSize' => 5]; ?> 
<?php 
    $cadena='{view}';
 ?>

<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $FECH_PRE, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
                //'label' => '',
                'attribute'=>'FECH_PRE',
            ],
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $HORA_PRE, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
                //'label' => '',
                'attribute'=>'HORA_PRE',
            ],
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $LUGA_PRE, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
                //'label' => '',
                'attribute'=>'LUGA_PRE',
                'value' => function($data){
                    return app\models\Prestamo::get_LUGAPRE($data->LUGA_PRE);
                },
            ],
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $PERS_PRE, 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Todos'],
                'format' => 'raw',
                //'label' => '',
                'attribute'=>'PERS_PRE',
                'value' => function($data){
                    return app\models\Prestamo::get_PERSPRE($data->PERS_PRE);
                },
            ],

             [  
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:260px;'],
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
                'buttons' => [
                    'update' => function ($url, $model) {
                                // $count=app\models\Devuelto::find()
                                //         ->leftJoin('devolucion','`DEVO_DVS`=`ID_DEV`')
                                //         ->leftJoin('prestamo','`PRES_DEV`=`ID_PRE`')
                                //         ->leftJoin('articulo','`ARTI_DVS`=`ID_ART`')
                                //         ->where(['and','DISP_ART=0','ID_PRE='.$model->ID_PRE])->count()
                                //         ;
                                return $model!=null
                                    ? Html::a('<span class="fa fa-pencil"></span>'/*.$count*/, $url, [ 
                                        'title' => Yii::t('app', 'Update'),
                                      ]) 
                                    : '';
                    },
                    'delete' => function ($url, $model) {

                                return $model!=null
                                    ? Html::a('<span class="fa fa-trash"></span>', $url, [ 
                                        'title' => Yii::t('app', 'Delete'),
                                      ]) 
                                    : '';
                    },
               ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

    <?php //echo 
        // GridView::widget([
        // 'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        // 'tableOptions' => ['class'=>'table table bordered'],
//         'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],
// //            'ID_PRE',
//             'FECH_PRE',
//             'HORA_PRE',
//             [
//                 'attribute' => 'PERS_PRE',
//                 'content'   => function(\app\models\Prestamo $model, $key, $index, $column) {
//                     return $model->ID_PRE . ' ' . " {$model->OBSE_PRE}";
//                 }
//             ],
//             'LUGA_PRE',
//             // 'DOCU_PRE',
//             // 'ENCA_PRE',
//             // 'OBSE_PRE',

//             ['class' => 'yii\grid\ActionColumn'],
//         ],
//    ]);?>
</div>
