<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AuditTrial;

/**
 * AuditTrialSearch represents the model behind the search form of `backend\models\AuditTrial`.
 */
class AuditTrialSearch extends AuditTrial
{
    public $date1;
    public $date2;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','category'], 'integer'],
            [['activity', 'items', 'module', 'action', 'old', 'new', 'maker', 'maker_time','date1','date2'], 'safe'],
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
        $query = AuditTrial::find();

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
        ]);

        $query->andFilterWhere(['like', 'activity', $this->activity])
            ->andFilterWhere(['like', 'items', $this->items])
            ->andFilterWhere(['like', 'module', $this->module])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'old', $this->old])
            ->andFilterWhere(['like', 'new', $this->new])
            ->andFilterWhere(['like', 'maker', $this->maker])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['between', 'date(maker_time)', $this->date1,$this->date2]);

        return $dataProvider;
    }
}
