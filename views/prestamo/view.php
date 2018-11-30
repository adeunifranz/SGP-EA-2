<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use mdm\admin\components\Helper;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Prestamo */

$this->title = 'Registro N° '.$model->ID_PRE;
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamo-view">

    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>
    <p>
        <?= Html::a('Volver', ['volver'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Prestamos', ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Actualizar', ['update', 'id' => $model->ID_PRE], ['class' => 'btn btn-primary']) ?>

        <?php
            if (Helper::checkRoute('prestamo/delete')) {
                Modal::begin([
                    'header' => '<h2>Cuidado</h2>',

                    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>'.

                                Html::a('Eliminar', ['delete', 'id' => $model->ID_PRE], [
                                                    'class' => 'btn btn-danger',
                                                    'data' => [
                                                        'method' => 'post',
                                                    ],
                                                ])
                    ,

                    'toggleButton' => ['label' => 'Eliminar', 'class' => 'btn btn-danger'],
                    'options' => ['class' => 'modal modal-warning'],
                ]);
                
                echo 
                'Esta seguro de eliminar el articulo?'.'<br>'.'<br>'.'</div>';

                Modal::end();
            }

         ?>



    </p>
    <div class="container">
        <div class="col-lg-5">
        <?= DetailView::widget([
            'model' => $model,
            'options' => [
                'class' => 'table table-bordered',
            ],
            'attributes' => [
                //'ID_PRE',
                ['attribute'=>'FECH_PRE',
                 'value' => date("d-m-Y",strtotime($model->FECH_PRE))],

                'HORA_PRE',
                [
                    'attribute'=>'PERS_PRE',
                    'value' => function($data){
                        return app\models\Prestamo::get_PERSPRE($data->PERS_PRE);},
                ],
                [
                    'attribute'=>'LUGA_PRE',
                    'value' => function($data){
                        return app\models\Prestamo::get_LUGAPRE($data->LUGA_PRE);},
                ],
                'DOCU_PRE',
                [
                    'attribute'=>'ENCA_PRE',
                    'value' => function($data){
                        return app\models\Prestamo::get_ENCAPRE($data->ENCA_PRE);},
                ],
                'OBSE_PRE',
            ],
        ]) ?>
        </div>
        <div class="col-lg-6">
            <?php /*$ARTI_PRS = ArrayHelper::map(app\models\Articulo::find()->where('ID_ART',['ID_ART'=>'ARTI_PRS'])->all(), 'ID_ART', 'DETA_ART');*/ 
            $dataProvider->pagination=false;
            ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => false,
            //        'filterModel' => $searchModel,
/*                      'columns' => [
                      [
                            'attribute'=>'ARTI_PRS',
                            'value' => function($data){
                                return app\models\Prestado::get_ARTIPRS($data->ARTI_PRS);
                            },
            //                'filter' => $ARTI_PRS,
                        ],
                    ],
*/                
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute'=>'ARTI_PRS',
                            'label' => 'ARTICULO',
                            'value' => function($data){
                                return app\models\Prestado::get_ARTIPRS($data->ARTI_PRS);
                            },
            //                'filter' => $ARTI_PRS,
                        ],
                    ],
                ]); ?>
        </div>
    </div>
</div>
