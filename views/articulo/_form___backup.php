<?php 
use kartik\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\widgets\TimePicker;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\widgets\Pjax;



$this->registerJS('
    $("#modalbutton").hide();
    link = $("#modalbutton").attr("href");
    $("#articulo-tipo_art").on("change",function(){
        if($("#articulo-tipo_art").val()==""){
            $("#modalbutton").hide();
        } else {
            console.log($("#articulo-tipo_art").val());
            $("#modalbutton").attr("href", link + "&id="+$("#articulo-tipo_art").val());
            $("#modalbutton").show();
            // $("#articulo-tipo_art option:selected").each(function () {
            //         var id = $(this).val();
            //         $(".modal").find("#titulo-modal").html(id.toUpperCase());
            //         //console.log(id);
            //         $.ajax({
            //           type: "POST",
            //           url: $("#modalbutton").attr("href"),
            //           data: {"id":id},
            //           success: function(data){
            //                 $(".modal-body").html(data)
            //               }
            //         });
            // });
        }
    });
    $(function(){
      $(".modalButton").click(function(){
        $.get($(this).attr("href"), function(data) {
          //console.log(data);
          var id = $("#articulo-tipo_art").val().toUpperCase();
            $(".modal").find("#titulo-modal").html(id);
            $(".modal").modal("show").find(".modal-body").html(data);
        });
        return false;
      });
    });
    $("#articulo-tipo_art").change(function () {
      //console.log($("#modalbutton").attr("href"));
    });
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
');
$this->registerCSS('
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
');
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

?>

<script type="text/javascript">

</script>

              <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
              <div class="modal-dialog modal-md" style="padding: 0;margin: 0">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="modal-title" id="myModalLabel"><strong><h3 id="titulo-modal"></h3></strong></div>
                  </div>
                  <div class="modal-body">

                  </div>
                  <div class="modal-footer">
                  </div>
                </div>
              </div>
            </div>





      <div class="articulo-form">
        <div class="container">
          <div class="col-lg-6">      
          <?php $form = ActiveForm::begin([
                          'options'=>['enctype'=>'multipart/form-data'],
                          "enableAjaxValidation"    => true
                          ]); ?>
          <?= $form->field($model, 'COAS_ART', [
                  'template' => "{label}\n".
                                "<div class='input-group'>\n".
                                "{input}\n".
                                "<span class='input-group-addon'>ejm. 00-00-00-PB-AAA-12345</span>\n".
                                "</div>\n".
                                "{error}\n".
                                "{hint}"
              ])->textInput(['maxlength' => true,'placeholder'=> '00-00-00-PB-AAA-12345', 'autofocus'=>true, 'style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>

          <?= $form->field($model, 'MARC_ART')->textInput(['style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>

          <?= $form->field($model, 'SERI_ART')->textInput(['style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>

          <?= $form->field($model, 'DETA_ART')->textInput(['style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>
  
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

          <?= $form->field($model, 'COLO_ART')->textInput(['style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>
          <div class="col-lg-6" style="padding-left:0">
            <?php echo $form->field($model, 'FEAL_ART')->textInput(['readonly'=>false, 'type'=>'date']); ?>
          </div>
          <div class="col-lg-6" style="padding-right: 0">
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


      </div>

          <div class="col-lg-5">


          <?= $form->field($model, 'OBSE_ART')->textarea(['rows' => 6, 'style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>

          <span class="btn btn-default btn-file" style="margin-left: 30%;">
          <?= $form->field($model, 'foto')->fileInput(['accept'=>".jpg, .jpeg, .png, .gif", 'class'=>'btn-default'])->label(false); ?>
          <!--canvas id="FOTO" width="100" height="100" style="border:1px solid #000000;"></canvas><br-->
          <img <?php  
                    if ($model->FOTO_ART!==null) 
                      { ?> 
                        src="<?= '../web/files/'.$model->FOTO_ART ?>" 
                <?php } else 
                      { ?> 
                        src="<?= '../web/files/blank.png' ?>" 
                <?php } ?> 
            id="FOTO" width="100" height="100" style="border:1px solid #000000;"><br>
          <i class="fa fa-camera"></i> Foto
          </span>

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
                    'append' => [
                                'content' => Html::button('<i class="fa fa-navicon"></i>', [
                                    'class' => 'modalButton btn btn-primary', 
                                    'title' => 'Detalles', 
                                    'data-toggle' => 'modal', 
                                    'data-target' => '#largeModal',                                    
                                    'href' => Yii::$app->urlManager->createAbsoluteUrl(['articulo/accesorio']),
                                    'id' => 'modalbutton'
                                ]),
                                'asButton' => true
                            ]                    
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
                                                ])->textarea(['maxlength' => true]) ?>

            <?= $form->field($model, 'FUNC_ACC',[
                'inputOptions' => [
                        'class'         => 'form-control transparent',
                        'placeholder'   => 'funcion que cumple el accesorio',
                        'style'         => 'text-transform: uppercase',
                        'onblur'        => 'javascript:this.value=this.value.toUpperCase().trim();']
                                               ])->textInput(['maxlength' => true]) ?>

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
    </div>
