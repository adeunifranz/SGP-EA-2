<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Articulo */

$this->title = 'Actualizar Articulo: ' . $model->ID_ART;
$this->params['breadcrumbs'][] = ['label' => 'Articulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_ART, 'url' => ['view', 'id' => $model->ID_ART]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="articulo-update">

    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
