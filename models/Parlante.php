<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parlante".
 *
 * @property integer $ID_PAR
 * @property string $NELE_PAR
 * @property string $ENTR_PAR
 * @property integer $ARTI_PAR
 *
 * @property Articulo $aRTIPAR
 */
class Parlante extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parlante';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ARTI_PAR'], 'integer'],
            [['NELE_PAR'], 'string', 'max' => 15],
            [['ENTR_PAR'], 'string', 'max' => 10],
//            [['ARTI_PAR'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['ARTI_PAR' => 'ID_ART']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_PAR' => 'Id  Par',
            'NELE_PAR' => 'Nele  Par',
            'ENTR_PAR' => 'Entr  Par',
            'ARTI_PAR' => 'Arti  Par',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getARTIPAR()
    {
        return $this->hasOne(Articulo::className(), ['ID_ART' => 'ARTI_PAR']);
    }

    /**
     * @inheritdoc
     * @return ParlanteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ParlanteQuery(get_called_class());
    }
}
