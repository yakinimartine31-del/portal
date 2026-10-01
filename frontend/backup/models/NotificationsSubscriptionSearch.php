<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\NotificationsSubscription;

/**
 * NotificationsSubscriptionSearch represents the model behind the search form of `frontend\models\NotificationsSubscription`.
 */
class NotificationsSubscriptionSearch extends NotificationsSubscription
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'uid'], 'integer'],
            [['date_time', 'notification_method', 'notification_types'], 'safe'],
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
        $query = NotificationsSubscription::find();

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
            'uid' => $this->uid,
        ]);

        $query->andFilterWhere(['like', 'notification_method', $this->notification_method])
            ->andFilterWhere(['like', 'notification_types', $this->notification_types]);

        return $dataProvider;
    }
}
