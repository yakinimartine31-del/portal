<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\BufferResults;

/**
 * BufferResultsSearch represents the model behind the search form of `frontend\models\BufferResults`.
 */
class BufferResultsSearch extends BufferResults
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['TotalNumberOfContribution', 'BestAverageEarning', 'TotalContributions', 'ContributionAfterRetirement', 'Gratuity', 'MonthlyPension', 'Refund', 'ContBeforeRetirement', 'MONTHLYPENSIONCALCULATED', 'MPFormula', 'MPFormulawnumber', 'GTFormula', 'GTFormulawnumber', 'RFFormula', 'RFFormulawnumber', 'member_number', 'latest_updated'], 'safe'],
            [['latest_contribution'], 'number'],
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
        $user=\Yii::$app->user->identity->getId();
        $member_number=Members::find()->where(['uid'=>$user])->one();

        $query = BufferResults::find();
        $query->where(['member_number'=>$member_number['membership_number']]);
        $query->groupBy('type');

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
            'type' => $this->type,
            'latest_contribution' => $this->latest_contribution,
            'latest_updated' => $this->latest_updated,
        ]);

        $query->andFilterWhere(['like', 'TotalNumberOfContribution', $this->TotalNumberOfContribution])
            ->andFilterWhere(['like', 'BestAverageEarning', $this->BestAverageEarning])
            ->andFilterWhere(['like', 'TotalContributions', $this->TotalContributions])
            ->andFilterWhere(['like', 'ContributionAfterRetirement', $this->ContributionAfterRetirement])
            ->andFilterWhere(['like', 'Gratuity', $this->Gratuity])
            ->andFilterWhere(['like', 'MonthlyPension', $this->MonthlyPension])
            ->andFilterWhere(['like', 'Refund', $this->Refund])
            ->andFilterWhere(['like', 'ContBeforeRetirement', $this->ContBeforeRetirement])
            ->andFilterWhere(['like', 'MONTHLYPENSIONCALCULATED', $this->MONTHLYPENSIONCALCULATED])
            ->andFilterWhere(['like', 'MPFormula', $this->MPFormula])
            ->andFilterWhere(['like', 'MPFormulawnumber', $this->MPFormulawnumber])
            ->andFilterWhere(['like', 'GTFormula', $this->GTFormula])
            ->andFilterWhere(['like', 'GTFormulawnumber', $this->GTFormulawnumber])
            ->andFilterWhere(['like', 'RFFormula', $this->RFFormula])
            ->andFilterWhere(['like', 'RFFormulawnumber', $this->RFFormulawnumber])
            ->andFilterWhere(['like', 'member_number', $this->member_number]);

        return $dataProvider;
    }

    public function searchResults($params)
    {
        $query = BufferResults::find();
        $user=\Yii::$app->user->identity->getId();
        $member_number=Members::find()->where(['uid'=>$user])->one();
        $query->where(['member_number'=>$member_number['membership_number']]);

        $query->groupBy('type');

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
            'type' => $this->type,
            'latest_contribution' => $this->latest_contribution,
            'latest_updated' => $this->latest_updated,
        ]);

        $query->andFilterWhere(['like', 'TotalNumberOfContribution', $this->TotalNumberOfContribution])
            ->andFilterWhere(['like', 'BestAverageEarning', $this->BestAverageEarning])
            ->andFilterWhere(['like', 'TotalContributions', $this->TotalContributions])
            ->andFilterWhere(['like', 'ContributionAfterRetirement', $this->ContributionAfterRetirement])
            ->andFilterWhere(['like', 'Gratuity', $this->Gratuity])
            ->andFilterWhere(['like', 'MonthlyPension', $this->MonthlyPension])
            ->andFilterWhere(['like', 'Refund', $this->Refund])
            ->andFilterWhere(['like', 'ContBeforeRetirement', $this->ContBeforeRetirement])
            ->andFilterWhere(['like', 'MONTHLYPENSIONCALCULATED', $this->MONTHLYPENSIONCALCULATED])
            ->andFilterWhere(['like', 'MPFormula', $this->MPFormula])
            ->andFilterWhere(['like', 'MPFormulawnumber', $this->MPFormulawnumber])
            ->andFilterWhere(['like', 'GTFormula', $this->GTFormula])
            ->andFilterWhere(['like', 'GTFormulawnumber', $this->GTFormulawnumber])
            ->andFilterWhere(['like', 'RFFormula', $this->RFFormula])
            ->andFilterWhere(['like', 'RFFormulawnumber', $this->RFFormulawnumber])
            ->andFilterWhere(['like', 'member_number', $this->member_number]);

        return $dataProvider;
    }
}
