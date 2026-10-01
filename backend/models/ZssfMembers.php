<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_zssf_members".
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
 * @property string|null $marital_status
 * @property string|null $gender
 * @property string|null $national_id
 * @property string|null $member_card
 * @property string|null $date_of_joining
 * @property string|null $registration_id
 * @property string|null $device_type
 * @property string|null $user_type
 * @property string|null $previous_mobile_numbers
 * @property string|null $device_token
 * @property string|null $pension_number
 * @property string|null $account_name
 * @property string|null $region
 * @property string|null $district
 * @property string|null $shehia
 * @property string|null $bank_name
 * @property string|null $account_number
 * @property string|null $device_number
 */
class ZssfMembers extends \yii\db\ActiveRecord
{
    public function checkUsernameUnique($attribute, $params)
    {
        // Only validate if username is not empty
        if (empty($this->$attribute)) {
            return;
        }

        $query = self::find()->where(['username' => $this->$attribute]);
        
        // If updating an existing member, exclude current member from check
        if (!$this->isNewRecord) {
            $query->andWhere(['!=', 'id', $this->id]);
        }
        
        $existingMember = $query->one();
        if ($existingMember) {
            $this->addError($attribute, 'This username is already taken. Please use another username.');
            return;
        }

        // Also check in Users table to avoid conflicts.  An existing member has
        // a corresponding Users record, so exclude that linked account when
        // validating an update.
        $userQuery = \backend\models\Users::find()->where(['username' => $this->$attribute]);
        if (!$this->isNewRecord && $this->uid !== null && $this->uid !== '') {
            $userQuery->andWhere(['!=', 'id', $this->uid]);
        }

        $existingUser = $userQuery->one();
        if ($existingUser) {
            $this->addError($attribute, 'This username is already taken. Please use another username.');
        }
    }
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
            [['date_time', 'date_of_birth', 'date_of_joining'], 'safe'],
            [['photo', 'send_auth_code_via', 'marital_status', 'gender', 'member_card', 'user_type', 'previous_mobile_numbers'], 'string'],
            [['full_names', 'membership_number', 'email', 'password', 'uid', 'group', 'username', 'mobile_number', 'member_sys_id', 'auth_code', 'address', 'national_id', 'registration_id', 'device_type', 'device_token', 'mobile_phone_of_who_come_behalf_of_pensioner'], 'string', 'max' => 255],
            [['pension_number', 'account_name'], 'string', 'max' => 100],
            [['region', 'district', 'shehia', 'bank_name', 'account_number','device_number'], 'string', 'max' => 50],
            ['username', 'checkUsernameUnique', 'skipOnEmpty' => true],
            [['method'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_time' => 'Date Time',
            'full_names' => 'Full Names',
            'membership_number' => 'Membership Number',
            'email' => 'Email',
            'password' => 'Password',
            'uid' => 'Uid',
            'group' => 'Group',
            'username' => 'Username',
            'mobile_number' => 'Mobile Number',
            'mobile_phone_of_who_come_behalf_of_pensioner' => 'Mobile Phone of Who Come Behalf of Pensioner',
            'member_sys_id' => 'Member Sys ID',
            'photo' => 'Photo',
            'send_auth_code_via' => 'Send Auth Code Via',
            'auth_code' => 'Auth Code',
            'date_of_birth' => 'Date Of Birth',
            'address' => 'Address',
            'marital_status' => 'Marital Status',
            'gender' => 'Gender',
            'national_id' => 'National ID',
            'member_card' => 'Member Card',
            'date_of_joining' => 'Date Of Joining',
            'registration_id' => 'Registration ID',
            'device_type' => 'Device Type',
            'user_type' => 'User Type',
            'previous_mobile_numbers' => 'Previous Mobile Numbers',
            'device_token' => 'Device Token',
            'pension_number' => 'Pension Number',
            'account_name' => 'Account Name',
            'region' => 'Region',
            'district' => 'District',
            'shehia' => 'Shehia',
            'bank_name' => 'Bank Name',
            'account_number' => 'Account Number',
        ];
    }
}
