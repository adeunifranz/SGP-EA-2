<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Devuelto */

$this->title = 'Update Devuelto: ' . $model->ID_DVS;
$this->params['breadcrumbs'][] = ['label' => 'Devueltos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_DVS, 'url' => ['view', 'id' => $model->ID_DVS]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="devuelto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
