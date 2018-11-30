<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Varios;

/**
 * VariosSearch represents the model behind the search form about `app\models\Varios`.
 */
class VariosSearch extends Varios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_VAR', 'ARTI_VAR'], 'integer'],
            [['TIPO_VAR'], 'safe'],
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
        $query = Varios::find();

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
            'ID_VAR' => $this->ID_VAR,
            'ARTI_VAR' => $this->ARTI_VAR,
        ]);

        $query->andFilterWhere(['like', 'TIPO_VAR', $this->TIPO_VAR]);

        return $dataProvider;
    }
}
