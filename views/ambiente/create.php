<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ambiente */

$this->title = 'Nuevo Ambiente';
$this->params['breadcrumbs'][] = ['label' => 'Ambientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ambiente-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
