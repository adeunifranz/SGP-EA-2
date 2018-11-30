<?php 
use yii\helpers\Html;
use mdm\admin\components\Helper;

$this->title = 'Infraestructura';
$this->params['breadcrumbs'][] = $this->title;
 ?>
    <div class="infraestructura-index">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

