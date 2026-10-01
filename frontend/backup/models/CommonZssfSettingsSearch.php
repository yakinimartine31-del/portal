<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\CommonZssfSettings;

/**
 * CommonZssfSettingsSearch represents the model behind the search form of `frontend\models\CommonZssfSettings`.
 */
class CommonZssfSettingsSearch extends CommonZssfSettings
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'best_average_earning_months', 'refund_best_average_earning', 'max_calculator_months', 'max_calculator_years', 'employee_percentage'], 'integer'],
            [['date_time', 'complaints_email_address', 'hq_mobile_number', 'pemba_mobile_number', 'contact_email', 'unguja_phone_number', 'facebook_link', 'twitter_link', 'instagram_link', 'pemba_cordinates', 'unguja_cordinates', 'youtube_link', 'host_server', 'db_user', 'db_password', 'database_name', 'footer_message', 'head_office_fax_number', 'pemba_fax_number'], 'safe'],
            [['maternity_fixed_amount', 'maternity_for_twins', 'percentage_deducted_on_refund', 'employer_percentge'], 'number'],
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
        $query = CommonZssfSettings::find();

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
            'best_average_earning_months' => $this->best_average_earning_months,
            'maternity_fixed_amount' => $this->maternity_fixed_amount,
            'maternity_for_twins' => $this->maternity_for_twins,
            'percentage_deducted_on_refund' => $this->percentage_deducted_on_refund,
            'refund_best_average_earning' => $this->refund_best_average_earning,
            'max_calculator_months' => $this->max_calculator_months,
            'max_calculator_years' => $this->max_calculator_years,
            'employer_percentge' => $this->employer_percentge,
            'employee_percentage' => $this->employee_percentage,
        ]);

        $query->andFilterWhere(['like', 'complaints_email_address', $this->complaints_email_address])
            ->andFilterWhere(['like', 'hq_mobile_number', $this->hq_mobile_number])
            ->andFilterWhere(['like', 'pemba_mobile_number', $this->pemba_mobile_number])
            ->andFilterWhere(['like', 'contact_email', $this->contact_email])
            ->andFilterWhere(['like', 'unguja_phone_number', $this->unguja_phone_number])
            ->andFilterWhere(['like', 'facebook_link', $this->facebook_link])
            ->andFilterWhere(['like', 'twitter_link', $this->twitter_link])
            ->andFilterWhere(['like', 'instagram_link', $this->instagram_link])
            ->andFilterWhere(['like', 'pemba_cordinates', $this->pemba_cordinates])
            ->andFilterWhere(['like', 'unguja_cordinates', $this->unguja_cordinates])
            ->andFilterWhere(['like', 'youtube_link', $this->youtube_link])
            ->andFilterWhere(['like', 'host_server', $this->host_server])
            ->andFilterWhere(['like', 'db_user', $this->db_user])
            ->andFilterWhere(['like', 'db_password', $this->db_password])
            ->andFilterWhere(['like', 'database_name', $this->database_name])
            ->andFilterWhere(['like', 'footer_message', $this->footer_message])
            ->andFilterWhere(['like', 'head_office_fax_number', $this->head_office_fax_number])
            ->andFilterWhere(['like', 'pemba_fax_number', $this->pemba_fax_number]);

        return $dataProvider;
    }
    public function searchResults($params)
    {
        $query = CommonZssfSettings::find();

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
            'best_average_earning_months' => $this->best_average_earning_months,
            'maternity_fixed_amount' => $this->maternity_fixed_amount,
            'maternity_for_twins' => $this->maternity_for_twins,
            'percentage_deducted_on_refund' => $this->percentage_deducted_on_refund,
            'refund_best_average_earning' => $this->refund_best_average_earning,
            'max_calculator_months' => $this->max_calculator_months,
            'max_calculator_years' => $this->max_calculator_years,
            'employer_percentge' => $this->employer_percentge,
            'employee_percentage' => $this->employee_percentage,
        ]);

        $query->andFilterWhere(['like', 'complaints_email_address', $this->complaints_email_address])
            ->andFilterWhere(['like', 'hq_mobile_number', $this->hq_mobile_number])
            ->andFilterWhere(['like', 'pemba_mobile_number', $this->pemba_mobile_number])
            ->andFilterWhere(['like', 'contact_email', $this->contact_email])
            ->andFilterWhere(['like', 'unguja_phone_number', $this->unguja_phone_number])
            ->andFilterWhere(['like', 'facebook_link', $this->facebook_link])
            ->andFilterWhere(['like', 'twitter_link', $this->twitter_link])
            ->andFilterWhere(['like', 'instagram_link', $this->instagram_link])
            ->andFilterWhere(['like', 'pemba_cordinates', $this->pemba_cordinates])
            ->andFilterWhere(['like', 'unguja_cordinates', $this->unguja_cordinates])
            ->andFilterWhere(['like', 'youtube_link', $this->youtube_link])
            ->andFilterWhere(['like', 'host_server', $this->host_server])
            ->andFilterWhere(['like', 'db_user', $this->db_user])
            ->andFilterWhere(['like', 'db_password', $this->db_password])
            ->andFilterWhere(['like', 'database_name', $this->database_name])
            ->andFilterWhere(['like', 'footer_message', $this->footer_message])
            ->andFilterWhere(['like', 'head_office_fax_number', $this->head_office_fax_number])
            ->andFilterWhere(['like', 'pemba_fax_number', $this->pemba_fax_number]);

        return $dataProvider;
    }
}
