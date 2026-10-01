<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sys_applications_statuses".
 *
 * @property int $id
 * @property string|null $date_time
 * @property string|null $application_date
 * @property string|null $benefit_type
 * @property string|null $employer_number
 * @property string|null $processing_stage_name
 * @property string|null $application_status
 * @property string|null $payment_date
 * @property string|null $member_number
 */
class ApplicationsStatuses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_applications_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time', 'application_date', 'payment_date'], 'safe'],
            [['benefit_type', 'employer_number', 'processing_stage_name', 'application_status', 'member_number'], 'string', 'max' => 255],
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
            'application_date' => Yii::t('yii', 'Application Date'),
            'benefit_type' => Yii::t('yii', 'Benefit Type'),
            'employer_number' => Yii::t('yii', 'Employer Number'),
            'processing_stage_name' => Yii::t('yii', 'Processing stage'),
            'application_status' => Yii::t('yii', 'Application Status'),
            'payment_date' => Yii::t('yii', 'Payment Date'),
            'member_number' => Yii::t('yii', 'Member Number'),
        ];
    }
}
