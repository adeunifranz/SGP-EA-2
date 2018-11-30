<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ambiente */

$this->title = 'Registro Nº '.$model->ID_AMB;
$this->params['breadcrumbs'][] = ['label' => 'Ambientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ambiente-view">


    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->ID_AMB], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->ID_AMB], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar este registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'NOMB_AMB',
            [
                'label' => 'UBICACION DE LA PLANTA',
                'attribute'=>'PISO',
            ]
        ],
    ]) ?>

</div>
