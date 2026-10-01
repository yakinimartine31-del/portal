<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ContributionTrend;

/**
 * ContributionTrendSearch represents the model behind the search form of `frontend\models\ContributionTrend`.
 */
class ContributionTrendSearch extends ContributionTrend
{
    public $date1;
    public $date2;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ContributionYear','date2','date1'], 'integer'],
           // [['member_id', 'date_time','date1','date2'], 'safe'],
          //  [['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER', 'JANUARYC', 'FEBRUARYC', 'MARCHC', 'APRILC', 'MAYC', 'JUNEC', 'JULYC', 'AUGUSTC', 'SEPTEMBERC', 'OCTOBERC', 'NOVEMBERC', 'DECEMBERC', 'AnnualMonthsContributed', 'AnnualSalaryContributed', 'AnnualTotalContributed'], 'number'],
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
        $member=Members::findOne(['uid'=>\Yii::$app->user->identity->getId()]);
        $query->where(['member_id'=>$member['member_sys_id']]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 100],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
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
         //   'ContributionYear' => $this->ContributionYear,
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
            ->andFilterWhere(['between','ContributionYear', $this->date1, $this->date2]);

        return $dataProvider;
    }
}
