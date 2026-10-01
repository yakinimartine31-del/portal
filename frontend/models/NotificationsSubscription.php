<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sys_notifications_subscription".
 *
 * @property int $id
 * @property string|null $date_time
 * @property int|null $uid
 * @property string|null $notification_method
 * @property string|null $notification_types
 */
class NotificationsSubscription extends \yii\db\ActiveRecord
{

    public  $new_contr;
    public  $benefit;
    public  $new_soft;
    public  $new_service;
    public  $email;
    public  $sms;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_notifications_subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notification_types'], 'required'],
            [['date_time','email','sms','notification_method','notification_types','new_contr','benefit','new_soft','new_service'], 'safe'],
            [['uid'], 'integer'],
           // [[ 'notification_types'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'new_contr' => Yii::t('yii', 'New Contribution'),
            'benefit' => Yii::t('yii', 'Benefit Application Status'),
            'new_soft' => Yii::t('yii', 'New Software Update'),
            'new_service' => Yii::t('yii', 'Services Updates'),
            'date_time' => Yii::t('yii', 'Date Time'),
            'email' => Yii::t('yii', 'Email'),
            'sms' => Yii::t('yii', 'SMS'),
            'uid' => Yii::t('yii', 'Uid'),
            'notification_method' => Yii::t('yii', 'Notification Method'),
            'notification_types' => Yii::t('yii', 'Notification Types'),
        ];
    }

    public static function getType()
    {

       // return ArrayHelper::map(SubscriptionTypes::find()->where(['in','id',[3,4]])->all(),'id','type_name');
        return ArrayHelper::map(SubscriptionTypes::find()->all(),'id','type_name');
    }
    public static function getType2()
    {

        return ArrayHelper::map(SubscriptionTypes::find()->where(['in','id',[1,2]])->all(),'id','type_name');
    }
}
