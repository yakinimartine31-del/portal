<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_feedback".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 * @property string $created_at
 * @property string|null $updated_at
 */
class UserFeedback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_feedback';
    }

    public static function TodayFeedback()
    {
        $today=date('Y-m-d');
        $model = UserFeedback::find()->where(['date(created_at)'=>$today])->count();
        if ($model > 0) {
            return $model;
        } else {
            return 0;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body', 'created_at'], 'required'],
            [['body'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email', 'subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'name' => Yii::t('yii', 'Name'),
            'email' => Yii::t('yii', 'Email'),
            'subject' => Yii::t('yii', 'Subject'),
            'body' => Yii::t('yii', 'Body'),
            'created_at' => Yii::t('yii', 'Created At'),
            'updated_at' => Yii::t('yii', 'Updated At'),
        ];
    }
}
