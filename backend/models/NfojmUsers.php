<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nfojm_users".
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $block
 * @property int|null $sendEmail
 * @property string|null $registerDate
 * @property string|null $lastvisitDate
 * @property string $activation
 * @property string $params
 * @property string|null $lastResetTime Date of last password reset
 * @property int $resetCount Count of password resets since lastResetTime
 * @property string $otpKey Two factor authentication encrypted keys
 * @property string $otep One time emergency passwords
 * @property int $requireReset Require user to reset password on next login
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $create_at
 * @property string|null $updated_at
 * @property int $status
 * @property int $staff_login
 */
class NfojmUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nfojm_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['block', 'sendEmail', 'resetCount', 'requireReset', 'status', 'staff_login'], 'integer'],
            [['registerDate', 'lastvisitDate', 'lastResetTime', 'create_at', 'updated_at'], 'safe'],
            [['params', 'auth_key', 'password_reset_token', 'verification_token', 'status'], 'required'],
            [['params'], 'string'],
            [['name'], 'string', 'max' => 400],
            [['username'], 'string', 'max' => 150],
            [['email', 'password', 'activation'], 'string', 'max' => 100],
            [['otpKey', 'otep'], 'string', 'max' => 1000],
            [['auth_key', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'block' => 'Block',
            'sendEmail' => 'Send Email',
            'registerDate' => 'Register Date',
            'lastvisitDate' => 'Lastvisit Date',
            'activation' => 'Activation',
            'params' => 'Params',
            'lastResetTime' => 'Last Reset Time',
            'resetCount' => 'Reset Count',
            'otpKey' => 'Otp Key',
            'otep' => 'Otep',
            'requireReset' => 'Require Reset',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'verification_token' => 'Verification Token',
            'create_at' => 'Create At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'staff_login' => 'Staff Login',
        ];
    }
}
