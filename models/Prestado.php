<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prestado".
 *
 * @property string $ID_PRS
 * @property string $ARTI_PRS
 * @property string $PRES_PRS
 *
 * @property Articulo $aRTIPRS
 * @property Prestamo $pRESPRS
 */
class Prestado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prestado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ARTI_PRS', 'PRES_PRS'], 'required'],
            [['ARTI_PRS', 'PRES_PRS'], 'integer'],
            [['ARTI_PRS'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['ARTI_PRS' => 'ID_ART']],
            [['PRES_PRS'], 'exist', 'skipOnError' => true, 'targetClass' => Prestamo::className(), 'targetAttribute' => ['PRES_PRS' => 'ID_PRE']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_PRS' => 'CODIGOS DE PRESTADO',
            'ARTI_PRS' => 'CODIGO',
            'PRES_PRS' => 'CODIGOS DE PRESTAMO',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getARTIPRS()
    {
        return $this->hasOne(Articulo::className(), ['ID_ART' => 'ARTI_PRS']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRESPRS()
    {
        return $this->hasOne(Prestamo::className(), ['ID_PRE' => 'PRES_PRS']);
    }

    public static function get_ARTIPRS($id){
    $model = Articulo::find()->where(["ID_ART" => $id])->one();
    if(!empty($model)){
        return $model->DETA_ART;
        }
        return null;
    }
}
