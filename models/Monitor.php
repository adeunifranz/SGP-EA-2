<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "monitor".
 *
 * @property integer $ID_MON
 * @property string $TAMA_MON
 * @property string $TIPO_MON
 * @property string $ENTR_MON
 * @property integer $ARTI_MON
 *
 * @property Articulo $aRTIMON
 */
class Monitor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'monitor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ARTI_MON'], 'integer'],
            [['TAMA_MON', 'TIPO_MON', 'ENTR_MON'], 'string', 'max' => 10],
//            [['ARTI_MON'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['ARTI_MON' => 'ID_ART']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_MON' => 'Id  Mon',
            'TAMA_MON' => 'Tama  Mon',
            'TIPO_MON' => 'Tipo  Mon',
            'ENTR_MON' => 'Entr  Mon',
            'ARTI_MON' => 'Arti  Mon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getARTIMON()
    {
        return $this->hasOne(Articulo::className(), ['ID_ART' => 'ARTI_MON']);
    }

    /**
     * @inheritdoc
     * @return MonitorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MonitorQuery(get_called_class());
    }
}
