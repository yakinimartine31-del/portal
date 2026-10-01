<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ZssfMembers;

/**
 * ZssfMembersSearch represents the model behind the search form of `backend\models\ZssfMembers`.
 */
class ZssfMembersSearch extends ZssfMembers
{
    public $date_from;
    public $date_to;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','user_type'], 'integer'],
            [['date_time','date', 'full_names', 'membership_number', 'email', 'password', 'uid', 'group','date_from',
                'username', 'mobile_number', 'member_sys_id', 'photo', 'send_auth_code_via', 'auth_code','date_to',
                'date_of_birth', 'address', 'marital_status', 'gender', 'national_id', 'member_card',
                'date_of_joining', 'registration_id','previous_mobile_numbers'], 'safe'],
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
        $query = ZssfMembers::find();

      //  $query->joinWith(['user0']);
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
            'date_of_birth' => $this->date_of_birth,
            'date_of_joining' => $this->date_of_joining,
        ]);

        $query->andFilterWhere(['like', 'full_names', $this->full_names])
            ->andFilterWhere(['like', 'membership_number', $this->membership_number])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'uid', $this->uid])
            ->andFilterWhere(['like', 'group', $this->group])
            ->andFilterWhere(['=', 'user_type', $this->user_type])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'member_sys_id', $this->member_sys_id])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['between', 'date(date_time)', $this->date_from,$this->date_to])
            ->andFilterWhere(['like', 'send_auth_code_via', $this->send_auth_code_via])
            ->andFilterWhere(['like', 'auth_code', $this->auth_code])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'marital_status', $this->marital_status])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'national_id', $this->national_id])
            ->andFilterWhere(['like', 'member_card', $this->member_card])
            ->andFilterWhere(['like', 'previous_mobile_numbers', $this->previous_mobile_numbers])

            ->andFilterWhere(['like', 'registration_id', $this->registration_id]);

        return $dataProvider;
    }

    public function searchEmployer($params)
    {
        $query = ZssfMembers::find();
        $query->where(['user_type'=>12]);

      //  $query->joinWith(['user0']);
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
            'date_of_birth' => $this->date_of_birth,
            'date_of_joining' => $this->date_of_joining,
        ]);

        $query->andFilterWhere(['like', 'full_names', $this->full_names])
            ->andFilterWhere(['like', 'membership_number', $this->membership_number])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'uid', $this->uid])
            ->andFilterWhere(['like', 'group', $this->group])
            ->andFilterWhere(['=', 'user_type', $this->user_type])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'member_sys_id', $this->member_sys_id])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['between', 'date(date_time)', $this->date_from,$this->date_to])
            ->andFilterWhere(['like', 'send_auth_code_via', $this->send_auth_code_via])
            ->andFilterWhere(['like', 'auth_code', $this->auth_code])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'marital_status', $this->marital_status])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'national_id', $this->national_id])
            ->andFilterWhere(['like', 'member_card', $this->member_card])
            ->andFilterWhere(['like', 'previous_mobile_numbers', $this->previous_mobile_numbers])
            ->andFilterWhere(['like', 'registration_id', $this->registration_id]);

        return $dataProvider;
    }
}
