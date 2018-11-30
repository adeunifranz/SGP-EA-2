<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Devuelto */

$this->title = 'Create Devuelto';
$this->params['breadcrumbs'][] = ['label' => 'Devueltos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devuelto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
