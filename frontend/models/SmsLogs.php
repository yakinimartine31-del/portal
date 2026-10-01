<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sys_sms_logs".
 *
 * @property int $id
 * @property string|null $date_time
 * @property string|null $recipient_number
 * @property string|null $message
 * @property string|null $sms_status
 * @property string|null $member_number
 */
class SmsLogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_sms_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time'], 'safe'],
            [['message', 'sms_status'], 'string'],
            [['recipient_number', 'member_number'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date_time' => Yii::t('app', 'Date Time'),
            'recipient_number' => Yii::t('app', 'Recipient Number'),
            'message' => Yii::t('app', 'Message'),
            'sms_status' => Yii::t('app', 'Sms Status'),
            'member_number' => Yii::t('app', 'Member Number'),
        ];
    }
}
