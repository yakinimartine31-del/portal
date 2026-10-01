<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_sms_logs".
 *
 * @property int $id
 * @property int $msg_category_id
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
            [['msg_category_id'], 'integer'],
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
            'id' => Yii::t('yii', 'ID'),
            'date_time' => Yii::t('yii', 'Date Time'),
            'recipient_number' => Yii::t('yii', 'Recipient Number'),
            'message' => Yii::t('yii', 'Message'),
            'sms_status' => Yii::t('yii', 'Sms Status'),
            'member_number' => Yii::t('yii', 'Member Number'),
            'msg_category_id' => Yii::t('yii', 'Message Category'),
        ];
    }
}
