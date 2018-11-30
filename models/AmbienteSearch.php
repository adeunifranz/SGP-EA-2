<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ambiente;

/**
 * AmbienteSearch represents the model behind the search form about `app\models\Ambiente`.
 */
class AmbienteSearch extends Ambiente
{
    /**
     * @inheritdoc
     */
    public $PISO;

    public function rules()
    {
        return [
            [['ID_AMB', 'PISO_AMB'], 'integer'],
            [['NOMB_AMB', 'PISO'], 'safe'],
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
        $query = Ambiente::find()->leftJoin('piso', '`PISO_AMB` = `ID_PIS`');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->setSort([ 
                'attributes' => [ 
                    'ID_AMB', 
                    'PISO' => [
                        'asc' => ['NOMB_PIS' => SORT_ASC], 
                        'desc' => ['NOMB_PIS' => SORT_DESC], 
                        'label' => 'PISO', 
                        'default' => SORT_ASC 
                    ], 
                    'NOMB_AMB',
                    'PISO_AMB'
                ] 
            ]);   
            if (!($this->load($params) && $this->validate())) {
                     return $dataProvider; 
            } 

        // if (!$this->validate()) {
        //     // uncomment the following line if you do not want to return any records when validation fails
        //     // $query->where('0=1');
        //     return $dataProvider;
        // }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID_AMB' => $this->ID_AMB,
            'PISO_AMB' => $this->PISO_AMB,
        ]);

        $query->andFilterWhere(['like', 'NOMB_PIS' , $this->PISO]);
        $query->andFilterWhere(['like', 'NOMB_AMB', $this->NOMB_AMB]);

        return $dataProvider;
    }
}
