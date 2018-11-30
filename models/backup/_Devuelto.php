<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "devuelto".
 *
 * @property string $ID_DVS
 * @property string $DEVO_DVS
 * @property string $PRES_DVS
 *
 * @property Devolucion $dEVODVS
 * @property Prestado $pRESDVS
 */
class Devuelto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'devuelto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DEVO_DVS'], 'required'],
            [['DEVO_DVS'], 'integer'],
            [['DEVO_DVS'], 'exist', 'skipOnError' => true, 'targetClass' => Devolucion::className(), 'targetAttribute' => ['DEVO_DVS' => 'ID_DEV']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_DVS' => 'Id  Dvs',
            'DEVO_DVS' => 'Devo  Dvs',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDEVODVS()
    {
        return $this->hasOne(Devolucion::className(), ['ID_DEV' => 'DEVO_DVS']);
    }

    /**
     * @inheritdoc
     * @return DevueltoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DevueltoQuery(get_called_class());
    }
}
