<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Varios */

$this->title = 'Update Varios: ' . $model->ID_VAR;
$this->params['breadcrumbs'][] = ['label' => 'Varios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_VAR, 'url' => ['view', 'id' => $model->ID_VAR]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="varios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
