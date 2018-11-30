<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "articulo".
 *
 * @property string $ID_ART
 * @property string $COAS_ART
 * @property string $MARC_ART
 * @property string $SERI_ART
 * @property string $DETA_ART
 * @property string $FEAL_ART
 * @property string $HOAL_ART
 * @property string $ESTA_ART
 * @property string $COLO_ART
 * @property string $OBSE_ART
 * @property string $FOTO_ART
 *
 * @property Accesorio[] $accesorios
 * @property Foto $fOTOART
 * @property Computadora[] $computadoras
 * @property Devuelto[] $devueltos
 * @property Monitor[] $monitors
 * @property Mouse[] $mice
 * @property Parlante[] $parlantes
 * @property Prestado[] $prestados
 * @property Teclado[] $teclados
 * @property Varios[] $varios
 */
class Articulo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articulo';
    }


    public function getDetallado()
    {
        return $this->DETA_ART.' => SN: '.$this->SERI_ART;
    }

    public $foto;
    public $tipo_art;

    #ATRIBUTOS DE ACCESORIOS
    public $ESPE_ACC, $FUNC_ACC, $ARTI_ACC;

    #ATRIBUTO DE COMPUTADORA
    public $ID_COM, $SIOP_COM, $PROC_COM, $MEMO_COM, $DIDU_COM, $TAVI_COM, $TIPO_COM, $ARTI_COM;

    #ATRIBUTOS DE MONITOR
    public $TAMA_MON, $TIPO_MON, $ENTR_MON, $ARTI_MON;

    #ATRIBUTOS DE MOUSE
    public $TIPO_MOU, $ENTR_MOU, $ARTI_MOU;

    #ATRIBUTOS DE PARLANTE
    public $NELE_PAR, $ENTR_PAR, $ARTI_PAR;

    #ATRIBUTOS DE TECLADO
    public $DIST_TEC, $ENTR_TEC, $ARTI_TEC;

    #ATRIBUTOS DE VARIOS
    public $DETA_VAR, $ARTI_VAR;
    /**
     * @inheritdoc
     */

    public function rules()
    {
        return
        array_merge([
//        return [
            [['Persona', 'tipo_art'], 'safe'],
            [['OBSE_ART'], 'string'],
            [['COAS_ART'], 'string', 'max' => 25],
            [['COAS_ART'], 'match', 'pattern' => '/\b\d{2}[-]\d{2}[-]\d{2}[-][PS][BS0-9]?[-][A-Z]{3}[-]\d{5}\b/i'],
            [['MARC_ART'], 'string', 'max' => 15],
            //[['DETA_ART'], 'match', 'pattern'=>'/^[A-Z0-9-\s]+$/'],
            [['SERI_ART'], 'string', 'max' => 20],
            [['DISP_ART', 'ASIG_ART'], 'integer'],
            [['ASIG_ART'], 'required', 'message'=>'Elija una {attribute}'],
            [['DETA_ART'], 'string', 'max' => 50],
            //[['FEAL_ART'], 'date', 'format' => 'php:Y-m-d'],
            [['FEAL_ART'], 'required'],
            [['FEAL_ART'], 'safe'],
            //[['HOAL_ART'], 'time', 'format' => 'php:H:i:s'],
            [['HOAL_ART'], 'required'],
            [['HOAL_ART'], 'safe'],
            [['DETA_ART', 'ESTA_ART'], 'required'],
            [['ESTA_ART', 'COLO_ART'], 'string', 'max' => 10],
//            [['foto'], 'file', 'skipOnEmpty' => false],
             ['foto', 'file',
             //'skipOnEmpty' => false,
             //'uploadRequired' => 'No ha seleccionado una foto',
             'maxSize' => 1024*1024*1, //1 MB
             'tooBig' => 'el tamaño permitido es 1MB',
             'minSize' => 10, //10 Bytes
             'tooSmall' => 'El tamaño minimo permitido son 10 BYTES',
             'extensions' => 'jpg,jpeg,png,gif',
             'wrongExtension' => 'El archivo [foto] no contiene una extension permitida',
             'maxFiles' => 1,
             'tooMany' => 'El maximo de archivos permitidos son [limit]'
            ],
        ],
        Accesorio::rules(),
        Computadora::rules(),
        Monitor::rules(),
        Mouse::rules(),
        Parlante::rules(),
        Teclado::rules(),
        Varios::rules()
        );
    }

    /**
     * @inheritdoc
     */
    public function tipo()
    {
        $id=$this->ID_ART;
        $model2 = \app\models\Accesorio::find()
        ->where(['ARTI_ACC' => $id])
        ->one();
        $tipo=null;
        if ($model2 != null) {
            $tipo='accesorio';
        } else {
            $model2 = \app\models\Computadora::find()->where(['ARTI_COM' => $id])->one();
            if ($model2 != null) {
                $tipo='computadora';
            } else {
                $model2 = \app\models\Monitor::find()->where(['ARTI_MON' => $id])->one();
                if ($model2 != null) {
                    $tipo='monitor';
                } else {
                    $model2 = \app\models\Mouse::find()->where(['ARTI_MOU' => $id])->one();
                    if ($model2 != null) {
                        $tipo='mouse';
                    } else {
                        $model2 = \app\models\Parlante::find()->where(['ARTI_PAR' => $id])->one();
                        if ($model2 != null) {
                            $tipo='parlante';
                        } else {
                            $model2 = \app\models\Teclado::find()->where(['ARTI_TEC' => $id])->one();
                            if ($model2 != null) {
                                $tipo='teclado';
                            } else {
                                $model2 = \app\models\Varios::find()->where(['ARTI_VAR' => $id])->one();
                                if ($model2 != null) {
                                    $tipo='varios';
                                }
                            }
                        }
                    }
                }
            }
        }       
            return $tipo;
    }

    public function init()
    {
        $tipo=null;
            $id=$this->ID_ART;
            $model2 = \app\models\Accesorio::find()
            ->where(['ARTI_ACC' => $id])
            ->one();
            if ($model2 != null) {
                $tipo='accesorio';
            } else {
                $model2 = \app\models\Computadora::find()->where(['ARTI_COM' => $id])->one();
                if ($model2 != null) {
                    $tipo='computadora';
                } else {
                    $model2 = \app\models\Monitor::find()->where(['ARTI_MON' => $id])->one();
                    if ($model2 != null) {
                        $tipo='monitor';
                    } else {
                        $model2 = \app\models\Mouse::find()->where(['ARTI_MOU' => $id])->one();
                        if ($model2 != null) {
                            $tipo='mouse';
                        } else {
                            $model2 = \app\models\Parlante::find()->where(['ARTI_PAR' => $id])->one();
                            if ($model2 != null) {
                                $tipo='parlante';
                            } else {
                                $model2 = \app\models\Teclado::find()->where(['ARTI_TEC' => $id])->one();
                                if ($model2 != null) {
                                    $tipo='teclado';
                                } else {
                                    $model2 = \app\models\Varios::find()->where(['ARTI_VAR' => $id])->one();
                                    if ($model2 != null) {
                                        $tipo='varios';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        $this->tipo_art = $tipo;
        parent::init();
    }


    public function attributeLabels()
    {
        return
        array_merge([
//        return [
            'Detallado'=> 'DETALLE + SERIE',
            'ID_ART' => 'CODIGO',
            'COAS_ART' => 'CODIGO DE ASIGNACION',
            'MARC_ART' => 'MARCA',
            'SERI_ART' => 'SERIE',
            'DETA_ART' => 'DESCRIPCION',
            'FEAL_ART' => 'FECHA DE ALTA',
            'HOAL_ART' => 'HORA DE ALTA',
            'ESTA_ART' => 'ESTADO',
            'COLO_ART' => 'COLOR',
            'OBSE_ART' => 'OBSERVACIONES',
            'FOTO_ART' => 'FOTO',
            'DISP_ART' => 'DISPOSICION',
            'ASIG_ART' => 'ASIGNACION DE USO',
            'tipo_art' => 'TIPO DE ARTICULO',
        ],
        Accesorio::attributeLabels(),
        Computadora::attributeLabels(),
        Monitor::attributeLabels(),
        Mouse::attributeLabels(),
        Parlante::attributeLabels(),
        Teclado::attributeLabels(),
        Varios::attributeLabels()
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesorios()
    {
        return $this->hasMany(Accesorio::className(), ['ARTI_ACC' => 'ID_ART']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComputadoras()
    {
        return $this->hasMany(Computadora::className(), ['ARTI_COM' => 'ID_ART']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevueltos()
    {
        return $this->hasMany(Devuelto::className(), ['ARTI_DVS' => 'ID_ART']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonitors()
    {
        return $this->hasMany(Monitor::className(), ['ARTI_MON' => 'ID_ART']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMice()
    {
        return $this->hasMany(Mouse::className(), ['ARTI_MOU' => 'ID_ART']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParlantes()
    {
        return $this->hasMany(Parlante::className(), ['ARTI_PAR' => 'ID_ART']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestados()
    {
        return $this->hasMany(Prestado::className(), ['ARTI_PRS' => 'ID_ART']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeclados()
    {
        return $this->hasMany(Teclado::className(), ['ARTI_TEC' => 'ID_ART']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */ 
    public function getVarios()
    {
        return $this->hasMany(Varios::className(), ['ARTI_VAR' => 'ID_ART']);
    }

    public function getEstado($id) {
    $estado = [0=>'Disponible', 1=>'Prestado', 2=>'Baja'];
        return $estado[$id];
    }
    public static function ASIG($id){
        if($id==0){
            return 'PRESTAMO';
            } elseif ($id==1) {
                return 'ACTIVO FIJO';
            } elseif ($id==2) {
                return 'SOLO EN DEPÓSITO';
        }
    }

    public function getPersona()
    {

        // $prestado=Prestado::find()->where(['and','ARTI_PRS='.$this->ID_ART,'VIGE_PRS=1'])
        //         ->one();

        // $prestado=Prestado::findBySql('SELECT * FROM prestado WHERE ARTI_PRS='.$this->ID_ART,' AND VIGE_PRS=1')->one();

        // $prestamo=Prestamo::find()->where('ID_PRE='.$prestado->PRES_PRS)->one();

        // $persona=Persona::find($prestamo->PERS_PRE)->one();      

        // $persona=Persona::findBySql('
        //     SELECT * FROM persona WHERE ID_PER = 
        //     (SELECT PERS_PRE FROM prestamo WHERE ID_PRE=
        //         (SELECT PRES_PRS FROM prestado WHERE ARTI_PRS=
        //             (SELECT ID_ART FROM articulo WHERE DISP_ART=1 AND ID_ART='.$this->ID_ART.
        //         ' LIMIT 1)
        //         LIMIT 1)
        //     LIMIT 1)')->one();      
        $persona=Persona::findBySql('
            SELECT *
            FROM articulo JOIN prestado JOIN prestamo JOIN persona
            ON ID_ART=ARTI_PRS AND PRES_PRS=ID_PRE AND PERS_PRE=ID_PER
            WHERE ID_ART=ARTI_PRS AND PRES_PRS=ID_PRE AND PERS_PRE=ID_PER 
            AND VIGE_PRS=1
            AND ID_ART=
            '.$this->ID_ART
        )->one();

        if($persona!=null) {
            return $persona->Nombrecompleto;
            //$this->ID_ART;
        } else {
            return null;
        }



    }
}
