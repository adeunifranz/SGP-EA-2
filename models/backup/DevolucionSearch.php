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
    public function rules()
    {
        return [
            [['ID_DEV', 'PRES_DEV', 'ENCA_DEV'], 'integer'],
            [['FECH_DEV', 'HORA_DEV', 'OBSE_DEV'], 'safe'],
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
        $query = Devolucion::find();

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
            'ID_DEV' => $this->ID_DEV,
            'PRES_DEV' => $this->PRES_DEV,
            'FECH_DEV' => $this->FECH_DEV,
            'HORA_DEV' => $this->HORA_DEV,
            'ENCA_DEV' => $this->ENCA_DEV,
        ]);

        $query->andFilterWhere(['like', 'OBSE_DEV', $this->OBSE_DEV]);

        return $dataProvider;
    }
}
