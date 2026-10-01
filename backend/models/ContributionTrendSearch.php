<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ContributionTrend;

/**
 * ContributionTrendSearch represents the model behind the search form of `backend\models\ContributionTrend`.
 */
class ContributionTrendSearch extends ContributionTrend
{
   public $date1;
   public $date2;
   public $member_number;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ContributionYear'], 'integer'],
            [['member_id', 'date_time','date1','date2','member_number'], 'safe'],
            [['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER', 'JANUARYC', 'FEBRUARYC', 'MARCHC', 'APRILC', 'MAYC', 'JUNEC', 'JULYC', 'AUGUSTC', 'SEPTEMBERC', 'OCTOBERC', 'NOVEMBERC', 'DECEMBERC', 'AnnualMonthsContributed', 'AnnualSalaryContributed', 'AnnualTotalContributed'], 'number'],
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
        $query = ContributionTrend::find();
        $query->joinWith(['memb']);

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
            'ContributionYear' => $this->ContributionYear,
            'JANUARY' => $this->JANUARY,
            'FEBRUARY' => $this->FEBRUARY,
            'MARCH' => $this->MARCH,
            'APRIL' => $this->APRIL,
            'MAY' => $this->MAY,
            'JUNE' => $this->JUNE,
            'JULY' => $this->JULY,
            'AUGUST' => $this->AUGUST,
            'SEPTEMBER' => $this->SEPTEMBER,
            'OCTOBER' => $this->OCTOBER,
            'NOVEMBER' => $this->NOVEMBER,
            'DECEMBER' => $this->DECEMBER,
            'JANUARYC' => $this->JANUARYC,
            'FEBRUARYC' => $this->FEBRUARYC,
            'MARCHC' => $this->MARCHC,
            'APRILC' => $this->APRILC,
            'MAYC' => $this->MAYC,
            'JUNEC' => $this->JUNEC,
            'JULYC' => $this->JULYC,
            'AUGUSTC' => $this->AUGUSTC,
            'SEPTEMBERC' => $this->SEPTEMBERC,
            'OCTOBERC' => $this->OCTOBERC,
            'NOVEMBERC' => $this->NOVEMBERC,
            'DECEMBERC' => $this->DECEMBERC,
            'AnnualMonthsContributed' => $this->AnnualMonthsContributed,
            'AnnualSalaryContributed' => $this->AnnualSalaryContributed,
            'AnnualTotalContributed' => $this->AnnualTotalContributed,
            'date_time' => $this->date_time,
        ]);

        $query->andFilterWhere(['like', 'member_id', $this->member_id])
        ->andFilterWhere(['=', 'sys_zssf_members.membership_number', $this->member_number])
      ->andFilterWhere(['between', 'ContributionYear', $this->date1,$this->date2]);

        return $dataProvider;
    }
}
