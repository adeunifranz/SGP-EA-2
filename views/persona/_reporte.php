<?php 
use kartik\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use mdm\admin\components\Helper;

$this->registerJS('
    document.getElementById("reporte-todo").checked=false;
    $("#reporte-todo").on("change", function(){
        var val = document.getElementById("reporte-todo").checked;
        if(val) {
            $(".field-reporte-fecha_ini").fadeOut();
            $(".field-reporte-fecha_fin").fadeOut();
        } else {
            $(".field-reporte-fecha_ini").fadeIn();
            $(".field-reporte-fecha_fin").fadeIn();
        }
    });
    ');

$this->title='SELECCION';

// echo '<pre>';
// print_r($personas);
// echo '</pre>';

?>
<div class="reporte-form">

    <?php $form = ActiveForm::begin(['options'=>['target'=>'_blank']]); ?>

<div class="col-xs-12">
            <?=  
$form->field($model, 'seleccion')->widget(Select2::classname(), [
        'data' => \app\models\Devolucion::get_Personas(),
        'theme' => Select2::THEME_BOOTSTRAP,
        'language'      => 'es',
        'options'       => ['placeholder'=>'--Elija uno--'],
        'pluginOptions' => ['allowClear'=>true],
        'pluginEvents'  => ['change'=>''],
        'addon' => [
            'prepend' => [
                'content' => Html::icon('arrow-right')
            ],
        ]
    ]);
?>
<?php  $model->fecha_ini = date("Y-01-01"); ?>
<?php  $model->fecha_fin = date("Y-m-d"); ?>
<div class="col-xs-4">
    <?= $form->field($model, 'todo')->checkbox() ?>
</div>
<div class="col-xs-4">
    <?= $form->field($model, 'fecha_ini')->textInput(['type'=>'date']) ?>
</div>
<div class="col-xs-4">
    <?= $form->field($model, 'fecha_fin')->textInput(['type'=>'date']) ?>
</div>
</div>
<div class="col-xs-12">
<?= 
                Html::submitButton('<i class="fa fa-file-pdf-o"></i> Reporte', ['class' => 'col-xs-6 btn btn-xl bg-red']).
                Html::a('<i class="fa fa-ban"></i> Cancelar', ['/persona'], ['class' => 'col-xs-6 btn btn-xl btn-default'])
?>
</div>

    <?php ActiveForm::end(); ?>
</div>
