<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Contributions;

/**
 * ContributionsSearch represents the model behind the search form of `frontend\models\Contributions`.
 */
class ContributionsSearch extends Contributions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cont_month', 'cont_year'], 'integer'],
            [['date_time', 'member_number', 'transaction_id', 'contributing_period', 'latest_updated'], 'safe'],
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
        $member=Members::findOne(['uid'=>\Yii::$app->user->identity->getId()]);
        $query->where(['member_number'=>$member['membership_number']]);
        $query->limit(1);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 300],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
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
            ->andFilterWhere(['like', 'contributing_period', $this->contributing_period]);

        return $dataProvider;
    }


    public function searchLast($params)
    {
        $query = Contributions::find();
        $member=Members::findOne(['uid'=>\Yii::$app->user->identity->getId()]);

        $query->where(['member_number'=>$member['membership_number']]);
        $query->limit(1);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 300],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
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
            ->andFilterWhere(['like', 'contributing_period', $this->contributing_period]);

        return $dataProvider;
    }
}
