<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Drug;

/**
 * CountrySearch represents the model behind the search form of `app\models\Country`.
 */
class DrugSearch extends Drug
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['D_ID', 'D_Name','D_Prop','D_Type'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Drug::find();

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
            'D_ID' => $this->D_ID,
        ]);

        $query->andFilterWhere(['like', 'D_Name', $this->D_Name]);
        $query->andFilterWhere(['like', 'D_Prop', $this->D_Prop]);

        return $dataProvider;
    }
}
