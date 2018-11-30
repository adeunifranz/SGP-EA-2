<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "computadora".
 *
 * @property string $ID_COM
 * @property string $SIOP_COM
 * @property string $PROC_COM
 * @property string $MEMO_COM
 * @property string $DIDU_COM
 * @property string $TAVI_COM
 * @property string $ARTI_COM
 * @property string $TIPO_COM
 *
 * @property Articulo $aRTICOM
 */
class Computadora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'computadora';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ARTI_COM', 'TIPO_COM'], 'integer'],
            [['SIOP_COM', 'PROC_COM'], 'string', 'max' => 20],
            [['MEMO_COM', 'DIDU_COM', 'TAVI_COM'], 'string', 'max' => 10],
            //[['ARTI_COM'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['ARTI_COM' => 'ID_ART']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_COM' => 'CODIGO',
            'SIOP_COM' => 'SISTEMA OPERATIVO',
            'PROC_COM' => 'PROCESADOR',
            'MEMO_COM' => 'MEMORIA',
            'DIDU_COM' => 'DISCO DURO',
            'TAVI_COM' => 'TARJETA DE VIDEO',
            'ARTI_COM' => 'ARTICULO',
            'TIPO_COM' => 'TIPO',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getARTICOM()
    {
        return $this->hasOne(Articulo::className(), ['ID_ART' => 'ARTI_COM']);
    }
    public function get_TIPO($id) {
    $model = Tipo::find()->where(["ID_TIP" => $id])->one();
    if(!empty($model)){
        return $model->DETA_TIP;
        }
        return null;
    }
    public function get_ARTI($id) {
    $model = Articulo::find()->where(["ID_ART" => $id])->one();
    if(!empty($model)){
        return $model->DETA_ART;
        }
        return null;
    }

}
