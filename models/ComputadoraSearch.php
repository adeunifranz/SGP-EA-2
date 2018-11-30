<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Computadora;

/**
 * ComputadoraSearch represents the model behind the search form about `app\models\Computadora`.
 */
class ComputadoraSearch extends Computadora
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_COM', 'ARTI_COM'], 'integer'],
            [['SIOP_COM', 'PROC_COM', 'MEMO_COM', 'DIDU_COM', 'TAVI_COM', 'TIPO_COM'], 'safe'],
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
        $query = Computadora::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID_COM' => $this->ID_COM,
            'ARTI_COM' => $this->ARTI_COM,
        ]);

        $query->andFilterWhere(['like', 'SIOP_COM', $this->SIOP_COM])
            ->andFilterWhere(['like', 'PROC_COM', $this->PROC_COM])
            ->andFilterWhere(['like', 'MEMO_COM', $this->MEMO_COM])
            ->andFilterWhere(['like', 'DIDU_COM', $this->DIDU_COM])
            ->andFilterWhere(['like', 'TAVI_COM', $this->TAVI_COM])
            ->andFilterWhere(['like', 'TIPO_COM', $this->TIPO_COM]);

        return $dataProvider;
    }
}
