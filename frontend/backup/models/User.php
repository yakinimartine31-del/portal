<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "nfojm_users".
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string|null $password_hash
 * @property string|null $auth_key
 * @property string|null $password_reset_token
 * @property string|null $verification_token
 * @property int $block
 * @property int|null $status
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
 */
class User extends \common\models\User
{
    public $password_new;
    public $repassword;
    public $oldpass;
    public $updated_at;
    public $created_at;


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
            [['block', 'status', 'sendEmail', 'resetCount', 'requireReset'], 'integer'],
            [['registerDate', 'lastvisitDate', 'lastResetTime'], 'safe'],
            [['oldpass'], 'required'],
            [['params'], 'string'],
            [['name'], 'string', 'max' => 400],
            [['email', 'activation'], 'string', 'max' => 100],
            [['password_hash','password', 'auth_key', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['otpKey', 'otep'], 'string', 'max' => 1000],

            [['password','password_new','repassword'], 'string', 'min' => 6, 'max' => 30],
            [['username', 'email'], 'unique'],
            ['username', 'string', 'min' => 3, 'max' => 30],
            ['repassword', 'compare', 'compareAttribute' => 'password_new'],

            ['oldpass','findPasswords'],
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
            'username' => Yii::t('yii', 'Username'),
            'email' => Yii::t('yii', 'Email'),
            'password_hash' => Yii::t('yii', 'Password Hash'),
            'auth_key' => Yii::t('yii', 'Auth Key'),
            'password_reset_token' => Yii::t('yii', 'Password Reset Token'),
            'verification_token' => Yii::t('yii', 'Verification Token'),
            'block' => Yii::t('yii', 'Block'),
            'status' => Yii::t('yii', 'Status'),
            'sendEmail' => Yii::t('yii', 'Send Email'),
            'registerDate' => Yii::t('yii', 'Register Date'),
            'lastvisitDate' => Yii::t('yii', 'Lastvisit Date'),
            'activation' => Yii::t('yii', 'Activation'),
            'params' => Yii::t('yii', 'Params'),
            'lastResetTime' => Yii::t('yii', 'Last Reset Time'),
            'resetCount' => Yii::t('yii', 'Reset Count'),
            'otpKey' => Yii::t('yii', 'Otp Key'),
            'otep' => Yii::t('yii', 'Otep'),
            'requireReset' => Yii::t('yii', 'Require Reset'),
            'password' => Yii::t('yii', 'New Password'),
            'repassword' => Yii::t('yii', 'Repeat New Password'),
            'oldpass' => Yii::t('yii', 'Old Password'),
        ];
    }

    public function getMember0()
    {
        return $this->hasOne(Members::className(), ['uid' => 'id']);
    }

    public function findPasswords($attribute, $params){
        $user = User::find()
            ->where(['username'=>Yii::$app->user->identity->username])
            ->one();
        $password = $user->password;
        if($password!=$this->oldpass)
            $this->addError($attribute,'Old password is incorrect');
    }
}
