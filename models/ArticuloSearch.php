<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Articulo;

/**
 * ArticuloSearch represents the model behind the search form about `app\models\Articulo`.
 */
class ArticuloSearch extends Articulo
{
    /**
     * @inheritdoc
     */
    public $Detallado;

    public function rules()
    {
        return [
            [['ID_ART', 'FOTO_ART'], 'integer'],
            [['Detallado' ,'COAS_ART', 'MARC_ART', 'SERI_ART', 'DETA_ART', 'FEAL_ART', 'HOAL_ART', 'ESTA_ART', 'COLO_ART', 'OBSE_ART','DISP_ART'], 'safe'],
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
        $query = Articulo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->setSort([ 
                'attributes' => [ 
                    'ID_ART',
                    'FEAL_ART',
                    'HOAL_ART',
                    'COLO_ART',
                    'ESTA_ART',
                    'DISP_ART',
                    'MARC_ART',
                    'SERI_ART',
                    'Detallado' => [
                        'asc' => ['DETA_ART' => SORT_ASC, 'SERI_ART' => SORT_ASC], 
                        'desc' => ['DETA_ART' => SORT_DESC, 'SERI_ART' => SORT_DESC], 
                        'label' => 'Detallado', 
                        'default' => SORT_ASC 
                    ], 
                    'DETA_ART'
                ] 
            ]);   
            if (!($this->load($params) && $this->validate())) {
                     return $dataProvider; 
            } 


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // filter by person full name 
        $query->andWhere('DETA_ART LIKE "%' . $this->Detallado. '%" OR SERI_ART LIKE "%' . $this->Detallado . '%" '); 


        // grid filtering conditions
        $query->andFilterWhere([
            'ID_ART' => $this->ID_ART,
            'FEAL_ART' => $this->FEAL_ART,
            'HOAL_ART' => $this->HOAL_ART,
            'FOTO_ART' => $this->FOTO_ART,
        ]);

        $query->andFilterWhere(['like', 'COAS_ART', $this->COAS_ART])
            ->andFilterWhere(['like', 'MARC_ART', $this->MARC_ART])
            ->andFilterWhere(['like', 'SERI_ART', $this->SERI_ART])
            ->andFilterWhere(['like', 'DETA_ART', $this->DETA_ART])
            ->andFilterWhere(['like', 'ESTA_ART', $this->ESTA_ART])
            ->andFilterWhere(['like', 'COLO_ART', $this->COLO_ART])
            ->andFilterWhere(['like', 'OBSE_ART', $this->OBSE_ART])
            ->andFilterWhere(['like', 'DISP_ART', $this->DISP_ART]);

        return $dataProvider;
    }
}
