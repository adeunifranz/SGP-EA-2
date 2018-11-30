<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mouse".
 *
 * @property integer $ID_MOU
 * @property string $TIPO_MOU
 * @property string $ENTR_MOU
 * @property integer $ARTI_MOU
 *
 * @property Articulo $aRTIMOU
 */
class Mouse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mouse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ARTI_MOU'], 'integer'],
            [['TIPO_MOU', 'ENTR_MOU'], 'string', 'max' => 10],
//            [['ARTI_MOU'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['ARTI_MOU' => 'ID_ART']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_MOU' => 'Id  Mou',
            'TIPO_MOU' => 'Tipo  Mou',
            'ENTR_MOU' => 'Entr  Mou',
            'ARTI_MOU' => 'Arti  Mou',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getARTIMOU()
    {
        return $this->hasOne(Articulo::className(), ['ID_ART' => 'ARTI_MOU']);
    }

    /**
     * @inheritdoc
     * @return MouseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MouseQuery(get_called_class());
    }
}
