<?php

use kartik\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Prestamo */

$this->title = 'Nuevo Prestamo';
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamo-create">

    <h1><?php /* echo Html::encode($this->title) */?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'modelp' => $modelp
    ]) ?>
    
</div>
