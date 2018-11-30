<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = 'Actualizar Registro Persona: ' . $model->ID_PER;
$this->params['breadcrumbs'][] = ['label' => 'Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_PER, 'url' => ['view', 'id' => $model->ID_PER]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="persona-update">

    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
