<?php 
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\widgets\TimePicker;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\widgets\Pjax;



$CSS=<<<CSS
#accesorio, #computadora, #monitor, #mouse, #parlante, #teclado, #varios {
  display: none;
}

.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
input#articulo-feal_art, input#articulo-hoal_art {
    text-align: center;
}
CSS;
$this->registerCSS($CSS);
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

?>

      <div class="articulo-form">
        <div class="container">
          <div class="col-lg-6">      
          <?php $form = ActiveForm::begin([
                          'options'=>['enctype'=>'multipart/form-data'],
                          ]); ?>
          <?= $form->field($model, 'COAS_ART', [
                  'template' => "{label}\n".
                                "<div class='input-group'>\n".
                                "{input}\n".
                                "<span class='input-group-addon' style='background-color:#EEE'>ejm. 00-00-00-PB-AAA-12345</span>\n".
                                "</div>\n".
                                "{error}\n".
                                "{hint}"
              ])->textInput(['maxlength' => true,'placeholder'=> '00-00-00-PB-AAA-12345', 'autofocus'=>true, 'style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>
          <div class="col-sm-4" style="padding-left: 0">
          <?= $form->field($model, 'MARC_ART')->textInput(['style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>
          </div>
          <div class="col-sm-4" style="padding-left: 0">
          <?= $form->field($model, 'SERI_ART')->textInput(['style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>
          </div>
          <div class="col-sm-4" style="padding: 0">
          <?= $form->field($model, 'COLO_ART')->textInput(['style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>
          </div>
          <?= $form->field($model, 'DETA_ART')->textInput(['style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>

          <span class="col-sm-9"> 
          <?= $form->field($model, 'OBSE_ART')->textarea(['rows' => 5, 'style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>
          </span>

          <span class="btn btn-default btn-file col-sm-3">
          <?= $form->field($model, 'foto')->fileInput(['accept'=>".jpg, .jpeg, .png, .gif", 'class'=>'btn-default'])->label(false); ?>
          <!--canvas id="FOTO" width="100" height="100" style="border:1px solid #000000;"></canvas><br-->
          <img <?php  
                    if ($model->FOTO_ART!==null) 
                      { ?> 
                        src="<?= 
                        //'../web/files/'.$model->FOTO_ART 
                        Url::base('http').'/files/'.$model->FOTO_ART 
                        ?>" 
                <?php } else 
                      { ?> 
                        src="<?= '../web/files/blank.png' ?>" 
                <?php } ?> 
            id="FOTO" width="100" height="100" style="border:1px solid #000000;"><br>
          <!--i class="fa fa-camera"></i--> Foto
          </span>

          <?= $form->field($model, 'ESTA_ART')->hiddenInput(['value'=>'BUENO'])->label(false); ?>

          <?php /*echo
          $form->field($model, 'ESTA_ART')->dropdownList([
              'BUENO' => 'BUENO',
              'MALO' => 'MALO',
          ],
              ['prompt'=>'Elija una opcion']
          );*/?>

          <?php 
          if ($model->isNewRecord) {
            $model->FEAL_ART = date("Y-m-d");
            $model->HOAL_ART = date("H:i:s");
          }
          else {
            //$preview = '../web/files/'.$model->FOTO_ART;
            $model->FEAL_ART = Yii::$app->formatter->asDate($model->FEAL_ART, 'php:Y-m-d');
      //      $model->HOAL_ART = Yii::$app->formatter->asDate($model->HOAL_ART, 'php:H:i:s');
            //$model->HOAL_ART = date("H:i:s",strtotime($model->HOAL_ART));
          }
           ?>

          <div class="col-sm-6">
            <?php echo $form->field($model, 'FEAL_ART')->textInput(['readonly'=>false, 'type'=>'date']); ?>
          </div>
          <div class="col-sm-6">
            <?php echo $form->field($model, 'HOAL_ART')->widget(TimePicker::classname(), [
              'name' => 'HOAL_ART',
                  'pluginOptions' => [
                      'showSeconds' => true,
                      'showMeridian' => false,
                      'minuteStep' => 1,
                      'secondStep' => 5,
                  ]
              ]); ?>
          </div>

          <?php 
                  //$model->ASIG_ART=0;
                  echo $model->ASIG_ART;
          echo
                  $form->field($model, 'ASIG_ART')
                      ->radioList([0 => 'Prestamo', 1 =>'Activo Fijo', 2=>'Solo depósito'],
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

                                          $return = '<label class="btn col-sm-4" style="background:'.$bg.'">&nbsp;';
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

      <div class="col-lg-5">
    <?php 

    $tipos_articulos = [

              'accesorio'   => 'ACCESORIO',
              'computadora' => 'COMPUTADORA',
              'monitor'     => 'MONITOR',
              'mouse'       => 'MOUSE',
              'parlante'    => 'PARLANTE',
              'teclado'     => 'TECLADO',
              'varios'      => 'VARIOS',

    ];



      Pjax::begin();

       echo 

        $form->field($model, 'tipo_art')->widget(Select2::classname(), [
                'data' => $tipos_articulos,
                'theme' => Select2::THEME_BOOTSTRAP,
                'language'      => 'es',
                'options'       => ['placeholder'=>'--Elija uno--'],
                'pluginOptions' => ['allowClear'=>true],
                'addon' => [
                    'prepend' => [
                        'content' => Html::icon('arrow-right')
                    ],
                ]
            ]);

      Pjax::end();

    ?>
          <div class="col-lg-12" id="accesorio">

            <?= $form->field($model, 'ESPE_ACC',[
                'inputOptions' => [
                        'class'         => 'form-control transparent',
                        'placeholder'   => 'especificaciones tecnicas',
                        'style'         => 'text-transform: uppercase',
                        'rows'          => 6,
                        'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                                ])->textarea(['maxlength' => true])->label(false); ?>

            <?= $form->field($model, 'FUNC_ACC',[
                'inputOptions' => [
                        'class'         => 'form-control transparent',
                        'placeholder'   => 'funcion que cumple el accesorio',
                        'style'         => 'text-transform: uppercase',
                        'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                               ])->textInput(['maxlength' => true])->label(false); ?>


            <?= $form->field($model, 'ARTI_ACC')->hiddenInput(['value'=>1])->label(false); ?>

          </div>
          <div class="col-lg-12" id="computadora">

    <?= $form->field($model, 'SIOP_COM',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'sistema operativo',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                        ])->textInput(['maxlength' => true])->label(false); ?>

    <?= $form->field($model, 'PROC_COM',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'procesador',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>

    <?= $form->field($model, 'MEMO_COM',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'memoria RAM',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>

    <?= $form->field($model, 'DIDU_COM',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'disco duro o memoria interna',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>

    <?= $form->field($model, 'TAVI_COM',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'tarjeta de video (si tiene)',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>

<?php 
   $tipos_computadora = [
              '1' => 'PC',
              '2' => 'LAPTOP',
              '3' => 'CELULAR',
              '4' => 'TABLET',
    ];

 ?>

    <?= 
        $form->field($model, 'TIPO_COM')->dropdownList($tipos_computadora);
     ?>

    <?= $form->field($model, 'ARTI_ACC')->hiddenInput(['value'=>1])->label(false); ?>

          </div>
          <div class="col-lg-12" id="monitor">
    <?= $form->field($model, 'TAMA_MON',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'tamaño del monitor',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>
    <?= $form->field($model, 'TIPO_MON',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'tipo de monitor (CRT, LCD, LED)',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>
    <?= $form->field($model, 'ENTR_MON',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'tipo de entrada (VGA, DVI, HDMI)',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>

    <?= $form->field($model, 'ARTI_MON')->hiddenInput(['value'=>1])->label(false); ?>
          </div>
          <div class="col-lg-12" id="mouse">
    <?= $form->field($model, 'TIPO_MOU',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'tipo de mouse (OPTICO, TRACKBALL)',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>
    <?= $form->field($model, 'ENTR_MOU',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'tipo de entrada (SERIAL, PS2, USB)',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>

    <?= $form->field($model, 'ARTI_MOU')->hiddenInput(['value'=>1])->label(false); ?>
          </div>
          <div class="col-lg-12" id="parlante">
    <?= $form->field($model, 'NELE_PAR',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'numero de elementos (1, 2, 2.1, 5.1, 7.1)',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>
    <?= $form->field($model, 'ENTR_PAR',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'tipo de entrada (RCA, USB)',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>
    <?= $form->field($model, 'ARTI_PAR')->hiddenInput(['value'=>1])->label(false); ?>
          </div>
          <div class="col-lg-12" id="teclado">
    <?= $form->field($model, 'DIST_TEC',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'distribucion (latinoamerica español inglés)',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>

    <?= $form->field($model, 'ENTR_TEC',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'tipo de entrada (SERIAL, PS2, USB)',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>
    <?= $form->field($model, 'ARTI_TEC')->hiddenInput(['value'=>1])->label(false); ?>
          </div>
          <div class="col-lg-12" id="varios">
    <?= $form->field($model, 'DETA_VAR',[
        'inputOptions' => [
                'class'         => 'form-control transparent',
                'placeholder'   => 'descripcion del articulo varios',
                'style'         => 'text-transform: uppercase',
                'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                       ])->textInput(['maxlength' => true])->label(false); ?>

    <?= $form->field($model, 'ARTI_VAR')->hiddenInput(['value'=>1])->label(false); ?>
          </div>
              <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Actualizar', 
              ['class' => $model->isNewRecord ? 'btn  btn-lg btn-success col-lg-6' : 'btn btn-primary btn-lg col-lg-6']) ?>
              <?= Html::a('Cancelar', ['/articulo'], ['class' => 'btn btn-default btn-lg col-lg-6',])  ?>
          </div>
      </div>
      </div>
    </div>
  </div>
          <?php ActiveForm::end(); ?>
<?php 
$JS = <<< JS
    if($("#articulo-tipo_art").val()!="") {
      var sel = $("#"+$("#articulo-tipo_art").val());
          sel.show();
    }
    var opt = $("#articulo-tipo_art").val();
    $(document).on("click",
        function () {
          if($("#articulo-tipo_art").val()!="") {
            opt = $("#articulo-tipo_art").val();
            //console.log(opt);
          }
        }
    );    
    $("#articulo-tipo_art").on("change",        
        function () {         
          if($("#articulo-tipo_art").val()!="") {
            var sel=$("#"+$("#articulo-tipo_art").val());
            if(opt!=""){
              $("#"+opt).hide();
            }
            opt = $("#articulo-tipo_art").val();
            sel.fadeIn("slow");
            sel.find('input, textarea').val('');
          } else {
            if (opt!=null) {
              $("#"+opt).hide();
              opt="";
            }
          }
        }
    );
    $("#articulo-foto").on("change", 
        function preview_image(event)
        {
         var reader = new FileReader();
         reader.onload = function()
         {
          document.getElementById("FOTO");
          var output = document.getElementById("FOTO");
          output.src = reader.result;
         }
         reader.readAsDataURL(event.target.files[0]);
        }
  );
JS;

$this->registerJs($JS);
?>
    </div>
