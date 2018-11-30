<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Modificar datos de usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php $dataProvider->pagination = ['pageSize' => 5]; ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'tableOptions' => ['class'=>'table table bordered'],
        'summary'=>false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'username',
            'label'=> 'Nombre de usuario',
            'format' => 'raw',
            'value' => function ($model) { return Html::a($model->username, [ 'update', 'id' => $model->id, ], ['style'=> 'color:green;'/*'target' => '_blank'*/]); }
             ],
        ],
    ]);?>
</div>