<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Treatmentrecord;

/**
 * CountrySearch represents the model behind the search form of `app\models\Country`.
 */
class MedicalSearch extends Treatmentrecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TR_ID', 'Employee_Em_ID', 'Nurse_N_ID'], 'safe'],
            [['TR_Date', 'TR_StartRest', 'TR_EndRest'], 'safe'],
            [['TR_Rest', 'TR_Status'], 'integer'],
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
        $query = Treatmentrecord::find();

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
            'TR_ID' => $this->TR_ID,
        ]);

        $query->andFilterWhere(['like', 'TR_ID', $this->TR_ID]);
        $query->andFilterWhere(['like', 'Nurse_N_ID', $this->Nurse_N_ID]);

        return $dataProvider;
    }
}
