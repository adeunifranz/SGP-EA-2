<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "varios".
 *
 * @property string $ID_VAR
 * @property string $TIPO_VAR
 * @property string $ARTI_VAR
 *
 * @property Articulo $aRTIVAR
 */
class Varios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'varios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ARTI_VAR'], 'integer'],
            [['DETA_VAR'], 'string', 'max' => 50],
//            [['ARTI_VAR'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['ARTI_VAR' => 'ID_ART']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_VAR' => 'Id  Var',
            'TIPO_VAR' => 'Tipo  Var',
            'ARTI_VAR' => 'Arti  Var',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getARTIVAR()
    {
        return $this->hasOne(Articulo::className(), ['ID_ART' => 'ARTI_VAR']);
    }

    /**
     * @inheritdoc
     * @return VariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariosQuery(get_called_class());
    }
}
