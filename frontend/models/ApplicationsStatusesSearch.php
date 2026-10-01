<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ApplicationsStatuses;

/**
 * ApplicationsStatusesSearch represents the model behind the search form of `frontend\models\ApplicationsStatuses`.
 */
class ApplicationsStatusesSearch extends ApplicationsStatuses
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date_time', 'application_date', 'benefit_type', 'employer_number', 'processing_stage_name', 'application_status', 'payment_date', 'member_number'], 'safe'],
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
        $query = ApplicationsStatuses::find();
        $user_id=\Yii::$app->user->identity->getId();
        $member=Members::find()->where(['uid'=>$user_id])->one();
        $query->where(['member_number'=>$member['membership_number']]);
            //->andWhere(['application_status'=>'Pending']);
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
            'application_date' => $this->application_date,
            'payment_date' => $this->payment_date,
        ]);

        $query->andFilterWhere(['like', 'benefit_type', $this->benefit_type])
            ->andFilterWhere(['like', 'employer_number', $this->employer_number])
            ->andFilterWhere(['like', 'processing_stage_name', $this->processing_stage_name])
            ->andFilterWhere(['like', 'application_status', $this->application_status])
            ->andFilterWhere(['like', 'member_number', $this->member_number]);

        return $dataProvider;
    }
}
