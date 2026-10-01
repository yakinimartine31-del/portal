<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SmsLogs;

/**
 * SmsLogsSearch represents the model behind the search form of `backend\models\SmsLogs`.
 */
class SmsLogsSearch extends SmsLogs
{

    public $date1;
    public $date2;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','msg_category_id'], 'integer'],
            [['date_time', 'recipient_number', 'message', 'sms_status', 'member_number','date1','date2',], 'safe'],
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
        $query = SmsLogs::find();

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
        ]);

        $query->andFilterWhere(['like', 'recipient_number', $this->recipient_number])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'sms_status', $this->sms_status])
            ->andFilterWhere(['like', 'member_number', $this->member_number])
            ->andFilterWhere(['like', 'msg_category_id', $this->msg_category_id])
            ->andFilterWhere(['between', 'date(date_time)', $this->date1,$this->date2]);

        return $dataProvider;
    }
}
