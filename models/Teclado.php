<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teclado".
 *
 * @property integer $ID_TEC
 * @property string $DIST_TEC
 * @property string $ENTR_TEC
 * @property integer $ARTI_TEC
 *
 * @property Articulo $aRTITEC
 */
class Teclado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teclado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ARTI_TEC'], 'integer'],
            [['DIST_TEC'], 'string', 'max' => 15],
            [['ENTR_TEC'], 'string', 'max' => 10],
//            [['ARTI_TEC'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['ARTI_TEC' => 'ID_ART']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_TEC' => 'Id  Tec',
            'DIST_TEC' => 'Dist  Tec',
            'ENTR_TEC' => 'Entr  Tec',
            'ARTI_TEC' => 'Arti  Tec',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getARTITEC()
    {
        return $this->hasOne(Articulo::className(), ['ID_ART' => 'ARTI_TEC']);
    }

    /**
     * @inheritdoc
     * @return TecladoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TecladoQuery(get_called_class());
    }
}
