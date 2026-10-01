<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Contributions;

/**
 * ContributionsSearch represents the model behind the search form of `backend\models\Contributions`.
 */
class ContributionsSearch extends Contributions
{
    public $date1;
    public $date2;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cont_month', 'cont_year'], 'integer'],
            [['date_time', 'member_number', 'transaction_id', 'contributing_period', 'latest_updated','date1','date2'], 'safe'],
            [['amount', 'salary'], 'number'],
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
        $query = Contributions::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 250
            ],
            'sort' => ['defaultOrder' => [
                'id' => SORT_DESC,
            ]
            ]
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
            'cont_month' => $this->cont_month,
            'cont_year' => $this->cont_year,
            'amount' => $this->amount,
            'salary' => $this->salary,
            'latest_updated' => $this->latest_updated,
        ]);

        $query->andFilterWhere(['like', 'member_number', $this->member_number])
            ->andFilterWhere(['like', 'transaction_id', $this->transaction_id])
            ->andFilterWhere(['=', 'cont_year', $this->date1])
            ->andFilterWhere(['=', 'cont_month', $this->date2])
            ->andFilterWhere(['like', 'contributing_period', $this->contributing_period]);

        return $dataProvider;
    }
}
