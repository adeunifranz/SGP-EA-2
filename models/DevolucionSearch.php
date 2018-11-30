<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Devolucion;

/**
 * DevolucionSearch represents the model behind the search form about `app\models\Devolucion`.
 */
class DevolucionSearch extends Devolucion
{
    /**
     * @inheritdoc
     */
    public $Personal;

    public function rules()
    {
        return [
            [['ID_DEV', 'ENCA_DEV', 'PRES_DEV'], 'integer'],
            [['Prestado','FECH_DEV', 'HORA_DEV', 'OBSE_DEV', 'Personal'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Devolucion::find()->leftJoin('prestamo', '`PRES_DEV` = `ID_PRE`')->leftJoin('persona', '`PERS_PRE` = `ID_PER`');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->setSort([ 
                'attributes' => [ 
                    'FECH_DEV',
                    'HORA_DEV',
                    'Personal' => [
                        'asc' => ['NOMB_PER' => SORT_ASC, 'APPA_PER' => SORT_ASC, 'APMA_PER' => SORT_ASC], 
                        'desc' => ['NOMB_PER' => SORT_DESC, 'APPA_PER' => SORT_DESC, 'APMA_PER' => SORT_DESC], 
                        'label' => 'Full Name', 
                        'default' => SORT_ASC 
                    ], 
                ] 
            ]);   

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

            $query->andWhere('CONCAT(APPA_PER," ",APMA_PER," ",NOMB_PER) LIKE "%'. $this->Personal . '%"'); 

        // grid filtering conditions
        $query->andFilterWhere([
            'Prestado' => $this->Prestado,
            'ID_DEV' => $this->ID_DEV,
            'FECH_DEV' => $this->FECH_DEV,
            'HORA_DEV' => $this->HORA_DEV,
            'ENCA_DEV' => $this->ENCA_DEV,
            'PRES_DEV' => $this->PRES_DEV
        ]);

        $query->andFilterWhere(['like', 'OBSE_DEV', $this->OBSE_DEV]);

        return $dataProvider;
    }
}
