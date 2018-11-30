<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prestamo;

/**
 * PrestamoSearch represents the model behind the search form about `app\models\Prestamo`.
 */
class PrestamoSearch extends Prestamo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_PRE', 'PERS_PRE', 'LUGA_PRE', 'ENCA_PRE'], 'integer'],
            [['FECH_PRE', 'HORA_PRE', 'DOCU_PRE', 'OBSE_PRE'], 'safe'],
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
        $query = Prestamo::find();
        $query->joinWith('pERSPRE');
        //$query->where(['PERS_PRE'=>'ID_PER']);

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
            'ID_PRE' => $this->ID_PRE,
            'FECH_PRE' => $this->FECH_PRE,
            'HORA_PRE' => $this->HORA_PRE,
            'PERS_PRE' => $this->PERS_PRE,
            'LUGA_PRE' => $this->LUGA_PRE,
            'ENCA_PRE' => $this->ENCA_PRE,
        ]);

        $query->andFilterWhere(['like', 'DOCU_PRE', $this->DOCU_PRE])
            ->andFilterWhere(['like', 'OBSE_PRE', $this->OBSE_PRE]);

        return $dataProvider;
    }
}


