<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DevueltoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Devueltos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devuelto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Devuelto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_DVS',
            'DEVO_DVS',
            'PRES_DVS',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
