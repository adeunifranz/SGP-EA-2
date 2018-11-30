<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComputadoraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Computadoras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computadora-index">

    <h1><?php /*echo  Html::encode($this->title)*/ ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php $dataProvider->pagination = ['pageSize' => 5]; ?> 
    <?php if (Helper::checkRoute('create')) {?>
    <p>
        <?= Html::a('Nueva Computadora', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID_COM',
            'SIOP_COM',
            'PROC_COM',
            // 'MEMO_COM',
            // 'DIDU_COM',
            // 'TAVI_COM',
            // 'ARTI_COM',
            'TIPO_COM',

            ['class' => 'yii\grid\ActionColumn', 'template' => Helper::filterActionColumn('{view} {update} {delete} ')],        ],
    ]); ?>
</div>
