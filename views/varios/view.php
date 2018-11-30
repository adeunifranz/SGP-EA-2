<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Varios */

$this->title = $model->ID_VAR;
$this->params['breadcrumbs'][] = ['label' => 'Varios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="varios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID_VAR], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID_VAR], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID_VAR',
            'TIPO_VAR',
            'ARTI_VAR',
        ],
    ]) ?>

</div>
