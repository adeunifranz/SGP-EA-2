<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PisoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pisos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="piso-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Piso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'NOMB_PIS',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
