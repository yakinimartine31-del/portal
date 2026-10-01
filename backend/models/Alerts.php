<?php

namespace backend\models;

use frontend\models\SubscriptionTypes;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "alerts".
 *
 * @property int $id
 * @property string|null $subject
 * @property string|null $message
 * @property string|null $message_type
 * @property int|null $uid
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $msg_category
 */
class Alerts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alerts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject', 'message'], 'string'],
            [['uid'], 'integer'],
            [['created_at', 'updated_at','message_type'], 'safe'],
            //[['message_type'], 'string', 'max' => 200],
            [['msg_category'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'Subject',
            'message' => 'Message',
            'message_type' => 'Message Type',
            'uid' => 'Uid',
            'msg_category' => 'Message category',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getAllType()
    {

        return ArrayHelper::map(SubscriptionTypes::find()->all(),'type_name','type_name');
    }
}
