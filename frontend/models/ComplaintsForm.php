<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ComplaintsForm extends Model
{
    public $zssf_no;
    public $email;
    public $phone;
    public $subject;
    public $category;
    public $message;
    public $file;
    public $type;

        const bribing=1;
        const fake_agents=2;
        const zssf_services=3;

    public static function getType()
    {
        return [
            self::bribing => Yii::t('yii', 'Bringing'),
            self::fake_agents => Yii::t('yii', 'Fake Agents'),
            self::zssf_services => Yii::t('yii', 'ZSSF Services'),

        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['zssf_no'], 'integer'],
            [['phone'], 'string', 'max' => 150],
            [['email', 'subject', 'category','message','type'], 'required'],
            ['email', 'email'],
            ['file', 'file'],
            [['file'], 'file', 'extensions' => 'pdf,jpg, jpeg, png', 'skipOnEmpty' => true,
                'checkExtensionByMimeType' => false],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'zssf_no' =>Yii::t('yii', 'ZSSF NUMBER '),
            'file' => Yii::t('yii', 'Attachment'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
