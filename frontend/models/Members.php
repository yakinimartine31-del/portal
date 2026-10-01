<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sys_zssf_members1".
 *
 * @property int $id
 * @property string|null $date_time
 * @property string|null $full_names
 * @property string|null $membership_number
 * @property string|null $email
 * @property string|null $password
 * @property string|null $uid
 * @property string|null $group
 * @property string|null $username
 * @property string|null $mobile_number
 * @property string|null $member_sys_id
 * @property string|null $photo
 * @property string|null $send_auth_code_via
 * @property string|null $auth_code
 * @property string|null $date_of_birth
 * @property string|null $address
 * @property string $marital_status
 * @property string|null $gender
 * @property string|null $national_id
 * @property string|null $member_card
 * @property string|null $previous_mobile_numbers
 *
 * @property Contributions $sysContributions1
 */
class Members extends \yii\db\ActiveRecord
{

    public $repassword;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_zssf_members';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time', 'date_of_birth'], 'safe'],
            [['photo', 'send_auth_code_via', 'marital_status', 'gender', 'member_card','previous_mobile_numbers'], 'string'],
            [['marital_status'], 'required'],
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            [['full_names', 'membership_number', 'email', 'password', 'uid', 'group', 'username', 'mobile_number', 'member_sys_id', 'auth_code', 'address', 'national_id'], 'string', 'max' => 255],
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
            'full_names' => Yii::t('yii', 'Full Names'),
            'membership_number' => Yii::t('yii', 'Membership Number'),
            'email' => Yii::t('yii', 'Email'),
            'password' => Yii::t('yii', 'Password'),
            'uid' => Yii::t('yii', 'Uid'),
            'group' => Yii::t('yii', 'Group'),
            'username' => Yii::t('yii', 'Username'),
            'mobile_number' => Yii::t('yii', 'Mobile Number'),
            'member_sys_id' => Yii::t('yii', 'Member Sys ID'),
            'photo' => Yii::t('yii', 'Photo'),
            'send_auth_code_via' => Yii::t('yii', 'Send Auth Code Via'),
            'auth_code' => Yii::t('yii', 'Auth Code'),
            'date_of_birth' => Yii::t('yii', 'Date Of Birth'),
            'address' => Yii::t('yii', 'Address'),
            'marital_status' => Yii::t('yii', 'Marital Status'),
            'gender' => Yii::t('yii', 'Gender'),
            'national_id' => Yii::t('yii', 'National ID'),
            'member_card' => Yii::t('yii', 'Member Card'),
            'previous_mobile_numbers' => Yii::t('yii', 'Previous Mobile Numbers'),
        ];
    }

    /**
     * Gets query for [[SysContributions1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContribution0()
    {
        return $this->hasOne(Contributions::className(), ['id' => 'id']);
    }


}
