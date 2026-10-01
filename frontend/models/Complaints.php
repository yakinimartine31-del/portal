<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sys_complaints".
 *
 * @property int $id
 * @property string|null $date_time
 * @property string|null $zssf_number
 *  * @property int|null $complaint_from
 * @property string|null $subject
 * @property int|null $category
 * @property string|null $message
 * @property string|null $photo_file
 * @property string|null $email_address
 * @property string|null $phone_number
 * @property string|null $status_type
 */
class Complaints extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_complaints';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message','category'], 'required'],
            [['date_time'], 'safe'],
            [['category','complaint_from'], 'integer'],
            [['message', 'photo_file', 'status_type'], 'string'],
            [['zssf_number', 'subject', 'email_address', 'phone_number'], 'string', 'max' => 255],

            [['file',], 'file', 'extensions' => 'pdf,jpg, jpeg, png', 'skipOnEmpty' => true,
                'checkExtensionByMimeType' => false],
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
            'zssf_number' => Yii::t('yii', 'ZSSF Number'),
            'subject' => Yii::t('yii', 'Subject'),
            'category' => Yii::t('yii', 'Category'),
            'message' => Yii::t('yii', 'Message'),
            'photo_file' => Yii::t('yii', 'Photo File'),
            'email_address' => Yii::t('yii', 'Email Address'),
            'phone_number' => Yii::t('yii', 'Phone Number'),
            'status_type' => Yii::t('yii', 'Status Type'),
        ];
    }

    public function getCategory0()
    {
        return $this->hasOne(ComplaintsCategories::className(), ['id' => 'category']);
    }
}
