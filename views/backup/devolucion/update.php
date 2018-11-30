<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Devolucion */

$this->title = 'Actualizar Devolucion: ' . $model->ID_DEV;
$this->params['breadcrumbs'][] = ['label' => 'Devoluciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_DEV, 'url' => ['view', 'id' => $model->ID_DEV]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="devolucion-update">

    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
