<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reporte".
 */
class Reporte extends \yii\db\ActiveRecord
{
    public $seleccion;
    public $fecha_ini;
    public $fecha_fin;
    public $todo;

    public static function tableName()
    {
        return 'persona';
    }

    public function rules()
    {
        return [
            [['seleccion'], 'required', 'message'=>'debe elejir una opcion'],
            [['fecha_ini', 'fecha_fin', 'todo'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'seleccion' => 'PERSONAS QUE SE PRESTARON',
            'fecha_ini' => 'DESDE',
            'fecha_fin' => 'HASTA',
            'todo'     => 'TODO DE PRINCIPIO A FIN'
        ];
    }
}