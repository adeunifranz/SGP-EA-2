<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo".
 *
 * @property string $ID_TIP
 * @property string $DETA_TIP
 */
class Tipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DETA_TIP'], 'required'],
            [['DETA_TIP'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_TIP' => 'Id  Tip',
            'DETA_TIP' => 'Deta  Tip',
        ];
    }
}
