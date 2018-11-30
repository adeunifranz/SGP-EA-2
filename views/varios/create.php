<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Varios */

$this->title = 'Create Varios';
$this->params['breadcrumbs'][] = ['label' => 'Varios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="varios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
