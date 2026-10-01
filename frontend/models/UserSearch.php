<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\User;

/**
 * UserSearch represents the model behind the search form of `frontend\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'block', 'status', 'sendEmail', 'resetCount', 'requireReset'], 'integer'],
            [['name', 'username', 'email', 'password_hash', 'auth_key', 'password_reset_token', 'verification_token', 'registerDate', 'lastvisitDate', 'activation', 'params', 'lastResetTime', 'otpKey', 'otep'], 'safe'],
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
        $query = User::find();

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
            'block' => $this->block,
            'status' => $this->status,
            'sendEmail' => $this->sendEmail,
            'registerDate' => $this->registerDate,
            'lastvisitDate' => $this->lastvisitDate,
            'lastResetTime' => $this->lastResetTime,
            'resetCount' => $this->resetCount,
            'requireReset' => $this->requireReset,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
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
