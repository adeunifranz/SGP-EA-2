<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ambiente */

$this->title = 'Modificar Registro Nº: ' . $model->ID_AMB;
$this->params['breadcrumbs'][] = ['label' => 'Ambientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_AMB, 'url' => ['view', 'id' => $model->ID_AMB]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="ambiente-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
