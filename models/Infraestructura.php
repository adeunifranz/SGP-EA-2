<?php

namespace app\models;

use Yii;

class Infraestructura extends \yii\db\ActiveRecord
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
}
