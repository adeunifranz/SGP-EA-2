<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;
use yii\bootstrap\Modal;

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
        <?php if (Helper::checkRoute('update')) {?>
            <?= Html::a('Actualizar', ['update', 'id' => $model->ID_DEV], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
        <?php if (Helper::checkRoute('delete')) {?>
            <?php 
                    Modal::begin([
                        'header' => '<h2>Cuidado</h2>',

                        'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>'.

                                    Html::a('Eliminar', ['delete', 'id' => $model->ID_DEV], [
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
<div class="col-lg-6 col-lg-offset-3">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
            'label' => 'ARTICULO PRESTADO',
            'attribute'=>'PRES_DEV',
            'value' => function($data){
                return app\models\Devolucion::get_ART($data->PRES_DEV);},
            ],
            [
            'label' => 'FECHA DE PRESTAMO',
            'attribute'=>'PRES_DEV',
            'value' => function($data){
                return Yii::$app->formatter->asDate(app\models\Devolucion::get_FP($data->PRES_DEV),'php:l, jS \d\e F \d\e Y');},
            ],
            [
            'label' => 'HORA DE PRESTAMO',
            'attribute'=>'PRES_DEV',
            'value' => function($data){
                return app\models\Devolucion::get_HP($data->PRES_DEV);},
            ],
            [
            'attribute'=>'FECH_DEV',
            'value' => function($data){
                return Yii::$app->formatter->asDate($data->FECH_DEV,'php:l, jS \d\e F \d\e Y');},
            ],
            'HORA_DEV',
            'OBSE_DEV',
            [
            'attribute'=>'ENCA_DEV',
            'value' => function($data){
                return app\models\Devolucion::get_ENCADEV($data->ENCA_DEV);},
            ],
        ],
    ]) ?>
    </div>

</div>
