<?php

//use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\TimePicker;
use kartik\widgets\Select2;
use kartik\checkbox\CheckboxX;
use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Devolucion */
/* @var $form yii\widgets\ActiveForm */
$CSS=<<< CSS
#contenido {
 display: none;
}
.form-group.field-active0, .form-group.field-active1, .form-group.field-active2,
.form-group.field-active3, .form-group.field-active4, .form-group.field-active5,
.form-group.field-active6, .form-group.field-active7, .form-group.field-active8,
.form-group.field-active9 {
    margin-bottom: -10px;
}

.articulos {
  border-radius: 5px;
  border: 1px solid #f0f0fa;
  padding-right: 10px;
}
.rtable {
 display: table;
 width: 95%;
 border-radius: 5px;
 border: 1px solid #ccc;
}
.rtablerow {
  display:none;
 #display: table-row;
}
.rtablehead {
 display: table-header-group;
 background-color: #ddd;
 text-align: center;
 border-bottom: 1px solid #bbb;
}
.rtablebody {
 display: table-row-group;
}
.rtablefoot {
 display: table-footer-group;
 font-weight: bold;
 text-align: center;
 margin-bottom: 10px;
}
.rtablecell {
 display: table-cell;
 padding: 3px 10px;
}
.lch {
  display:table-cell;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  # -webkit-user-select:none;
  # -moz-user-select:none;
  # -ms-user-select:none;
  # user-select:none;
}
.lch input {
  display: none;
  position:absolute;
  cursor: pointer;
  opacity: 0;
}
.checkmark {
  position: absolute;
  top:0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}
.lch:hover input ~
.checkmark {
  background-color: #ccc;
}
.lch input:checked
~ .checkmark {
  background-color: black;
  border: solid #ccc;
}
.checkmark:after {
  content:"";
  position: absolute;
  display: none;
}
.lch input:checked
~ .checkmark:after {
  display: table-cell;
}
.lch
.checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform:rotate(45deg);
  -ms-transform:rotate(45deg);
  transform:rotate(45deg);
}
CSS;

$this->registerCSS($CSS);

?>

<?php 
if ($model->isNewRecord) {
    $model->FECH_DEV = date("Y-m-d");
    $model->HORA_DEV = date("H:i:s");
}
else {
    $model->FECH_DEV = Yii::$app->formatter->asDate($model->FECH_DEV, 'php:Y-m-d');
}
?>
<div class="devolucion-form">

        <div class="container">
          <div class="col-lg-4">

          <?php $form = ActiveForm::begin([
                          'options'=>['enctype'=>'multipart/form-data'],
                          ]); ?>
        
            <?=  

            $form->field($model, 'Personas')->widget(Select2::classname(), [
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

          <div class="col-lg-6" style="padding-left:0;text-align: center">
            <?php echo $form->field($model, 'FECH_DEV')->textInput(['readonly'=>false, 'type'=>'date']); ?>
          </div>
          <div class="col-lg-6" style="padding-right: 0;text-align: center">
            <?php echo $form->field($model, 'HORA_DEV')->widget(TimePicker::classname(), [
              'name' => 'HOAL_ART',
                  'pluginOptions' => [
                      'showSeconds' => true,
                      'showMeridian' => false,
                      'minuteStep' => 1,
                      'secondStep' => 5,
                  ]
              ]); ?>
          </div>

            <?= $form->field($model, 'OBSE_DEV')->textarea(['rows' => 6, 'style'=>'text-transform: uppercase','onblur'=>'javascript:this.value=this.value.toUpperCase().trim();']) ?>


              <?= $form->field($model, 'ENCA_DEV')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>

              <?= $form->field($model, 'PRES_DEV')->hiddenInput(['value'=>null])->label(false); ?>

         </div>
         <div class="col-lg-8" id="contenido">
           <label class="control-label col-lg-12" align="center">ARTICULOS PRESTADOS</label>
           <div class="col-lg-12">
            <div class="rtable">
              <div class="rtablehead" id="head">
               <div class="rtablecell"><strong>&nbsp;</strong></div>
               <div class="rtablecell"><strong>Articulo</strong></div>
               <div class="rtablecell"><strong>Fecha</strong></div>
               <div class="rtablecell"><strong>Hora</strong></div>
               <div class="rtablecell"><strong>Obs.</strong></div>
              </div>
              <div class="rtablebody">
             <?php 
               for ($i=0; $i <= 9 ; $i++) {
                 ?>
               <div class="rtablerow" id=<?php echo 'row'.$i ?>>
                <div class="rtablecell" style="width:1px;">

               <?php 
                echo $form->field($model, 'Prestado[]', [
                    'template' => '{input}{label}<div class"row"><div class="col-sm-12">{error}{hint}</div></div>'
                ])->checkbox([
                  'label'=>'<span class="checkmark"></span>',
                  'encode'=>false,
                  'labelOptions'=>['class'=>'container lch'],
                  //'Checked'=>"checked",
                  'id'=>'ch'.$i]);
              ?>
                </div>
                <div class="rtablecell" <?php echo 'id=ar'.$i ?> ></div>
                <div class="rtablecell" <?php echo 'id=fe'.$i ?> ></div>
                <div class="rtablecell" <?php echo 'id=ho'.$i ?> ></div>
                <div class="rtablecell" <?php echo 'id=ob'.$i ?> ></div>
               </div>
             <?php 
               }
             ?>
              </div>
            </div>
           </div>
           <div class="col-lg-12" id="total"></div>
         </div>
       <div class="form-group col-lg-12">
           <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success col-lg-6' : 'btn btn-primary col-lg-6']) ?>
           <?= Html::a('Cancelar', yii\helpers\Url::to(['/devolucion']), ['class' => 'btn btn-default col-lg-6'])  ?>
       </div>
                  <!--?= $form->field($model, 'Prestado')->checkboxList([1=>'uno',2=>'dos']);?-->
     </div>
       </div>
 

    <?php ActiveForm::end(); ?>
<?php 
$JS='
                        function tabla(id){
                        if(id>0){
                          //////////////
                          var i;
                          for (i = 0; i <= 9; i++) { 
                              $("#id"+i).html("");
                              $("#ar"+i).html("");
                              $("#fe"+i).html("");
                              $("#ho"+i).html("");
                              $("#ob"+i).html("");
                              document.getElementById("row"+i).style.display = "none";
                              $(".field-ch"+i).find("input[type=\"hidden\"]").remove();
                              document.getElementById("ch"+i).checked = false;
                          }
                          $("#total").html("");
                          //$("input[name=active]:hidden").remove();
                          /////////////
                          //var id = $(this).val();
                          if (id!=null) {
                            $.get("index.php?r=devolucion/objetos-prestados", {id : id}, function(data){
                                var data = $.parseJSON(data)
                                //$("#contenido").html("");
                                //alert(data);
                                    //document.getElementById("jose").innerHTML="hola";
                                $("#contenido").show();
                                $("#head").show();
                                var total=0;
                                $.each(data, function(index, value){
                                    total++;
                                    $("#ch"+index).show();
                                    $("#id"+index).html(value.ID_ART);
                                    $("#ar"+index).html(value.articulo);
                                    $("#fe"+index).html(value.FECH_PRE);
                                    $("#ho"+index).html(value.HORA_PRE);
                                    $("#ob"+index).html(value.OBSE_PRE);
                                    document.getElementById("row"+index).style.display = "table-row";
                                    document.getElementById("ch"+index).value = value.ID_ART;
                                    document.getElementById("ch"+index).checked = true;
                                  });
                                $("#total").html("<strong>Total :  </strong>" + total +" articulo(s)");
                                document.getElementById("devolucion-pres_dev").value = $("#devolucion-personas").val();
                              });
                            }
                          }
                        }
                        if($("#devolucion-personas").val()>0){
                        var id=$("#devolucion-personas").val();
                          tabla(id);
                        }
                        $("#devolucion-personas").on("select2:unselect", function (e) {
                          var i;
                          for (i = 0; i <= 9; i++) { 
                              $("#id"+i).html("");
                              $("#ar"+i).html("");
                              $("#fe"+i).html("");
                              $("#ho"+i).html("");
                              $("#ob"+i).html("");
                              document.getElementById("row"+i).style.display = "none";
                              $(".field-ch"+i).find("input[type=\"hidden\"]").remove();
                              document.getElementById("ch"+i).checked = false;
                          }
                          $("#total").html("");                          
                        });
                        $("#devolucion-personas").on("change", function(){
                        var id=$(this).val();
                          tabla(id);
                        });
                                  // $("#contenido").append("<tr><td>'. '' .'" + value.ID_ART + "</td>" + 
                                  // "<td>" + value.articulo + "</td>" + "<td>" + value.FECH_PRE + "</td>" + "<td>" + value.HORA_PRE + "</td>" + "<td>" + value.OBSE_ART + "</td></tr>")

';
$this->registerJs($JS);
 ?>
