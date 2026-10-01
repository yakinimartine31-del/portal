<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_common_zssf_settings".
 *
 * @property int $id
 * @property string|null $date_time
 * @property int|null $best_average_earning_months
 * @property float|null $maternity_fixed_amount
 * @property float|null $maternity_for_twins
 * @property string|null $complaints_email_address
 * @property float|null $percentage_deducted_on_refund
 * @property int|null $refund_best_average_earning
 * @property string|null $hq_mobile_number
 * @property string|null $pemba_mobile_number
 * @property string|null $contact_email
 * @property int|null $max_calculator_months
 * @property int|null $max_calculator_years
 * @property string|null $unguja_phone_number
 * @property float|null $employer_percentge
 * @property int|null $employee_percentage
 * @property string|null $facebook_link
 * @property string|null $twitter_link
 * @property string|null $instagram_link
 * @property string|null $pemba_cordinates
 * @property string|null $unguja_cordinates
 * @property string|null $youtube_link
 * @property string|null $host_server
 * @property string|null $db_user
 * @property string|null $db_password
 * @property string|null $database_name
 * @property string|null $footer_message
 * @property string|null $head_office_fax_number
 * @property string|null $pemba_fax_number
 */
class CommonZssfSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_common_zssf_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time'], 'safe'],
            [['best_average_earning_months', 'refund_best_average_earning', 'max_calculator_months', 'max_calculator_years', 'employee_percentage','request_time_interval_limit'], 'integer'],
            [['maternity_fixed_amount', 'maternity_for_twins', 'percentage_deducted_on_refund', 'employer_percentge'], 'number'],
            [['footer_message'], 'string'],
            [['complaints_email_address','hotline_no','hq_mobile_number', 'pemba_mobile_number', 'contact_email', 'unguja_phone_number', 'facebook_link', 'twitter_link', 'instagram_link', 'pemba_cordinates', 'unguja_cordinates', 'youtube_link', 'host_server', 'db_user', 'db_password', 'database_name', 'head_office_fax_number', 'pemba_fax_number'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'date_time' => Yii::t('yii', 'Date Time'),
            'best_average_earning_months' => Yii::t('yii', 'Best Average Earning Months'),
            'maternity_fixed_amount' => Yii::t('yii', 'Maternity Fixed Amount'),
            'maternity_for_twins' => Yii::t('yii', 'Maternity For Twins'),
            'complaints_email_address' => Yii::t('yii', 'Complaints Email Address'),
            'percentage_deducted_on_refund' => Yii::t('yii', 'Percentage Deducted On Refund'),
            'refund_best_average_earning' => Yii::t('yii', 'Refund Best Average Earning'),
            'hq_mobile_number' => Yii::t('yii', 'Hq Mobile Number'),
            'pemba_mobile_number' => Yii::t('yii', 'Pemba Mobile Number'),
            'contact_email' => Yii::t('yii', 'Contact Email'),
            'max_calculator_months' => Yii::t('yii', 'Max Calculator Months'),
            'max_calculator_years' => Yii::t('yii', 'Max Calculator Years'),
            'unguja_phone_number' => Yii::t('yii', 'Unguja Phone Number'),
            'employer_percentge' => Yii::t('yii', 'Employer Percentge'),
            'employee_percentage' => Yii::t('yii', 'Employee Percentage'),
            'facebook_link' => Yii::t('yii', 'Facebook Link'),
            'twitter_link' => Yii::t('yii', 'Twitter Link'),
            'instagram_link' => Yii::t('yii', 'Instagram Link'),
            'pemba_cordinates' => Yii::t('yii', 'Pemba Cordinates'),
            'unguja_cordinates' => Yii::t('yii', 'Unguja Cordinates'),
            'youtube_link' => Yii::t('yii', 'Youtube Link'),
            'host_server' => Yii::t('yii', 'Host Server'),
            'db_user' => Yii::t('yii', 'Db User'),
            'db_password' => Yii::t('yii', 'Db Password'),
            'database_name' => Yii::t('yii', 'Database Name'),
            'footer_message' => Yii::t('yii', 'Footer Message'),
            'head_office_fax_number' => Yii::t('yii', 'Head Office Fax Number'),
            'pemba_fax_number' => Yii::t('yii', 'Pemba Fax Number'),
            'request_time_interval_limit' => Yii::t('yii', 'Request time interval limit'),
        ];
    }
}
