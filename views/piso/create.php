<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Piso */

$this->title = 'Nuevo Piso';
$this->params['breadcrumbs'][] = ['label' => 'Pisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="piso-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
