<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prestado */

$this->title = 'Update Prestado: ' . $model->ID_PRS;
$this->params['breadcrumbs'][] = ['label' => 'Prestados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_PRS, 'url' => ['view', 'id' => $model->ID_PRS]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prestado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
