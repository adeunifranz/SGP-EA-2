<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Piso */

$this->title = 'Modificar Piso: ' . $model->ID_PIS;
$this->params['breadcrumbs'][] = ['label' => 'Pisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_PIS, 'url' => ['view', 'id' => $model->ID_PIS]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="piso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
