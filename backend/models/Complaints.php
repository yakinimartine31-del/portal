<?php

namespace backend\models;

use common\models\User;
use frontend\models\ComplaintsCategories;
use frontend\models\Members;
use Yii;

/**
 * This is the model class for table "sys_complaints".
 *
 * @property int $id
 * @property string|null $date_time
 * @property string|null $zssf_number
 * @property string|null $subject
 * @property int|null $category
 * @property int|null $complaint_from
 * @property string|null $message
 * @property string|null $photo_file
 * @property string|null $email_address
 * @property string|null $phone_number
 * @property string|null $status_type
 * @property string|null $response_message
 * @property string|null $response_by
 * @property string|null $respond_date
 */
class Complaints extends \yii\db\ActiveRecord
{
    public $method;
    public $response;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_complaints';
    }

    public static function todayComplaints()
    {
        if (Yii::$app->user->can('manageAllComplaints')) {
            $today = date('Y-m-d');
            $model = Complaints::find()->where(['date(date_time)' => $today])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageBenefit')) {
            $today = date('Y-m-d');
            $model = Complaints::find()->where(['date(date_time)' => $today])
                ->andWhere(['category' => 2])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageContribution')) {
            $today = date('Y-m-d');
            $model = Complaints::find()->where(['date(date_time)' => $today])
                ->andWhere(['category' => 3])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageInvestment')) {
            $today = date('Y-m-d');
            $model = Complaints::find()->where(['date(date_time)' => $today])
                ->andWhere(['category' => 6])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageMobileApp')) {
            $today = date('Y-m-d');
            $model = Complaints::find()->where(['date(date_time)' => $today])
                ->andWhere(['category' => 4])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageRegistration')) {
            $today = date('Y-m-d');
            $model = Complaints::find()->where(['date(date_time)' => $today])
                ->andWhere(['category' => 1])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageSuggestion')) {
            $today = date('Y-m-d');
            $model = Complaints::find()->where(['date(date_time)' => $today])
                ->andWhere(['category' => 5])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } else {
            $today = date('Y-m-d');
            $model = Complaints::find()->where(['date(date_time)' => $today])
                ->andWhere(['category' => NULL])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        }

    }

    public static function PendingComplaints()
    {
        if (Yii::$app->user->can('manageAllComplaints')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
               // ->where(['status_type' => 'Pending'])
                ->where(['status_type' => '1'])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageBenefit')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
                //->where(['status_type' => 'Pending'])
                ->where(['status_type' => '1'])
                ->andWhere(['category' => 2])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageContribution')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
               // ->where(['status_type' => 'Pending'])
                ->where(['status_type' => '1'])
                ->andWhere(['category' => 3])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageInvestment')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
               // ->where(['status_type' => 'Pending'])
                ->where(['status_type' => '1'])
                ->andWhere(['category' => 6])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageMobileApp')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
               // ->where(['status_type' => 'Pending'])
                ->where(['status_type' => '1'])
                ->andWhere(['category' => 4])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageRegistration')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
               // ->where(['status_type' => 'Pending'])
                ->where(['status_type' => '1'])
                ->andWhere(['category' => 1])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageSuggestion')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
               // ->where(['status_type' => 'Pending'])
                ->where(['status_type' => '1'])
                ->andWhere(['category' => 5])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } else {
            $today = date('Y-m-d');
            $model = Complaints::find()
              //  ->where(['status_type' => 'Pending'])
                ->where(['status_type' => '1'])
                ->andWhere(['category' => NULL])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        }

    }

    public static function SortedComplaints()
    {
        if (Yii::$app->user->can('manageAllComplaints')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
                ->where(['status_type' => 'Sorted'])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageBenefit')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
                ->where(['status_type' => 'Sorted'])
                ->andWhere(['category' => 2])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageContribution')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
                ->where(['status_type' => 'Sorted'])
                ->andWhere(['category' => 3])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageInvestment')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
                ->where(['status_type' => 'Sorted'])
                ->andWhere(['category' => 6])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageMobileApp')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
                ->where(['status_type' => 'Sorted'])
                ->andWhere(['category' => 4])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageRegistration')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
                ->where(['status_type' => 'Sorted'])
                ->andWhere(['category' => 1])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } elseif (Yii::$app->user->can('manageSuggestion')) {
            $today = date('Y-m-d');
            $model = Complaints::find()
                ->where(['status_type' => 'Sorted'])
                ->andWhere(['category' => 5])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        } else {
            $today = date('Y-m-d');
            $model = Complaints::find()
                ->where(['status_type' => 'Sorted'])
                ->andWhere(['category' => NULL])
                ->count();
            if ($model > 0) {
                return $model;
            } else {
                return 0;
            }
        }

    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['method', 'response_message', 'response'], 'required'],
            [['date_time', 'method', 'respond_date'], 'safe'],
            [['category', 'complaint_from'], 'integer'],
            [['message', 'photo_file', 'status_type'], 'string'],
            [['zssf_number', 'subject', 'email_address', 'phone_number'], 'string', 'max' => 255],
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
            'zssf_number' => Yii::t('yii', 'Member Number'),
            'subject' => Yii::t('yii', 'Subject'),
            'category' => Yii::t('yii', 'Category'),
            'method' => Yii::t('yii', 'Method'),
            'response_message' => Yii::t('yii', 'Response Message'),
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

    public function getMember0()
    {
        return $this->hasOne(Members::className(), ['membership_number' => 'zssf_number']);
    }

    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'response_by']);
    }
}
