<?php

use yii\bootstrap\Dropdown;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Persona */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="persona-form">
  <div class="box container">
  <div class="box-body pad table-responsive">    
    <div class="col-lg-6">
    <?php $form = ActiveForm::begin(); ?>

    <?php /*echo $form->field($model, 'ID_PER')->textInput(['maxlength' => true, 'value'=>$model->ID_PER, 'readonly'=>'readonly']) */?>

    <?= $form->field($model, 'NOMB_PER',[
        'inputOptions' => [
                'class' => 'form-control transparent',
                'placeholder' => 'escriba su nombre',
                'style'=>'text-transform: uppercase',
                'onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'APPA_PER',[
        'inputOptions' => [
            'class' => 'form-control transparent',
            'placeholder' => 'escriba su apellido paterno',
                'style'=>'text-transform: uppercase',
                'onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'APMA_PER',[
        'inputOptions' => [
            'class' => 'form-control transparent',
            'placeholder' => 'escriba su apellido materno',
                'style'=>'text-transform: uppercase',
                'onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CAID_PER',[
        'inputOptions' => [
            'class' => 'form-control transparent',
            'placeholder' => 'escribe su carnet de identidad',
                'style'=>'text-transform: uppercase',
                'onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']])->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-lg-6">
    <?= $form->field($model, 'DIRE_PER',[
        'inputOptions' => [
            'class' => 'form-control transparent',
            'placeholder' => 'escribe su direccion',
                'style'=>'text-transform: uppercase',
                'onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TELE_PER')->textInput(['class'=>'form-control','maxlength' => true,
                'style'=>'text-transform: uppercase',
                'onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>

  <div class="pad table-responsive" style="padding: 0px;">
<?php echo
                  $form->field($model, 'REUN_PER')
                      ->radioList([
                                            'ESTUDIANTE'    => 'ESTUDIANTE',
                                            'DOCENTE'       => 'DOCENTE',
                                            'ADMINISTRATIVO'  => 'ADMINISTRATIVO',
                      ],
                                  [
                                      'item' => function($index, $label, $name, $checked, $value) {

                                          if ($index == 0) {
                                              $bg="lightgreen";
                                          } elseif ($index == 1) {
                                              $bg="lightblue";
                                          } elseif ($index == 2) {
                                              $bg="lightgray";
                                          }                               
                                          if ($checked == 1) {
                                              $ch="checked";
                                          } else {
                                              $ch="";
                                          }

                                          $return = '<label class="btn col-sm-4"';
                                          $return .=' style="background:'.$bg;
                                          $return .=';padding-left:0px;';
                                          $return .='">';
                                          $return .='&nbsp;';
                                          $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3" '.$ch.'>';
                                          $return .= '<i> &nbsp; </i>';
                                          $return .= '<span>' . ucwords($label) . '</span>';
                                          $return .= '</label>';

                                          return $return;
                                      }
                                  ]
                    );
           ?>
    </div>
    <p>&nbsp;</p>
     <div class="form-group col-lg-12">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Actualizar', 
            ['class' => $model->isNewRecord ? 'btn  btn-lg btn-success col-lg-6' : 'btn btn-primary btn-lg col-lg-6']) ?>
        <?= Html::a('Cancelar', ['/persona'], ['class' => 'btn btn-default btn-lg col-lg-6',])  ?>        
    </div>
</div>
</div>
</div>
    <?php ActiveForm::end(); ?>

</div>
