<?php

/* @var $this yii\web\View */
/* @var $model app\models\Devolucion */

$this->title = 'Nueva Devolucion';
$this->params['breadcrumbs'][] = ['label' => 'Devoluciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devolucion-create">

    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
