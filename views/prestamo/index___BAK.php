<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrestamoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestamos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Prestamo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_PRE',
            'FECH_PRE',
            'HORA_PRE',
            'PERS_PRE',
            'LUGA_PRE',
            // 'FEDE_PRE',
            // 'HODE_PRE',
            // 'DOCU_PRE',
            // 'ENCA_PRE',
            // 'OBSE_PRE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
