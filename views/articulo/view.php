<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use app\assets\ArticuloAsset;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\Articulo */

ArticuloAsset::register($this);

$this->title = 'Registro N° '.$model->ID_ART;
$this->params['breadcrumbs'][] = ['label' => 'Articulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-view">

    <p>
        <?= Html::a('Volver', ['volver'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Articulos', ['index'], ['class' => 'btn btn-warning']) ?>
        <?php if (Helper::checkRoute('update')) {?>
            <?= Html::a('Actualizar', ['update', 'id' => $model->ID_ART], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
        <?php if (Helper::checkRoute('delete')) {?>
            <?php 
                    Modal::begin([
                        'header' => '<h2>Cuidado</h2>',

                        'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>'.

                                    Html::a('Eliminar', ['delete', 'id' => $model->ID_ART], [
                                                        'class' => 'btn btn-danger',
                                                        'data' => [
                                                            'method' => 'post',
                                                        ],
                                                    ])
                        ,

                        'toggleButton' => ['label' => 'Eliminar', 'class' => 'btn btn-danger'],
                        'options' => ['class' => 'modal modal-warning'],
                    ]);
                    
                    echo 
                    'Esta seguro de eliminar el articulo?'.'<br>'.'<br>'.'</div>';

                    Modal::end();
             ?>

         <?php } ?>

    </p>

<table class="table">
    <tr><td  width="50%">
<?php 

echo DetailView::widget([
    'model'=>$model,
    'options' => [
        'class' => 'table table-bordered',
    ],
    'attributes'=>[
            //'ID_ART',
            'COAS_ART',
            'MARC_ART',
            'SERI_ART',
            'DETA_ART',
            ['attribute'=>'FEAL_ART',
             'value' => date("d-m-Y",strtotime($model->FEAL_ART))],
            'HOAL_ART',
            'ESTA_ART',
            'COLO_ART',
            [
                'attribute'=>'ASIG_ART',
                'value' => function($data){
                    return app\models\articulo::ASIG($data->ASIG_ART);},
            ],
            'OBSE_ART:ntext',
            //'FOTO_ART',
            /*[
               'attribute'=>'FOTO_ART',
               'value'=> '../web/files/'.$model->FOTO_ART,
               'format' => ['image',['width'=>'200','height'=>'200']],
            ],*/
        ],
    ]);
 ?>
        <?php

       //if ($model->FOTO_ART!='') {
         //$img = '<img src="../web/files/'.$model->FOTO_ART.'" height="100px">';

//'.Yii::getAlias('@webroot/files').'/'.$model->FOTO_ART.'"></p>'*/;
//       }
//       else $img = '<p>'.'No se encontro una imagen'.'</p>'
    
    ?>

    </td><td align="center" style='vertical-align: middle;'>


        <?php if ($model->FOTO_ART === null){ ?>
            <p>Imagen no disponible</p>
            <canvas id="FOTO" width="280" height="280" style="border:1px solid #000000;"></canvas>
        <?php } else { ?>
                <img src="<?= 
                //'../web/files/'.$model->FOTO_ART 
                Url::base('http').'/files/'.$model->FOTO_ART
                ?>" width="300" height="300">
                <a type="button" class="btn btn-default" data-toggle="modal" data-target="#largeModal">
                    <i class="fa fa-search"></i></a>           

              <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true" 
              <?php if ($model->FOTO_ART === null) { echo 'visible=false';}?> >
              <div class="modal-dialog modal-lg" style="padding: 0;margin: 0">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="modal-title" id="myModalLabel">Foto ampliada</div>
                  </div>
                  <div class="modal-body">
                               <img src="<?= 
                               //'../web/files/'.$model->FOTO_ART
                               Url::base('http').'/files/'.$model->FOTO_ART
                                ?>" height="500" width="800">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                  </div>
                </div>
              </div>
            </div>


        <?php } ?>


<?php  

                   Modal::begin([
                        'header' => '<h2>Detalles</h2>',
                        'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>',

                        'toggleButton' => ['label' => 'Detalles', 'class' => 'btn btn-primary'],
                        'options' => ['class' => 'modal modal-default'],
                    ]);
                    switch ($model->tipo_art) {
                                            case 'accesorio':
                                                $attributes =[
                                                        'FUNC_ACC',
                                                        'ESPE_ACC',
                                                    ];
                                                break;
                                            case 'computadora':
                                                $attributes =[
                                                        'SIOP_COM',
                                                        'PROC_COM',
                                                        'MEMO_COM',
                                                        'DIDU_COM',
                                                        'TAVI_COM',
                                                        [
                                                            'attribute'=>'TIPO_COM',
                                                            'value' => function($data){
                                                                return app\models\Computadora::get_TIPO($data->TIPO_COM);},
                                                        ],
                                                    ];
                                                break;
                                            case 'monitor':
                                                $attributes=[
                                                        'TAMA_MON',
                                                        'ENTR_MON',
                                                        'TIPO_MON',
                                                    ];
                                                break;
                                            case 'mouse':
                                                $attributes=[
                                                        'TIPO_MOU',
                                                        'ENTR_MOU',
                                                    ];
                                                break;                                           
                                            case 'parlante':
                                                $attributes=[
                                                        'NELE_PAR',
                                                        'ENTR_PAR',
                                                    ];
                                                break;
                                            case 'teclado':
                                                $attributes=[
                                                        'DIST_TEC',
                                                        'ENTR_TEC',
                                                    ];
                                                break;
                                            case 'varios':
                                                $attributes=[
                                                        'DETA_VAR',
                                                    ];
                                                break;
                    }
                    echo DetailView::widget([
                        'model'=>$model2,
                        'options' => [
                            'class' => 'table table-bordered',
                        ],
                        'attributes'=> $attributes
                    ]);
                    Modal::end();

 ?>

        </td></tr>
    </table>

<script>
$(document).ready(function(){
    $("#btnFOTO").click(function(){
        $("#w2").modal({backdrop: "static"});
    });
});
</script>
 </div>
