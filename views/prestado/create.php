<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Prestado */

$this->title = 'Create Prestado';
$this->params['breadcrumbs'][] = ['label' => 'Prestados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
