<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "devolucion".
 *
 * @property string $ID_DEV
 * @property string $PRES_DEV
 * @property string $FECH_DEV
 * @property string $HORA_DEV
 * @property string $OBSE_DEV
 * @property string $ENCA_DEV
 *
 * @property User $eNCADEV
 * @property Devuelto[] $devueltos
 */
class Devolucion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'devolucion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PRES_DEV', 'ENCA_DEV'], 'required'],
            [['PRES_DEV', 'ENCA_DEV'], 'integer'],
            [['FECH_DEV', 'HORA_DEV'], 'safe'],
            [['OBSE_DEV'], 'string', 'max' => 30],
            [['ENCA_DEV'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ENCA_DEV' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prestado' => 'ARTICULO PRESTADO',
            'ID_DEV'   => 'CODIGO DE DEVOLUCION',
            'PRES_DEV' => 'PRESTAMO',
            'FECH_DEV' => 'FECHA DE DEVOLUCION',
            'HORA_DEV' => 'HORA DE DEVOLUCION',
            'OBSE_DEV' => 'OBSERVACIONES',
            'ENCA_DEV' => 'ENCARGADO DE DEVOLUCION',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestado() {
        $p=Articulo::find()->where(["ID_ART"=>Prestado::find()->where(["ID_PRS"=>$this->PRES_DEV])->one()->ARTI_PRS])->one();
        $p=$p->DETA_ART.'-->  Serie # '.$p->SERI_ART;
        return $p;
    }
    public static function get_ENCADEV($id){
    $model = User::find()->where(["id" => $id])->one();
    if(!empty($model)){
        return $model->username;
        }
        return null;
    }
    public static function get_ART($id){
    $model = Prestado::find()->where(["ID_PRS" => $id])->one();
    if(!empty($model)){
        $model2 = Articulo::find()->where(["ID_ART" => $model->ARTI_PRS])->one();
        return $model2->DETA_ART.' --> SERIE #: '.$model2->SERI_ART;
        }
        return null;
    }
    public static function get_FP($id){
    $model = Prestado::find()->where(["ID_PRS" => $id])->one();
    if(!empty($model)){
        $model2 = Prestamo::find()->where(["ID_PRE" => $model->PRES_PRS])->one();
        return $model2->FECH_PRE;
        }
        return null;
    }
    public static function get_HP($id){
    $model = Prestado::find()->where(["ID_PRS" => $id])->one();
    if(!empty($model)){
        $model2 = Prestamo::find()->where(["ID_PRE" => $model->PRES_PRS])->one();
        return $model2->HORA_PRE;
        }
        return null;
    }

    public static function get_articulos(){
    $array = Yii::$app->db->createCommand(
                'SELECT ID_PRS, ID_PRE, CONCAT(DETA_ART," --> SERIE # ", SERI_ART) AS DETALLE, COLO_ART, CONCAT(NOMB_PER," ",APPA_PER," ",APMA_PER) AS NOMBRE, FECH_PRE, HORA_PRE FROM PERSONA JOIN PRESTAMO ON ID_PER=PERS_PRE JOIN PRESTADO ON ID_PRE = PRES_PRS JOIN articulo ON ARTI_PRS=ID_ART WHERE DISP_ART=1')->queryAll();
    $articulos = yii\helpers\ArrayHelper::map($array, 'ID_PRS', 'DETALLE');
    if($articulos!=null){
        return $articulos;
        }
        return null;
    }


    public function getENCADEV()
    {
        return $this->hasOne(User::className(), ['id' => 'ENCA_DEV']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevueltos()
    {
        return $this->hasMany(Devuelto::className(), ['DEVO_DVS' => 'ID_DEV']);
    }

    /**
     * @inheritdoc
     * @return DevolucionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DevolucionQuery(get_called_class());
    }
}
