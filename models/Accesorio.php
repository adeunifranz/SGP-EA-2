<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accesorio".
 *
 * @property integer $ID_ACC
 * @property string $FUNC_ACC
 * @property string $ESPE_ACC
 * @property integer $ARTI_ACC
 *
 * @property Articulo $aRTIACC
 */
class Accesorio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accesorio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ARTI_ACC'], 'integer'],
            [['FUNC_ACC'], 'string', 'max' => 50],
            [['ESPE_ACC'], 'string', 'max' => 100],
            //[['ARTI_ACC'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['ARTI_ACC' => 'ID_ART']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_ACC' => 'Id  Acc',
            'FUNC_ACC' => 'FUNCION QUE CUMPLE',
            'ESPE_ACC' => 'ESPECIFICACIONES',
            'ARTI_ACC' => 'Arti  Acc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getARTIACC()
    {
        return $this->hasOne(Articulo::className(), ['ID_ART' => 'ARTI_ACC']);
    }
}
