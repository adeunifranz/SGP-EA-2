<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use mdm\admin\components\Helper;
/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = 'Registro N° '.$model->ID_PER;
$this->params['breadcrumbs'][] = ['label' => 'Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-view">

    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>

    <p>
    <?php if (Helper::checkRoute('persona/')) {?>
        <p align="left">
            <?= Html::a('<i class="fa fa-reply"></i> Anterior', ['/persona/listado'], ['class' => 'btn btn-xs bg-purple']) ?>
        </p>
    <?php } ?>

    </p>
    <section>
    <div class="box-body pad table-responsive col-xs-6">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'ID_PER',
            'NOMB_PER',
            'APPA_PER',
            'APMA_PER',
            'CAID_PER',
            'DIRE_PER',
            'TELE_PER',
            'REUN_PER',
        ],
    ]) ?>
    </div>
    </section>
</div>
