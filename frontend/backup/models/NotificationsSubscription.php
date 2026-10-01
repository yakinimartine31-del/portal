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

 //   public  $notification_default;


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
            [['date_time','notification_method','notification_types'], 'safe'],
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
            'date_time' => Yii::t('yii', 'Date Time'),
            'uid' => Yii::t('yii', 'Uid'),
            'notification_method' => Yii::t('yii', 'Notification Method'),
            'notification_types' => Yii::t('yii', 'Notification Types'),
        ];
    }

    public static function getAllType()
    {

        return ArrayHelper::map(SubscriptionTypes::find()->all(),'type_name','type_name');
    }

    public static function getType()
    {

        return ArrayHelper::map(SubscriptionTypes::find()->where(['in','id',[3,4]])->all(),'id','type_name');
    }

    public static function getType2()
    {

        return ArrayHelper::map(SubscriptionTypes::find()->where(['in','id',[1,2]])->all(),'id','type_name');
    }
}
