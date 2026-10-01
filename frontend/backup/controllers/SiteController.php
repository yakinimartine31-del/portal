<?php

namespace frontend\controllers;

use backend\models\AuditTrial;
use frontend\models\Articles;
use frontend\models\Calculator;
use frontend\models\CommonZssfSettings;
use frontend\models\ComplaintsForm;
use frontend\models\Members;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\SmsLogs;
use frontend\models\User;
use frontend\models\VerifyEmailForm;
use frontend\models\ZssfBackendMembersSimulation;
use Yii;
use yii\base\InvalidArgumentException;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['reset'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionHome()
    {
        return $this->render('index');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBoard()
    {
        return $this->render('board');
    }

    public function actionStructure()
    {
        return $this->render('structure');
    }

    public function actionComplaints()
    {
        // return $this->render('complaints');
        $model = new ComplaintsForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            Yii::$app->db->createCommand()
                ->insert('sys_complaints', [
                    'date_time' => date('Y-m-d H:i:s'),
                    'zssf_number' => $model->zssf_number,
                    'email_address' => $model->email,
                    'subject' => $model->subject,
                    'message' => $model->body,
                    'phone_number' => $model->phone,
                    'status_type' => 'Pending',
                ])->execute();



            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
//            return $this->refresh();
            return $this->redirect(['site/index']);
        }


        return $this->render('complaints', [
            'model' => $model,
        ]);

    }

    public function actionPublic()
    {
        return $this->render('public');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();

        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //  return $this->goBack();
            User::updateAll(['lastvisitDate' => date('Y-m-d H:i:s')]);

            $audit=new AuditTrial();
            $audit->items='Login to member portal';
            // $audit->activity='Login';
            $audit->module='Site login';
            $audit->action='Site login';
            $audit->new='new login ('.date('Y-m-d H:i:s').')';
            $user=User::find()->where(['id'=>Yii::$app->user->identity->getId()])->one();
            $audit->old='last login ('.$user['lastvisitDate'].')';
            $audit->maker=Yii::$app->user->identity->getId();
            $audit->maker_time=date('Y-m-d H:i:s');
            $audit->save(false);
            return $this->redirect(['site/home']);
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        //return $this->goHome();
        return $this->redirect(['site/home']);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new ContactForm();
            $model->name = Yii::$app->user->identity->username;
            $model->email = Yii::$app->user->identity->email;
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                Yii::$app->db->createCommand()
                    ->insert('user_feedback', [
                        'name' => $model->name,
                        'email' => $model->email,
                        'subject' => $model->subject,
                        'body' => $model->body,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ])->execute();

                $sent_from = CommonZssfSettings::findOne(['id' => 1]);
                $email_from = $sent_from['contact_email'];

//                $audit=new AuditTrial();
//                $audit->items='Contacted us with message ('.$model->body.')';
//                // $audit->activity='Login';
//                $audit->module='contact us';
//                $audit->action='contact us';
//                $audit->new='';
//                $audit->old='';
//                $audit->maker=Yii::$app->user->identity->getId();
//                $audit->maker_time=date('Y-m-d H:i:s');
//                $audit->save(false);

                if ($model->sendEmail($email_from)) {
                    Yii::$app->session->setFlash('success', Yii::t('yii', 'Thank you for  contacting us. We will respond to you as soon as possible'));
                } else {
                    Yii::$app->session->setFlash('error', 'There was an error sending your message.');
                }

                return $this->refresh();
            } else {
                return $this->render('contact', [
                    'model' => $model,
                ]);
            }
        } else {
            $model = new ContactForm();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                Yii::$app->db->createCommand()
                    ->insert('user_feedback', [
                        'name' => $model->name,
                        'email' => $model->email,
                        'subject' => $model->subject,
                        'body' => $model->body,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ])->execute();
                $sent_from = CommonZssfSettings::findOne(['id' => 1]);
                $email_from = $sent_from['contact_email'];
                if ($model->sendEmail($email_from)) {
                    Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                } else {
                    Yii::$app->session->setFlash('error', 'There was an error sending your message.');
                }

                return $this->refresh();
            } else {
                return $this->render('contact', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout1()
    {
        return $this->render('about');
    }

    public function actionAbout()
    {
        $id=Articles::find()->select('id')->where(['id'=>20])->one();
        return $this->render('overview', [
            'model' => $this->findModel($id),
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Articles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionReset()
    {

       // echo 'hello';
        //die;
        $model = new SignupForm();
        $user = new Members();
        $otp = new User();


        if ($model->load(Yii::$app->request->post())) {

            $length = strlen($model->zssf_no);

            if ($length == 1) {

                $zssf = '0000000' . $model->zssf_no;
            }
            if ($length == 2) {

                $zssf = '000000' . $model->zssf_no;
            }
            if ($length == 3) {

                $zssf = '00000' . $model->zssf_no;
            }
            if ($length == 4) {

                $zssf = '0000' . $model->zssf_no;
            }
            if ($length == 5) {

                $zssf = '000' . $model->zssf_no;
            }
            if ($length == 6) {

                $zssf = '00' . $model->zssf_no;
            }
            if ($length == 7) {

                $zssf = '0' . $model->zssf_no;
            }
            if ($length == 8) {
                $zssf = $model->zssf_no;
            }
            if ($length > 8) {
                $zssf = $model->zssf_no;
            }

            $contact = Members::find()->where(['membership_number' => $zssf])->one();

            $email = $contact['email'];
            $phone = $contact['mobile_number'];
            $OTP = Yii::$app->security->generateRandomString(4);
            $message = "Your ZSSF verification code is $OTP ";


            $reset_count = User::find()->max('resetCount');
            $uniq_id = NULL;
            if (empty($reset_count)) {
                $uniq_id = $model->resetCount = 1;
            } else {
                $chk_id = User::find()->where(['resetCount' => $reset_count])->exists();
                if ($chk_id)
                    $uniq_id = $reset_count + 1;
                else
                    $uniq_id = $reset_count;
            }

            $otp_expire = date('Y-m-d H:i:s');
            $date = date_create($otp_expire); // or your date string
            date_add($date, date_interval_create_from_date_string("5 minutes"));// add number of days
            $expire = date_format($date, "Y-m-d H:i:s");

            if (!empty($contact)) {
                if ($model->validation_method == SignupForm::email) {

                    if (!empty($email)) {
                        $sent_from = CommonZssfSettings::findOne(['id' => 1]);
                        $email_from = $sent_from['contact_email'];
                        User::updateAll(['otep' => $OTP, 'lastResetTime' => $expire, 'resetCount' => $uniq_id], ['id' => $contact['uid']]);
//                        Yii::$app->mailer->compose()
//                            ->setFrom('info@zssf.or.tz')
//                            ->setTo('nelsonjoshua301@gmail.com')
//                            ->setSubject('ZSSF Activation Code')
//                            ->setTextBody('Plain text content. YII2 Application')
//                            ->send();

                        $subject = 'ZSSF Activation Code';
                        $message = "ZSSF Activation Code $OTP";
                        $headers = 'From:info@zssf.or.tz';
                        $email = 'nelsonjoshua301@gmail.com';
                        mail($email, $subject, $message);

                        $sms_log=new SmsLogs();
                        $sms_log->date_time=date('Y-m-d H:i:s');
                        $sms_log->recipient_number=$email;
                        $sms_log->message=$message;
                        $sms_log->sms_status=1;
                        $sms_log->member_number=$zssf;
                        $sms_log->save(false);
                        Yii::$app->session->setFlash('form_success', Yii::t('yii', 'We have sent OTP to your email address'));
                        return $this->redirect(['site/reset']);
                    } else {
                        Yii::$app->session->setFlash('form_fail', Yii::t('yii', Yii::t('yii', 'No email found in this account, please try another method')));
                        return $this->redirect(['site/reset']);
                    }

                } // SEND TO SMS
                elseif ($model->validation_method == SignupForm::sms) {

                    if (!empty($phone)) {
                        if ($phone[0] == 0) {

                            $country_code = '255';

                            $new_number = substr_replace($phone, '+' . $country_code, 0, ($phone[0] == '0'));

                            User::updateAll(['otep' => $OTP, 'lastResetTime' => $expire, 'resetCount' => $uniq_id], ['id' => $contact['uid']]);

                            $this->file_get_contents_curl($message, $new_number);

                            $sms_log=new SmsLogs();
                            $sms_log->date_time=date('Y-m-d H:i:s');
                            $sms_log->recipient_number=$new_number;
                            $sms_log->message=$message;
                            $sms_log->sms_status=1;
                            $sms_log->member_number=$zssf;
                            $sms_log->save(false);

                            Yii::$app->session->setFlash('form_success', Yii::t('yii', 'We have sent OTP to your phone number'));
                            return $this->redirect(['site/reset']);
                        } else {

                            User::updateAll(['otep' => $OTP, 'lastResetTime' => $expire, 'resetCount' => $uniq_id], ['id' => $contact['uid']]);

                            $this->file_get_contents_curl($message, $phone);

                            $sms_log=new SmsLogs();
                            $sms_log->date_time=date('Y-m-d H:i:s');
                            $sms_log->recipient_number=$phone;
                            $sms_log->message=$message;
                            $sms_log->sms_status=1;
                            $sms_log->member_number=$zssf;
                            $sms_log->save(false);
                            Yii::$app->session->setFlash('form_success', Yii::t('yii', 'We have sent OTP to your phone number'));
                            return $this->redirect(['site/reset']);
                        }

                    } else {
                        Yii::$app->session->setFlash('form_fail', Yii::t('yii', Yii::t('yii', 'No phone number found in this account, please try another method')));
                        return $this->redirect(['site/reset']);
                    }

                }
            } else {
                Yii::$app->session->setFlash('form_fail', Yii::t('yii', Yii::t('yii', 'ZSSF Number submitted does not match any records in our database')));
                return $this->redirect(['site/reset']);
            }

        }

        return $this->render('reset', [
            'model' => $model,
            'user' => $user,
            'otp' => $otp,
        ]);
    }


    public function actionSignup()
    {
        $model = new SignupForm();
        $user = new Members();
        $otp = new User();

        if ($model->load(Yii::$app->request->post())) {

            $length = strlen($model->zssf_no);

            if ($length == 1) {

                $zssf = '0000000' . $model->zssf_no;
            }
            if ($length == 2) {

                $zssf = '000000' . $model->zssf_no;
            }
            if ($length == 3) {

                $zssf = '00000' . $model->zssf_no;
            }
            if ($length == 4) {

                $zssf = '0000' . $model->zssf_no;
            }
            if ($length == 5) {

                $zssf = '000' . $model->zssf_no;
            }
            if ($length == 6) {

                $zssf = '00' . $model->zssf_no;
            }
            if ($length == 7) {

                $zssf = '0' . $model->zssf_no;
            }
            if ($length == 8) {
                $zssf = $model->zssf_no;
            }
            if ($length > 8) {
                $zssf = $model->zssf_no;
            }


            $validation_type=$_POST['SignupForm']['validation_method'];

            $url = 'http://mobile.zssf.or.tz/api/v1/static/index.php/validation-code';
            $data_json=json_encode(["member_number" => "$zssf", "lang" => "eng",'user_type'=>'10','validation_type'=>"$validation_type"]);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response  = curl_exec($ch);
            curl_close($ch);

            $results=json_decode($response,true);
            $status=$results['userData']['status'];
            $message=$results['userData']['message'];
            //$OTP=$results['userData']['validation_code'];
           // print_r($status);
           // die;

            if ($status == '200'){


                Yii::$app->session->setFlash('form_success', Yii::t('yii', 'We have sent OTP to your phone number'));
                return $this->redirect(['site/signup']);
            }
            else{
             //   echo 'fail';
                Yii::$app->session->setFlash('form_fail', Yii::t('yii', Yii::t('yii', "$message")));
                return $this->redirect(['site/signup']);
            }
            //die;

          //

        }

        return $this->render('signup', [
            'model' => $model,
            'user' => $user,
            'otp' => $otp,
        ]);
    }

    public function actionVerify()
    {
        $otp = new User();
        $model = new SignupForm();
        $user = new Members();
        //  $users = User::findOne(['otep' => $_POST['User']['otep']]);
        $users = ZssfBackendMembersSimulation::find()->where(['LIKE BINARY', 'validation_code', $_POST['User']['otep']])->one();
        $z_number=$users['member_number'];

        $otp_time = strtotime($users['date_time']);
        $date_time = strtotime(date('Y-m-d H:i:s'));

        if ($otp->load(Yii::$app->request->post())) {
            if ($users != '') {
//                if ($otp_time >= $date_time) {

                    Yii::$app->session->setFlash('otp_success', Yii::t('yii', 'Verification code success'));
                    Yii::$app->session->setFlash('z_number', Yii::t('yii',$z_number ));
//                } else {
//
//                    Yii::$app->session->setFlash('otp_fail', Yii::t('yii', 'Verification code expired'));
//                }

            } else {
                Yii::$app->session->setFlash('otp_fail', Yii::t('yii', 'Verification code failed'));

            }

        }

        return $this->render('signup', [
            'model' => $model,
            'otp' => $otp,
            'user' => $user,

        ]);

    }
    public function actionVerifyOtp()
    {
        $otp = new User();
        $model = new SignupForm();
        $user = new Members();
        //  $users = User::findOne(['otep' => $_POST['User']['otep']]);
        $users = User::find()->where(['LIKE BINARY', 'otep', $_POST['User']['otep']])->one();
        //$date=$user['date(date_time)'];
        $otp_time = strtotime($users['lastResetTime']);
        $date_time = strtotime(date('Y-m-d H:i:s'));

        if ($otp->load(Yii::$app->request->post())) {
            if ($users != '') {
                if ($otp_time >= $date_time) {
                    //  $users = User::findOne(['otep' => $_POST['User']['otep']]);
                    Yii::$app->session->setFlash('otp_success', Yii::t('yii', 'Verification code success'));
                } else {
                    Yii::$app->session->setFlash('otp_fail', Yii::t('yii', 'Verification code expired'));
                }


            } else {
                Yii::$app->session->setFlash('otp_fail', Yii::t('yii', 'Verification code failed'));

            }

        }

        return $this->render('reset', [
            'model' => $model,
            'otp' => $otp,
            'user' => $user,

        ]);

    }

    public function actionFinishReset()
    {
        $otp = new User();
        $model = new SignupForm();
        $user = new Members();

        if (Yii::$app->request->isAjax && $user->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($user);
        }

        $details = Members::findOne(['membership_number' => $_POST['Members']['membership_number']]);
        //  $exist = Members::findOne(['membership_number' => $_POST['Members']['membership_number']]);

        $username_member_number = Members::find()
            ->where(['username' => $_POST['Members']['username']])
            ->andWhere(['membership_number' => $_POST['Members']['membership_number']])
            ->one();

        // $username1_exist = Members::findOne(['username' => $_POST['Members']['username']]);
        //  $username_exist = User::findOne(['username' => $_POST['Members']['username']]);
        if ($user->load(Yii::$app->request->post())) {
            if ($username_member_number) {

                $auth_key = Yii::$app->security->generateRandomString();
                $verification_token = Yii::$app->security->generateRandomString() . '_' . time();
                $username = $_POST['Members']['username'];
                $membership_number = $_POST['Members']['membership_number'];
                $status = \common\models\User::STATUS_ACTIVE;
                $pass = Yii::$app->security->generatePasswordHash($_POST['Members']['password']);


                Members::updateAll(['password' => $pass], ['membership_number' => $membership_number]);
                User::updateAll(['status' => $status, 'password' => $pass, 'auth_key' => $auth_key, 'verification_token' => $verification_token], ['id' => $details['uid']]);
                Yii::$app->session->setFlash('details_success', Yii::t('yii', 'Account was successfully created'));
                return $this->redirect(['site/reset']);

            } else {
                Yii::$app->session->setFlash('details_fail', Yii::t('yii', 'Username exist, please enter new one again'));

            }
        }

        return $this->render('reset', [
            'model' => $model,
            'otp' => $otp,
            'user' => $user,

        ]);

    }
    public function actionFinish()
    {
        $otp = new User();
        $model = new SignupForm();
        $user = new Members();

        if (Yii::$app->request->isAjax && $user->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($user);
        }

        $details = Members::findOne(['membership_number' => $_POST['Members']['membership_number']]);
        //  $exist = Members::findOne(['membership_number' => $_POST['Members']['membership_number']]);

        $username_member_number = Members::find()
            ->where(['username' => $_POST['Members']['username']])
           // ->andWhere(['membership_number' => $_POST['Members']['membership_number']])
            ->one();

        // $username1_exist = Members::findOne(['username' => $_POST['Members']['username']]);
        //  $username_exist = User::findOne(['username' => $_POST['Members']['username']]);
        if ($user->load(Yii::$app->request->post())) {
            if (empty($username_member_number)) {

                $auth_key = Yii::$app->security->generateRandomString();
                $verification_token = Yii::$app->security->generateRandomString() . '_' . time();
                $status = \common\models\User::STATUS_ACTIVE;
                $username=$_POST['Members']['username'];
                $pass = Yii::$app->security->generatePasswordHash($_POST['Members']['password']);


                $new_user=new User();
                $new_user->name=$_POST['Members']['full_names'];
                $new_user->username=$_POST['Members']['username'];
                $new_user->email=$_POST['Members']['email'];
                $new_user->password=$pass;
                $new_user->auth_key=$auth_key;
                $new_user->registerDate=date('Y-m-d H:i:s');
                $new_user->password_reset_token=$auth_key;
                $new_user->verification_token=$verification_token;
                $new_user->status=$status;

                if ($new_user->save(false)){
                    $new_member=new Members();
                    $new_member->uid=$new_user->id;
                    $new_member->date_time=date('Y-m-d H:i:s');
                    $new_member->full_names=$_POST['Members']['full_names'];
                    $new_member->membership_number=$_POST['Members']['membership_number'];
                    $new_member->email=$_POST['Members']['email'];
                    $new_member->password=$pass;
                    $new_member->username=$_POST['Members']['username'];
                    $new_member->mobile_number=$_POST['Members']['mobile_number'];
                    $new_member->date_of_birth=date($_POST['Members']['date_of_birth']);
                    $new_member->address=$_POST['Members']['address'];
                    $new_member->gender=$_POST['Members']['gender'];
                    $new_member->marital_status=$_POST['Members']['marital_status'];
                    $new_member->date_of_joining=date($_POST['Members']['marital_status']);
                    $new_member->save(false);

                    $OTP=$_POST['Members']['auth_code'];
                    $memb=$_POST['Members']['membership_number'];
                    $url = 'http://mobile.zssf.or.tz/api/v1/static/index.php/signup';
                    $data_json=json_encode(['password'=>"$pass","member_number"=> "$memb",'validation_code'=>"$OTP",'language'=>'sw','username'=>"$username"]);

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response  = curl_exec($ch);
                    curl_close($ch);

                    $detail=json_decode($response,true);

                    if ($detail){
                        $url = 'http://mobile.zssf.or.tz/api/v1/static/index.php/update-zssf-member';
                        $data_json=json_encode(["member_number"=> "$memb"]);

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response  = curl_exec($ch);
                        curl_close($ch);
                    }

                }


               // Members::updateAll(['password' => $pass], ['membership_number' => $membership_number]);
               // User::updateAll(['status' => $status, 'password' => $pass, 'auth_key' => $auth_key, 'verification_token' => $verification_token], ['id' => $details['uid']]);
                Yii::$app->session->setFlash('details_success', Yii::t('yii', 'Account was successfully created'));
                return $this->redirect(['site/signup']);

            } else {
                Yii::$app->session->setFlash('details_fail', Yii::t('yii', 'Username exist, please enter new one again'));

            }
        }

        return $this->render('signup', [
            'model' => $model,
            'otp' => $otp,
            'user' => $user,

        ]);

    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
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
