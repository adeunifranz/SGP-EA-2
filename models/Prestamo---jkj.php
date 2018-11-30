<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prestamo".
 *
 * @property string $ID_PRE
 * @property string $FECH_PRE
 * @property string $HORA_PRE
 * @property string $PERS_PRE
 * @property string $LUGA_PRE
 * @property string $FEDE_PRE
 * @property string $HODE_PRE
 * @property string $DOCU_PRE
 * @property string $ENCA_PRE
 * @property string $OBSE_PRE
 */
class Prestamo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prestamo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FECH_PRE', 'HORA_PRE', 'FEDE_PRE', 'HODE_PRE'], 'safe'],
            [['PERS_PRE', 'LUGA_PRE', 'ENCA_PRE'], 'required'],
            [['PERS_PRE', 'LUGA_PRE', 'ENCA_PRE'], 'integer'],
            [['DOCU_PRE'], 'string', 'max' => 50],
            [['OBSE_PRE'], 'string', 'max' => 30],
            //[['LUGA_PRE'], 'exist', 'skipOnError' => true, 'targetClass' => Ambiente::className(), 'targetAttribute' => ['LUGA_PRE' => 'ID_AMB']],
            //[['PERS_PRE'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['PERS_PRE' => 'ID_PER']],
            //[['ENCA_PRE'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ENCA_PRE' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_PRE' => 'CODIGO DE PRESTAMO',
            'FECH_PRE' => 'FECHA DE PRESTAMO',
            'HORA_PRE' => 'HORA DE PRESTAMO',
            'PERS_PRE' => 'PERSONA QUE SE PRESTA',
            'LUGA_PRE' => 'LUGAR AL QUE LLEVA',
            'FEDE_PRE' => 'FECHA DE DEVOLUCION',
            'HODE_PRE' => 'HORA DE DEVOLUCION',
            'DOCU_PRE' => 'DOCUMENTO QUE DEJA',
            'ENCA_PRE' => 'ENCARGADO DE PRESTAMO',
            'OBSE_PRE' => 'OBSERVACIONES',
        ];
    }
    public function getPERSPRE()
    {
        return $this->hasOne(Persona::className(), ['ID_PER' => 'PERS_PRE']);
    }

}
