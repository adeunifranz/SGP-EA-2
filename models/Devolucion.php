<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "devolucion".
 *
 * @property string $ID_DEV
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

    public function getDevo()
    {
        return $this->PRES_DEV;
    }

    public function getPersonal()
    {
        return Persona::findOne((Prestamo::findOne($this->PRES_DEV)->PERS_PRE))->Nombrecompleto;
    }

    public function getPrestamo(){
        return Prestamo::find()->where(["PERS_PRE"=>$this->PRES_DEV])->one()->ID_PRE;
    }

    public $Prestado;
    public $Personas;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['Prestado', 'Personas'], 'safe'],
            [['Prestado'], 'validatePrestado'],
            ['Personas', 'required', 'message'=>'es necesario elejir una persona'],
            [['FECH_DEV', 'HORA_DEV'], 'safe'],
//            [['Personas','ENCA_DEV'], 'required'],
            [['ENCA_DEV', 'PRES_DEV'], 'integer'],
            [['OBSE_DEV'], 'string', 'max' => 30],
            [['ENCA_DEV'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ENCA_DEV' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function validatePrestado(){
        $elegidos=0;
        foreach ($this->Prestado as $elemento) {
            if($elemento!=0) {
                $elegidos++;
            }
        }
        if($elegidos==0) {
            $this->addError($Prestado, 'debe elegir al menos un articulo');
        }
    }

    public function attributeLabels()
    {
        return [
            'Personal' => 'PERSONA QUE SE PRESTO',
            'Prestado' => '#',
            'Personas' => 'PERSONA QUE SE PRESTO',
            'ID_DEV'   => 'CODIGO DE DEVOLUCION',
            'FECH_DEV' => 'FECHA DE DEVOLUCION',
            'HORA_DEV' => 'HORA DE DEVOLUCION', 
            'OBSE_DEV' => 'OBSERVACIONES',
            'ENCA_DEV' => 'ENCARGADO DE DEVOLUCION',
        ];
    }

    // public function get_Prestado() {
    //     $Devuelto=Devuelto::find()->where(["DEVO_DVS"=>$this->ID_DEV])->one();
    //     if(!empty($Devuelto)){
    //         $PrestadoModel=Prestado::find()->where(["ID_PRS"=>$Devuelto->PRES_DVS])->one();
    //         if(!empty($PrestadoModel)){
    //             $Articulo=Articulo::find()->where(["ID_ART"=>$PrestadoModel->ARTI_PRS])->one();
    //             if(!empty($Articulo)){
    //                 $artpre=$artpre->DETA_ART.'-->  Serie # '.$artpre->SERI_ART;
    //                 return $artpre;
    //             }
    //         }
    //     }
    //     return null;
    // }

    public static function qdevo()
    { 
        $connection=Yii::$app->db;
        $query='SELECT ID_ART, CONCAT(NOMB_PER, " ", APPA_PER, " ", APMA_PER) AS fullname, CONCAT(DETA_ART, " SN: ", SERI_ART) AS articulo, FECH_PRE, HORA_PRE, OBSE_PRE
                        FROM persona JOIN prestamo JOIN prestado JOIN articulo
                                ON ID_PER=PERS_PRE AND ID_PRE=PRES_PRS AND ARTI_PRS=ID_ART
                                    WHERE 
                                    ID_PER=PERS_PRE AND ID_PRE=PRES_PRS AND ARTI_PRS=ID_ART AND
                                    DISP_ART=1 ORDER BY ID_PRE';
        $articulos = $connection->createCommand($query)->queryAll();
        return $articulos;
    }

    public function get_Personas() {
        $connection=Yii::$app->db;
        $query='SELECT CONCAT(NOMB_PER, " ", APPA_PER, " ", APMA_PER) AS fullname, ID_PER
                        FROM persona JOIN prestamo JOIN prestado JOIN articulo
                                ON ID_PER=PERS_PRE AND ID_PRE=PRES_PRS AND ARTI_PRS=ID_ART
                                    WHERE 
                                    ID_PER=PERS_PRE AND ID_PRE=PRES_PRS AND ARTI_PRS=ID_ART AND
                                    DISP_ART=1 AND VIGE_PRS=1
                                                   GROUP BY fullname DESC';
        $pers= $connection->createCommand($query)->queryAll();
        $personas=\yii\helpers\ArrayHelper::map($pers,'ID_PER','fullname');
        if($personas!=null) {
            return $personas;
        } else {
            return null;
        }
    }

    public function objetos($id) {
        $connection=Yii::$app->db;
        $query='SELECT ID_ART, CONCAT(DETA_ART, " SN: ", SERI_ART) AS articulo, FECH_PRE, HORA_PRE, OBSE_ART
                        FROM persona join prestamo join prestado join articulo
                                ON ID_PER=PERS_PRE AND ID_PRE=PRES_PRS AND ARTI_PRS=ID_ART
                                    AND ID_PER='.$id.' '.
                                    ' WHERE
                                    ID_PER=PERS_PRE AND ID_PRE=PRES_PRS AND ARTI_PRS=ID_ART AND
                                    DISP_ART=1 AND VIGE_PRS=1
                                                   ORDER BY FECH_PRE, HORA_PRE DESC';
        $objetos= $connection->createCommand($query)->queryAll();
        if($objetos!=null) {
            return $objetos;
        } else {
            return null;
        }        
    }


    public static function get_ENCADEV($id){
    $model = User::find()->where(["id" => $id])->one();
    if(!empty($model)){
        return $model->username;
        }
        return null;
    }
    public static function get_articulos(){
    $array = Yii::$app->db->createCommand(
                'SELECT ID_PRS, CONCAT(DETA_ART," --> SERIE # ", SERI_ART) AS DETALLE FROM articulo JOIN prestado ON ID_ART=ARTI_PRS WHERE DISP_ART=1')->queryAll();
    if($array!=null){
        $articulos = yii\helpers\ArrayHelper::map($array, 'ID_PRS', 'DETALLE');
        return $articulos;
        }
        return null;
    }

    public static function getPersona()
    {
    $array = Yii::$app->db->createCommand(
                'SELECT CONCAT(NOMB_PER," ",APPA_PER," ",APMA_PER) AS nombre FROM articulo JOIN prestado JOIN prestamo JOIN persona ON ID_ART=ARTI_PRS AND PRES_PRS=ID_PRE AND PERS_PRE=ID_PER')->queryAll();
        if ($array!=null) {
            return print_r($array[0]['nombre'],true);
        } else {
            return null;
        }

    }

    /**
     * @return \yii\db\ActiveQuery
     */
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
