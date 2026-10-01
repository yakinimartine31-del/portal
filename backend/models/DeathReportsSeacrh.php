<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DeathReports;

/**
 * DeathReportsSeacrh represents the model behind the search form of `app\models\DeathReports`.
 */
class DeathReportsSeacrh extends DeathReports
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'current_status_id'], 'integer'],
            [['date_time', 'member_number', 'pensioner_number', 'death_date', 'death_place', 'death_cause', 'death_certificate', 'type'], 'safe'],
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
        $query = DeathReports::find();

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
            'death_date' => $this->death_date,
            'current_status_id' => $this->current_status_id,
        ]);

        $query->andFilterWhere(['like', 'member_number', $this->member_number])
            ->andFilterWhere(['like', 'pensioner_number', $this->pensioner_number])
            ->andFilterWhere(['like', 'death_place', $this->death_place])
            ->andFilterWhere(['like', 'death_cause', $this->death_cause])
            ->andFilterWhere(['like', 'death_certificate', $this->death_certificate])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
