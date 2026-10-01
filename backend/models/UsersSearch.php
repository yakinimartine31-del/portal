<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Users;

/**
 * UsersSearch represents the model behind the search form of `backend\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'block', 'status', 'sendEmail', 'resetCount', 'requireReset', 'created_by'], 'integer'],
            [['name', 'username', 'email', 'password', 'auth_key', 'password_reset_token', 'verification_token', 'registerDate', 'lastvisitDate', 'activation', 'params', 'lastResetTime', 'otpKey', 'otep', 'create_at', 'updated_at'], 'safe'],
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
        $query = Users::find();

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
            'block' => $this->block,
            'status' => $this->status,
            'sendEmail' => $this->sendEmail,
            'registerDate' => $this->registerDate,
            'lastvisitDate' => $this->lastvisitDate,
            'lastResetTime' => $this->lastResetTime,
            'resetCount' => $this->resetCount,
            'requireReset' => $this->requireReset,
            'create_at' => $this->create_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'activation', $this->activation])
            ->andFilterWhere(['like', 'params', $this->params])
            ->andFilterWhere(['like', 'otpKey', $this->otpKey])
            ->andFilterWhere(['like', 'otep', $this->otep]);

        return $dataProvider;
    }

    public function searchActive($params)
    {
        $query = Users::find()->where(['staff_login' => 1]);

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
            'block' => $this->block,
            'status' => $this->status,
            'sendEmail' => $this->sendEmail,
            'registerDate' => $this->registerDate,
            'lastvisitDate' => $this->lastvisitDate,
            'lastResetTime' => $this->lastResetTime,
            'resetCount' => $this->resetCount,
            'requireReset' => $this->requireReset,
            'create_at' => $this->create_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'activation', $this->activation])
            ->andFilterWhere(['like', 'params', $this->params])
            ->andFilterWhere(['like', 'otpKey', $this->otpKey])
            ->andFilterWhere(['like', 'otep', $this->otep]);

        return $dataProvider;
    }

    public function searchSheha($params)
    {
        $sheha = ZssfMembers::find()
            ->select(['uid'])
            ->where(['user_type' => 16])
            ->asArray();
        $query = Users::find()
            ->where(['in', 'id', $sheha]);

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
            'block' => $this->block,
            'status' => $this->status,
            'sendEmail' => $this->sendEmail,
            'registerDate' => $this->registerDate,
            'lastvisitDate' => $this->lastvisitDate,
            'lastResetTime' => $this->lastResetTime,
            'resetCount' => $this->resetCount,
            'requireReset' => $this->requireReset,
            'create_at' => $this->create_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'activation', $this->activation])
            ->andFilterWhere(['like', 'params', $this->params])
            ->andFilterWhere(['like', 'otpKey', $this->otpKey])
            ->andFilterWhere(['like', 'otep', $this->otep]);

        return $dataProvider;
    }
}
