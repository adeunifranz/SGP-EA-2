<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property string $ID_PER
 * @property string $NOMB_PER
 * @property string $APPA_PER
 * @property string $APMA_PER
 * @property string $CAID_PER
 * @property string $DIRE_PER
 * @property integer $TELE_PER
 * @property string $REUN_PER
 *
 * @property Prestamo[] $prestamos
 * @property Usuario[] $usuarios
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * @inheritdoc
     */

    /* Getter for person full name */

     public function getNombrecompleto() {
          return $this->APPA_PER . ' ' . $this->APMA_PER. ' ' . $this->NOMB_PER;
     }

    public function rules()
    {
        return [
            [['NOMB_PER', 'APPA_PER', 'APMA_PER', 'REUN_PER'], 'required'],
            [['TELE_PER'], 'integer'],
            [['TELE_PER'], 'number'],
            [['NOMB_PER', 'APPA_PER', 'APMA_PER', 'REUN_PER'], 'string', 'max' => 20],
            [['CAID_PER'], 'string', 'min' => 6],
            [['CAID_PER'], 'string', 'max' => 12],
            //[['CAID_PER'], 'match', 'pattern' => '/^[0-9]+$/i', 'message' => 'solo se aceptan numeros'],
            [['DIRE_PER'], 'string', 'max' => 30],
            [['NOMB_PER', 'APPA_PER', 'APMA_PER'], 'match','pattern' => '/^[A-Z| |Ñ]+$/i', 'skipOnError'=>true],
            [['NOMB_PER', 'APPA_PER', 'APMA_PER'], 'string', 'min' => 2],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_PER' =>   'CODIGO',
            'Nombrecompleto' => 'NOMBRE COMPLETO',

            'NOMB_PER' => 'NOMBRE',
            'APPA_PER' => 'APELLIDO PATERNO',
            'APMA_PER' => 'APELLIDO MATERNO',
            'CAID_PER' => 'CARNET DE IDENTIDAD',
            'DIRE_PER' => 'DIRECCION',
            'TELE_PER' => 'TELEFONO',
            'REUN_PER' => 'RELACION CON LA UNIFRANZ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamo::className(), ['PERS_PRE' => 'ID_PER']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['PERS_USU' => 'ID_PER']);
    }
}
