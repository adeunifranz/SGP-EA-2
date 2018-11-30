<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Computadora */

$this->title = 'Update Computadora: ' . $model->ID_COM;
$this->params['breadcrumbs'][] = ['label' => 'Computadoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_COM, 'url' => ['view', 'id' => $model->ID_COM]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="computadora-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
