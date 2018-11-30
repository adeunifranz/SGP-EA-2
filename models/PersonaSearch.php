<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Persona;

/**
 * PersonaSearch represents the model behind the search form about `app\modules\master\models\Persona`.
 */
class PersonaSearch extends Persona
{
    /**
     * @inheritdoc
     */
    public $Nombrecompleto;

    public function rules()
    {
        return [
            [['ID_PER', 'Nombrecompleto', 'NOMB_PER', 'APPA_PER', 'APMA_PER', 'CAID_PER', 'DIRE_PER', 'REUN_PER'], 'safe'],
            [['TELE_PER'], 'integer'],
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
        //$query = Persona::find();
        $query = Persona::find();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->setSort([ 
                'attributes' => [ 
                    'ID_PER',
                    'Nombrecompleto' => [
                        'asc' => ['NOMB_PER' => SORT_ASC, 'APPA_PER' => SORT_ASC, 'APMA_PER' => SORT_ASC], 
                        'desc' => ['NOMB_PER' => SORT_DESC, 'APPA_PER' => SORT_DESC, 'APMA_PER' => SORT_DESC], 
                        'label' => 'Full Name', 
                        'default' => SORT_ASC 
                    ], 
                    'REUN_PER'
                ] 
            ]);

            if (!($this->load($params) && $this->validate())) {
                     return $dataProvider; 

            } 

            // filter by person full name 
            $query->andWhere('CONCAT(APPA_PER," ",APMA_PER," ",NOMB_PER) LIKE "%'.$this->Nombrecompleto. '%"'); 
          
        // grid filtering conditions
        $query->andFilterWhere([
            'TELE_PER' => $this->TELE_PER,
        ]);

        $query->andFilterWhere(['like', 'ID_PER', $this->ID_PER])
            ->andFilterWhere(['like', 'NOMB_PER', $this->NOMB_PER])
            ->andFilterWhere(['like', 'APPA_PER', $this->APPA_PER])
            ->andFilterWhere(['like', 'APMA_PER', $this->APMA_PER])
            ->andFilterWhere(['like', 'CAID_PER', $this->CAID_PER])
            ->andFilterWhere(['like', 'DIRE_PER', $this->DIRE_PER])
            ->andFilterWhere(['like', 'REUN_PER', $this->REUN_PER]);

        return $dataProvider;
    }
}
