<?php

namespace frontend\controllers;

use frontend\models\BufferResults;
use frontend\models\Calculator;
use frontend\models\CommonZssfSettings;
use frontend\models\ComplaintsForm;
use frontend\models\Contributions;
use frontend\models\Employments;
use frontend\models\Members;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\SmsLogs;
use frontend\models\Statement;
use frontend\models\User;
use frontend\models\VerifyEmailForm;
use kartik\dialog\Dialog;
use Yii;
use yii\base\InvalidArgumentException;
use yii\bootstrap\ActiveForm;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\JsExpression;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class StatementController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionMail()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new Statement();
            $member=Members::find()->where(['uid'=>Yii::$app->user->identity->getId()])->one();
            $model->zssf_no=$member['membership_number'];
            $contribution=Contributions::find()->where(['member_number'=>$member['membership_number']])->one();
            $contribution_trend=BufferResults::find()->where(['member_number'=>$member['membership_number']])->one();
            $employer=Employments::find()->where(['member_code'=>$member['membership_number']])->one();
            $employer_name=$employer['employer_name'];
            $month=$contribution['cont_month'];
            $year=$contribution['cont_year'];
            $amount=$contribution['amount'];
            $salary	=$contribution['salary'];
            $contributing_period=$contribution['salary'];
            $TotalContributions=$contribution_trend['TotalContributions'];
            $message=Yii::t('yii',"Member Number: $model->zssf_no Employer: $employer_name  Latest Contribution, Month/Year: $month/$year Latest Amount: $amount Latest Salary: $salary Months Contributed: $contributing_period Total Contribution: $TotalContributions");
            $email=$member['email'];

            if ($model->load(Yii::$app->request->post())) {
                if (!empty($email)){
                    $sent_from=CommonZssfSettings::find()->where(['id'=>1])->one();
                    $email_from=$sent_from['contact_email'];
                    Yii::$app->mailer->compose()
                        ->setFrom($email_from)
                        ->setTo($email)
                        ->setSubject('ZSSF Member Statement')
                        ->setTextBody($message)
                       // ->setHtmlBody()
                        ->send();

                    Yii::$app->session->setFlash('email_success');
                    return   $this->redirect(['statement/mail']);
                }
                else{
                    Yii::$app->session->setFlash('email_fail');
                    return $this->redirect(['statement/mail']);
                }

            }
            return $this->render('mail', [
                'model' => $model,
            ]);

        } else {

            //  return $this->goHome();
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 5000,
                'icon' => 'fa fa-check',
                'message' => Yii::t('yii', 'Please sign up first and continue'),
                'positonY' => 'top',
                'positonX' => 'right',
            ]);
            return $this->redirect(['site/signup']);
        }

    }

    public function actionSms()
    {
        if (!Yii::$app->user->isGuest) {

            $model = new Statement();
            $member=Members::find()->where(['uid'=>Yii::$app->user->identity->getId()])->one();
            $model->zssf_no=$member['membership_number'];
            $contribution=Contributions::find()->where(['member_number'=>$member['membership_number']])->one();
            $contribution_trend=BufferResults::find()->where(['member_number'=>$member['membership_number']])->one();
            $month=$contribution['cont_month'];
            $year=$contribution['cont_year'];
            $amount=$contribution['amount'];
            $salary	=$contribution['salary'];
            $contributing_period=$contribution_trend['TotalNumberOfContribution'];
            $TotalContributions=$contribution_trend['TotalContributions'];
            $message=Yii::t('yii',"Latest Contribution, Month/Year: $month/$year Latest Amount: $amount Latest Salary: $salary Months Contributed: $contributing_period Total Contribution: $TotalContributions");
            $phone=$member['mobile_number'];



            if ($model->load(Yii::$app->request->post())) {
                if (!empty($phone)){
                    if($phone[0] == 0){
                        $country_code = '255';

                        $new_number = substr_replace($phone, '+'.$country_code, 0, ($phone[0] == '0'));
                        $this->file_get_contents_curl($message, $new_number);

                        $sms_log=new SmsLogs();
                        $sms_log->date_time=date('Y-m-d H:i:s');
                        $sms_log->recipient_number=$new_number;
                        $sms_log->message=$message;
                        $sms_log->sms_status=1;
                        $sms_log->member_number=$model->zssf_no;
                        $sms_log->save(false);

                        Yii::$app->session->setFlash('sms_success');
                        return   $this->redirect(['statement/sms']);
                    }
                    else{
                        $this->file_get_contents_curl($message, $phone);

                        $sms_log=new SmsLogs();
                        $sms_log->date_time=date('Y-m-d H:i:s');
                        $sms_log->recipient_number=$phone;
                        $sms_log->message=$message;
                        $sms_log->sms_status=1;
                        $sms_log->member_number=$model->zssf_no;
                        $sms_log->save(false);
                        Yii::$app->session->setFlash('sms_success');
                        return   $this->redirect(['statement/sms']);
                    }

                }
                else{
                    Yii::$app->session->setFlash('sms_fail');
                   return $this->redirect(['statement/sms']);
                }

            }
            return $this->render('sms', [
                'model' => $model,
            ]);

        } else {

            //  return $this->goHome();
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 5000,
                'icon' => 'fa fa-check',
                'message' => Yii::t('yii', 'Please sign up first and continue'),
                'positonY' => 'top',
                'positonX' => 'right',
            ]);
            return $this->redirect(['site/signup']);
        }


    }


    private function file_get_contents_curl($message, $phone_number)
    {
        $msg = urlencode($message);
        $url = "http://api.infobip.com/api/v3/sendsms/plain?user=ZSSF&password=ZSSF@2018.COM&sender=ZSSF&SMSText=$msg&GSM=$phone_number";

        curl_setopt($ch = curl_init(), CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;

    }

}
