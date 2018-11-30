<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prestamo */

$this->title = 'Actualizar Prestamo: ' . $model->ID_PRE;
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_PRE, 'url' => ['view', 'id' => $model->ID_PRE]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prestamo-update">

    <h1><?php /* echo Html::encode($this->title) */?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'modelp' => $modelp
    ]) ?>

</div>
