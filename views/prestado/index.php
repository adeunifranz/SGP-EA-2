<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrestadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestado-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Prestado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_PRS',
            'ARTI_PRS',
            'PRES_PRS',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
