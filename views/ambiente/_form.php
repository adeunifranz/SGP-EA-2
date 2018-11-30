<?php

//use yii\helpers\Html;
use kartik\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Ambiente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ambiente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOMB_AMB')->textInput(
        [
            'maxlength'     => true,
            'placeholder'   =>'NOMBRE DEL AMBIENTE',
            'style'         =>'text-transform: uppercase',
            'onblur'        =>'javascript:this.value=this.value.toUpperCase().trim().replace(/  +/g, " ");'
        ]
    ) ?>
    <?php 
/*        if ($model->isNewRecord) {
*/            /*echo $form->field($model, 'articulo')->dropDownList($articulos,['prompt'=>'--Seleccione--']);*/
        echo 
            $form->field($model, 'NOMB_PISO')->widget(Select2::classname(), [
                'name'          => 'NOMB_PISO',
                'data'          => yii\helpers\ArrayHelper::map(\app\models\Piso::find()->all(), 'ID_PIS', 'NOMB_PIS'),
                'language'      => 'es',
                'options'       => [
                                    'class' => 'form-control transparent',
                                    'placeholder' => 'NOMBRE DEL PISO',
                                    'style'=>'text-transform: uppercase',
                                    'onblur'=>'javascript:this.value=this.value.toUpperCase().trim().replace(/  +/g, " ");',
                                    'value' => $model->PISO_AMB
                                    ],
                'pluginOptions' => ['allowClear'=>true,'multiple' => false, 'tags'=> true],
        ]);
/*        }*/
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
           <?= Html::a('Cancelar', yii\helpers\Url::to(['/ambiente']), ['class' => 'btn btn-default'])  ?>        
    </div>

    <?php ActiveForm::end(); ?>

</div>
