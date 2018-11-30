<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "piso".
 *
 * @property string $ID_PIS
 * @property string $NOMB_PIS
 *
 * @property Ambiente[] $ambientes
 */
class Piso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'piso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOMB_PIS'], 'required'],
            [['NOMB_PIS'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_PIS' => 'CODIGO',
            'NOMB_PIS' => 'NOMBRE',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmbientes()
    {
        return $this->hasMany(Ambiente::className(), ['PISO_AMB' => 'ID_PIS']);
    }
}
