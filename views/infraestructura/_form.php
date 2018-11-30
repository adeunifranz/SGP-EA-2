<?php 
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
 ?>
<div class="piso-form">

        <?php if (Helper::checkRoute('index')) {?>       	
        <?= Html::submitButton(
        	'<i class="fa fa-save text-default"> Guardar Cambios </i>', 
        	['class' => 'btn btn-success']) 

        ?>        	
        <?php } ?>

        <?php if (Helper::checkRoute('index')) {?>       	
            <?= Html::a('<i class="fa fa-hand-stop-o text-default"> Cancelar </i>', ['index'], 
            ['class' => 'btn btn-warning']) ?>
        <?php } ?>

    </p>
<?php 
  Modal::begin([
      'header' => '<h2>Agregar Planta</h2>',
      'toggleButton' => [
      	'label' => '<i class="fa fa-plus text-default"> AGREGAR PLANTA </i>',
        'class' =>  'btn btn-info',
    	'style' =>  'border-radius: 0px 0px 15px 0px;'.
				    'padding-top: 10px;'.
				    'padding-bottom: 10px;'.
				    'border-bottom: 2px solid rgba(0,0,0,0.2);'.
				    'border-right: 2px solid rgba(0,0,0,0.2);'
      ],
  ]);

    $form = ActiveForm::begin();

    ?>
    <div class="form-group">
 	<?php 
    $form->field($model, 'NOMB_PIS')->textInput(
        [
            //'class'         =>'col-sm-3',
            'maxlength'     => true,
            'placeholder'   =>'NOMBRE DE LA PLANTA',
            'style'         =>
						'border-radius: 0px 0px 15px 0px;'.
					    'padding-top: 10px;'.
					    'padding-bottom: 10px;'.
					    'border-bottom: 2px solid rgba(0,0,0,0.2);'.
					    'border-right: 2px solid rgba(0,0,0,0.2);'.
            			'text-transform: uppercase;'.
            			'margin-top: 5px;'
            			,
            'onblur'        =>'javascript:this.value=this.value.toUpperCase().trim().replace(/  +/g, " ");'
        ]
    	)->label(false);
    	?>

     <div class="col-sm-12">

     	<?php 
        echo Html::button('<i class="fa fa-trash text-default"> Eliminar </i>', 
        [
        	'class' =>  'btn btn-danger col-sm-2',
        	'style' =>  'border-radius: 0px 0px 15px 0px;'.
					    'padding-top: 0px;'.
					    'padding-bottom: 0px;'.
					    'border-bottom: 2px solid rgba(0,0,0,0.2);'.
					    'border-right: 2px solid rgba(0,0,0,0.2);'
        ]);
        echo Html::button('<i class="fa fa-plus text-default"> Agregar ambiente </i>', 
        [
        	'class' =>  'btn btn-primary col-sm-2',
        	'style' =>  'border-radius: 0px 0px 15px 0px;'.
					    'padding-top: 0px;'.
					    'padding-bottom: 0px;'.
					    'border-bottom: 2px solid rgba(0,0,0,0.2);'.
					    'border-right: 2px solid rgba(0,0,0,0.2);'
        ]);
         ?>
    </div>

    </div>
        <?php ActiveForm::end(); ?>

<?php 
  Modal::end();

 ?>

        <?= Html::button('<i class="fa fa-plus text-default"> AGREGAR PLANTA </i>', 
        [
        	'class' =>  'btn btn-info',
        	'style' =>  'border-radius: 0px 0px 15px 0px;'.
					    'padding-top: 10px;'.
					    'padding-bottom: 10px;'.
					    'border-bottom: 2px solid rgba(0,0,0,0.2);'.
					    'border-right: 2px solid rgba(0,0,0,0.2);'
        ]) ?>
    <br>


</div>
