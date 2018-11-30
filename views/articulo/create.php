<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Articulo */

$this->title = 'Nuevo Articulo';
$this->params['breadcrumbs'][] = ['label' => 'Articulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-create">

    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
