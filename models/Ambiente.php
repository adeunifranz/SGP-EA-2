<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ambiente".
 *
 * @property string $ID_AMB
 * @property string $NOMB_AMB
 * @property string $PISO_AMB
 *
 * @property Piso $pISOAMB
 * @property Prestamo[] $prestamos
 */
class Ambiente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ambiente';
    }

    /**
     * @inheritdoc
     */
    public $NOMB_PISO;


    public function getPISO()
    {   
        $piso = '';

        if(!$this->IsNewRecord){
            $piso = Piso::find()->where('`ID_PIS` = '.$this->PISO_AMB)->one();
            $piso = $piso->NOMB_PIS;
        }

        return $piso;
    }

    public function rules()
    {
        return [
            [['PISO', 'NOMB_PISO'], 'safe'],
            //[['PISO'], 'string'],            
            [['NOMB_AMB', 'NOMB_PISO'], 'required'],
            ['NOMB_AMB', 'unique', 'targetClass' => 'app\models\Ambiente', 'message' => 'El ambiente ya fue registrado.'],           
            [['PISO_AMB'], 'integer'],
            [['NOMB_AMB'], 'string', 'max' => 35],
            [['PISO_AMB'], 'exist', 'skipOnError' => true, 'targetClass' => Piso::className(), 'targetAttribute' => ['PISO_AMB' => 'ID_PIS']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_AMB' => 'CODIGO',
            'NOMB_AMB' => 'AMBIENTE',
            'PISO_AMB' => 'PISO',
            'NOMB_PISO' => 'PISO'
        ];
    }   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPISOAMB()
    {
        return $this->hasOne(Piso::className(), ['ID_PIS' => 'PISO_AMB']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamo::className(), ['LUGA_PRE' => 'ID_AMB']);
    }
}
