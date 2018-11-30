<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Computadora */

$this->title = 'Registro N° '.$model->ID_COM;
$this->params['breadcrumbs'][] = ['label' => 'Computadoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computadora-view">

    <h1><?php /* echo Html::encode($this->title)*/ ?></h1>

    <p>
        <?= Html::a('Volver', ['volver'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Computadoras', ['index'], ['class' => 'btn btn-warning']) ?>
        <?php if (Helper::checkRoute('update')) {?>
            <?= Html::a('Actualizar', ['update', 'id' => $model->ID_COM], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
        <?php if (Helper::checkRoute('delete')) {?>
            <?php 
                    Modal::begin([
                        'header' => '<h2>Cuidado</h2>',

                        'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>'.

                                    Html::a('Eliminar', ['delete', 'id' => $model->ID_COM], [
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
                    'Esta seguro de eliminar el registro?'.'<br>'.'<br>'.'</div>';

                    Modal::end();
             ?>

         <?php } ?>


    </p>
    <div class="col-lg-5">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID_COM',
            'SIOP_COM',
            'PROC_COM',
            'MEMO_COM',
            'DIDU_COM',
            'TAVI_COM',
            [
                'attribute'=>'TIPO_COM',
                'value' => function($data){
                    return app\models\Computadora::get_TIPO($data->TIPO_COM);},
            ],
            [
                'attribute'=>'ARTI_COM',
                'value' => function($data){
                    return app\models\Computadora::get_ARTI($data->ARTI_COM);},
            ],
        ],
    ]) ?>
    </div>
</div>
