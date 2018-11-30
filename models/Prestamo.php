<?php

namespace app\models;
use yii\helpers\ArrayHelper;

use Yii;
/**
 * This is the model class for table "prestamo".
 *
 * @property string $ID_PRE
 * @property string $FECH_PRE
 * @property string $HORA_PRE
 * @property string $PERS_PRE
 * @property string $LUGA_PRE
 * @property string $DOCU_PRE
 * @property string $ENCA_PRE
 * @property string $OBSE_PRE
 */
class Prestamo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $articulo;

    public static function tableName()
    {
        return 'prestamo';
    }

    /**
     * @inheritdoc
     */
    public function Personas()
    {
          return ArrayHelper::map(\app\models\Persona::find()->all(), 'ID_PER', 'Nombrecompleto');
    }

    public function Articulos()
    {
        $artdbo = Yii::$app->db->createCommand('SELECT ID_ART, DETA_ART, SERI_ART, CONCAT(DETA_ART, " => SN: " ,SERI_ART) AS Detallado FROM articulo WHERE DISP_ART=0 AND ASIG_ART=0')->queryAll();
        return ArrayHelper::map($artdbo, 'ID_ART', 'Detallado');
    }

    public function rules()
    {
        return [
            [['FECH_PRE', 'HORA_PRE'], 'safe'],
            [['articulo','PERS_PRE', 'LUGA_PRE', 'DOCU_PRE'], 'required'],
            [['PERS_PRE', 'LUGA_PRE'], 'integer'],
            [['DOCU_PRE'], 'string', 'max' => 50],
            [['OBSE_PRE'], 'string', 'max' => 30],
            //[['LUGA_PRE'], 'exist', 'skipOnError' => true, 'targetClass' => Ambiente::className(), 'targetAttribute' => ['LUGA_PRE' => 'ID_AMB']],
            //[['PERS_PRE'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['PERS_PRE' => 'ID_PER']],
            [['ENCA_PRE'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ENCA_PRE' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'articulo' => 'ARTICULO',
            'ID_PRE' => 'CODIGO DE PRESTAMO',
            'FECH_PRE' => 'FECHA DE PRESTAMO',
            'HORA_PRE' => 'HORA DE PRESTAMO',
            'PERS_PRE' => 'PERSONA QUE SE PRESTA',
            'LUGA_PRE' => 'LUGAR AL QUE LLEVA',
            'DOCU_PRE' => 'DOCUMENTO QUE DEJA',
            'ENCA_PRE' => 'ENCARGADO DE PRESTAMO',
            'OBSE_PRE' => 'OBSERVACIONES',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevolucions()
    {
        return $this->hasMany(Devolucion::className(), ['PRES_DEV' => 'ID_PRE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestados()
    {
        return $this->hasMany(Prestado::className(), ['PRES_PRS' => 'ID_PRE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLUGAPRE()
    {
        return $this->hasOne(Ambiente::className(), ['ID_AMB' => 'LUGA_PRE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSPRE()
    {
        return $this->hasOne(Persona::className(), ['ID_PER' => 'PERS_PRE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getENCAPRE()
    {
        return $model->hasOne(User::className(), ['id' => 'ENCA_PRE']);
    }
    public static function get_ENCAPRE($id){
    $model = User::find()->where(["id" => $id])->one();
    if(!empty($model)){
        return $model->username;
        }
        return null;
    }
    public static function get_LUGAPRE($id){
    $model = Ambiente::find()->where(["ID_AMB" => $id])->one();
    if(!empty($model)){
        return $model->NOMB_AMB;
        }
        return null;
    }
    public static function get_PERSPRE($id){
    $model = Persona::find()->where(["ID_PER" => $id])->one();
    if(!empty($model)){
        return $model->APPA_PER.' '.$model->APMA_PER.' '.$model->NOMB_PER;
        }
        return null;
    }

    public static function get_VIGENTE($id, $inicio=null, $fin=null){
        $bw='';
        $model=[];
        if($id!=null){
            if($inicio!=null && $fin!=null){
                $bw=' AND FECH_PRE BETWEEN CAST("'.$inicio.'" AS DATE) AND CAST("'.$fin.'" AS DATE)';
            }
            $model = Yii::$app->db->createCommand('
                SELECT * FROM prestado
                    INNER JOIN articulo ON ARTI_PRS=ID_ART
                        INNER JOIN prestamo ON PRES_PRS=ID_PRE                
                            INNER JOIN ambiente ON LUGA_PRE=ID_AMB
                                WHERE (
                                    ARTI_PRS=ID_ART AND
                                    PRES_PRS=ID_PRE AND
                                    LUGA_PRE=ID_AMB AND
                                    PERS_PRE='.$id.$bw.')')->queryAll();
        }
    if(!empty($model)){
        $c=0;
        $art['Persona']=
                Persona::find()
                    ->where(
                            ['ID_PER'=>$model[$c]['PERS_PRE']]
                    )->one()->Nombrecompleto;
        foreach ($model as $md) {
            $art['Prestamo'][$c]['FECHA']=$md['FECH_PRE'];
            $art['Prestamo'][$c]['HORA']=$md['HORA_PRE'];
            $art['Prestamo'][$c]['LUGAR']=$md['NOMB_AMB'];
            $art['Prestamo'][$c]['ARTICULO']=$md['DETA_ART'].' S/N => '.$md['SERI_ART'];
            $art['Prestamo'][$c]['ENCARGADO']=$md['ENCA_PRE'];
            $art['Prestamo'][$c]['ENCARGADO']=
                User::find()
                    ->where(
                            ['id'=>$md['ENCA_PRE']]
                    )->one()->username;
            $art['Prestamo'][$c]['VIGENTE']=$md['VIGE_PRS'] ? 'SI' : 'NO';
            $c++;
        }
        return $art;
        }
        return null;
    }
    public function getPER()
    {
        return $this->hasOne(Persona::className(), ['ID_PER' => 'PERS_PRE']);
    }
}
