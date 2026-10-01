<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Complaints;

/**
 * ComplaintsSearch represents the model behind the search form of `frontend\models\Complaints`.
 */
class ComplaintsSearch extends Complaints
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['id', 'category'], 'integer'],
            [['date_time', 'zssf_number', 'subject', 'message', 'photo_file', 'email_address', 'phone_number', 'status_type'], 'safe'],
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
        $query = Complaints::find();
        $member=Members::find()->where(['uid'=>\Yii::$app->user->identity->getId()])->one();
        $member_no=$member['membership_number'];
        $query->where(['zssf_number'=>$member_no]);
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
            'category' => $this->category,
        ]);

        $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'photo_file', $this->photo_file])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'status_type', $this->status_type]);

        return $dataProvider;
    }
}
