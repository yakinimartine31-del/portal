<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Members;

/**
 * MembersSearch represents the model behind the search form of `frontend\models\Members`.
 */
class MembersSearch extends Members
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date_time','previous_mobile_numbers','full_names', 'membership_number', 'email', 'password', 'uid', 'group', 'username', 'mobile_number', 'member_sys_id', 'photo', 'send_auth_code_via', 'auth_code', 'date_of_birth', 'address', 'marital_status', 'gender', 'national_id', 'member_card'], 'safe'],
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
        $query = Members::find();

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
            'date_of_birth' => $this->date_of_birth,
        ]);

        $query->andFilterWhere(['like', 'full_names', $this->full_names])
            ->andFilterWhere(['like', 'membership_number', $this->membership_number])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'uid', $this->uid])
            ->andFilterWhere(['like', 'group', $this->group])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'member_sys_id', $this->member_sys_id])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'send_auth_code_via', $this->send_auth_code_via])
            ->andFilterWhere(['like', 'auth_code', $this->auth_code])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'marital_status', $this->marital_status])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'previous_mobile_numbers', $this->previous_mobile_numbers])
            ->andFilterWhere(['like', 'national_id', $this->national_id])
            ->andFilterWhere(['like', 'member_card', $this->member_card]);

        return $dataProvider;
    }

    public function searchCard($params)
    {
        $query = Members::find();
        $user_id=\Yii::$app->user->identity->getId();
        $member=Members::find()->where(['uid'=>$user_id])->one();
        $query->where(['membership_number'=>$member['membership_number']]);

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
            'date_of_birth' => $this->date_of_birth,
        ]);

        $query->andFilterWhere(['like', 'full_names', $this->full_names])
            ->andFilterWhere(['like', 'membership_number', $this->membership_number])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'uid', $this->uid])
            ->andFilterWhere(['like', 'group', $this->group])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'member_sys_id', $this->member_sys_id])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'send_auth_code_via', $this->send_auth_code_via])
            ->andFilterWhere(['like', 'auth_code', $this->auth_code])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'marital_status', $this->marital_status])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'previous_mobile_numbers', $this->previous_mobile_numbers])
            ->andFilterWhere(['like', 'national_id', $this->national_id])
            ->andFilterWhere(['like', 'member_card', $this->member_card]);

        return $dataProvider;
    }
}
