<?php
use yii\widgets\DetailView;
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        // [
        // 'label' => 'HORA DE PRESTAMO',
        // 'attribute'=>'ID_DEV',
        // 'value' => function($data){
        //     return app\models\Devolucion::get_HP($data->ID_DEV);},
        // ],
        [
        'attribute'=>'FECH_DEV',
        'value' => function($data){
            return Yii::$app->formatter->asDate($data->FECH_DEV,'php:l, jS \d\e F \d\e Y');},
        ],
        'HORA_DEV',
        [
        'label' => 'PERSONA QUE SE PRESTO',
        'attribute'=>'PRES_DEV',
        'value' => function($data){
            $persona=app\models\Prestamo::find()->where(["ID_PRE"=>$data])->one()->PERS_PRE;
            return app\models\Persona::findOne($persona)->Nombrecompleto;}
        ]
    ],
]) ?>