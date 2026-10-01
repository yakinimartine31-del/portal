<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ZssfBackendMembersSimulation;

/**
 * ZssfBackendMembersSimulationSearch represents the model behind the search form of `frontend\models\ZssfBackendMembersSimulation`.
 */
class ZssfBackendMembersSimulationSearch extends ZssfBackendMembersSimulation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date_time', 'member_number', 'mobile_number', 'email', 'validation_code', 'member_code', 'first_name', 'second_name', 'last_name', 'address', 'join_date', 'full_names', 'birthday'], 'safe'],
            [['amount'], 'number'],
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
        $query = ZssfBackendMembersSimulation::find();

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
            'id' => $this->id,
            'date_time' => $this->date_time,
            'join_date' => $this->join_date,
            'amount' => $this->amount,
            'birthday' => $this->birthday,
        ]);

        $query->andFilterWhere(['like', 'member_number', $this->member_number])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'validation_code', $this->validation_code])
            ->andFilterWhere(['like', 'member_code', $this->member_code])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'second_name', $this->second_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'full_names', $this->full_names]);

        return $dataProvider;
    }
}
