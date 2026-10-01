<?php

namespace backend\controllers;

use backend\models\Alerts;
use backend\models\AuditTrial;
use backend\models\CommonZssfSettings;
use backend\models\Complaints;
use backend\models\Contributions;
use backend\models\ContributionTrend;
use backend\models\SmsLogs;
use backend\models\UserCounters;
use common\models\User;
use frontend\models\ApplicationsStatuses;
use frontend\models\BufferResults;
use frontend\models\Members;
use kartik\form\ActiveForm;
use Yii;
use backend\models\ZssfMembers;
use backend\models\ZssfMembersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * ZssfMembersController implements the CRUD actions for ZssfMembers model.
 */
class ZssfMembersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ZssfMembers models.
     * @return mixed
     */
    public function actionIndex()
    {

        
        if (Yii::$app->user->can('viewMembers')) {
            $searchModel = new ZssfMembersSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            UserCounters::checkLastLogin();
            $audit = new AuditTrial();
            $audit->items = 'view members';
            // $audit->activity='Login';
            $audit->module = 'members';
            $audit->action = 'view';
            $audit->new = '';
            $audit->old = '';
            $audit->category = 2;
            $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
            $audit->maker_time = date('Y-m-d H:i:s');
            $audit->save(false);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        } else {
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to view'));
            return $this->redirect(['/']);
        }
    }


    public function actionEmployers()
    {
        if (Yii::$app->user->can('viewMembers')) {
            $searchModel = new ZssfMembersSearch();
            $dataProvider = $searchModel->searchEmployer(Yii::$app->request->queryParams);

            $audit = new AuditTrial();
            $audit->items = 'view members';
            // $audit->activity='Login';
            $audit->module = 'members';
            $audit->action = 'view';
            $audit->new = '';
            $audit->old = '';
            $audit->category = 2;
            $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
            $audit->maker_time = date('Y-m-d H:i:s');
            $audit->save(false);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        } else {
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to view'));
            return $this->redirect(['/']);
        }
    }


    /**
     * Displays a single ZssfMembers model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ZssfMembers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ZssfMembers();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            try {
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } catch (\yii\db\IntegrityException $e) {
                if (strpos($e->getMessage(), 'Duplicate entry') !== false && strpos($e->getMessage(), 'username') !== false) {
                    $model->addError('username', 'This username is already taken. Please use another username.');
                } else {
                    throw $e;
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ZssfMembers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('viewMembers')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                try {
                    // The member edit form allows partial legacy records. Do not
                    // block updating their other details on unrelated validation.
                    if ($model->save(false)) {
                        User::updateAll(['username' => $model->username, 'email' => $model->email], ['id' => $model->uid]);

                        $audit = new AuditTrial();
                        $audit->items = 'update members details(' . $model->membership_number . ')';
                        // $audit->activity='Login';
                        $audit->module = 'members';
                        $audit->action = 'update member';
                        $audit->new = '';
                        $audit->old = '';
                        $audit->category = 2;
                        $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
                        $audit->maker_time = date('Y-m-d H:i:s');
                        $audit->save(false);
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (\yii\db\IntegrityException $e) {
                    if (strpos($e->getMessage(), 'Duplicate entry') !== false && strpos($e->getMessage(), 'username') !== false) {
                        $model->addError('username', 'This username is already taken. Please use another username.');
                    } else {
                        throw $e;
                    }
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to update'));
            return $this->redirect(['/']);
        }
    }

    public function actionReset($id)
    {
        if (Yii::$app->user->can('viewMembers')) {
            $model = $this->findModel($id);


            if ($model->load(Yii::$app->request->post())) {

                // User::updateAll(['username' => $model->username, 'email' => $model->email], ['id' => $model->uid]);

//                $audit = new AuditTrial();
//                $audit->items = 'reset members password(' . $model->membership_number . ')';
//                // $audit->activity='Login';
//                $audit->module = 'members';
//                $audit->action = 'update member';
//                $audit->new = '';
//                $audit->old = '';
//                $audit->category = 2;
//                $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
//                $audit->maker_time = date('Y-m-d H:i:s');
//                $audit->save(false);

                $zssf=$model->membership_number;
                $email=$model->email;
               // $email="nelsonjoshua301@gmail.com";
                $phone=$model->mobile_number;
               // $phone="0766727073";
                $username=$model->username;
                $pin=Yii::$app->security->generateRandomString(5);
                $pin=strtoupper($pin);
                $OTP=Yii::$app->security->generatePasswordHash($pin);
                $message = "Tafadhali tumia alama siri $pin kuingia katika App, jina la kuingia ni $username. Unaweza kubadilisha nenosiri baada ya kuingia.";
                $message = urlencode($message);

                if(!empty($phone)){

                    if ($phone[0] == '0') {

                        $country_code = '255';

                        $new_number = substr_replace($phone, '' . $country_code, 0, ($phone[0] == '0'));


                        User::updateAll(['password' => $OTP], ['id' => $model->uid]);
                        ZssfMembers::updateAll(['password' => $OTP], ['uid' => $model->uid]);

                        $this->file_get_contents_curl($message, $new_number);

                        $sms_log = new SmsLogs();
                        $sms_log->date_time = date('Y-m-d H:i:s');
                        $sms_log->recipient_number = $new_number;
                        $sms_log->message = $message;
                        $sms_log->sms_status = 1;
                        $sms_log->msg_category_id = 2;
                        $sms_log->member_number = $zssf;
                        $sms_log->save(false);

                        Yii::$app->session->setFlash('success', Yii::t('yii', 'We have sent OTP to your phone Number'));
                        return $this->redirect(['view','id'=>$model->id]);
                    }
                    elseif ($phone[0] == '+') {
                        // echo 'hello',
                        //  die;

                        $country_code = '';

                        $new_number = substr_replace($phone, '' . $country_code, 0, ($phone[0] == '+'));

                        User::updateAll(['password' => $OTP], ['id' => $model->uid]);
                        ZssfMembers::updateAll(['password' => $OTP], ['uid' => $model->uid]);


                        //  $this->file_get_contents_curl($message, $new_number);

                        $sms_log = new SmsLogs();
                        $sms_log->date_time = date('Y-m-d H:i:s');
                        $sms_log->recipient_number = $new_number;
                        $sms_log->message = $message;
                        $sms_log->sms_status = 1;
                        $sms_log->msg_category_id = 2;
                        $sms_log->member_number = $zssf;
                        $sms_log->save(false);

                        Yii::$app->session->setFlash('success', Yii::t('yii', 'We have sent OTP to your Phone Number'));
                        return $this->redirect(['view','id'=>$model->id]);
                    }
                    else {

                        User::updateAll(['password' => $OTP], ['id' => $model->uid]);
                        ZssfMembers::updateAll(['password' => $OTP], ['uid' => $model->uid]);

                        //   $this->file_get_contents_curl($message, $phone);

                        $sms_log = new SmsLogs();
                        $sms_log->date_time = date('Y-m-d H:i:s');
                        $sms_log->recipient_number = $phone;
                        $sms_log->message = $message;
                        $sms_log->sms_status = 1;
                        $sms_log->msg_category_id = 2;
                        $sms_log->member_number = $zssf;
                        $sms_log->save(false);
                        Yii::$app->session->setFlash('success', Yii::t('yii', 'We have sent OTP to your Phone Number'));
                        return $this->redirect(['view','id'=>$model->id]);
                    }

                }
                else{

                    if (!empty($email)) {

                        $subject = 'ZSSF Reset Code';
                        //  $message = "ZSSF Activation Code $OTP";
                        $headers = 'From:info@zssf.or.tz';
                        mail($email, $subject, $message);

                        User::updateAll(['password' => $OTP], ['id' => $model->uid]);
                        ZssfMembers::updateAll(['password' => $OTP], ['uid' => $model->uid]);


                        $sms_log = new SmsLogs();
                        $sms_log->date_time = date('Y-m-d H:i:s');
                        $sms_log->recipient_number = $email;
                        $sms_log->message = $message;
                        $sms_log->sms_status = 1;
                        $sms_log->msg_category_id = 2;
                        $sms_log->member_number = $zssf;
                        $sms_log->save(false);
                        Yii::$app->session->setFlash('success', Yii::t('yii', 'We have sent OTP to your email address'));
                        return $this->redirect(['view','id'=>$model->id]);
                    } else {
                        Yii::$app->session->setFlash('danger', Yii::t('yii', Yii::t('yii', 'No email found in this account, please try another method')));
                        return $this->redirect(['view','id'=>$model->id]);
                    }

                }

            #######OLD VERSION #######
     /*
                if ($model->method == 2) {

                    if (!empty($email)) {

                        $subject = 'ZSSF Reset Code';
                        //  $message = "ZSSF Activation Code $OTP";
                        $headers = 'From:info@zssf.or.tz';
                        mail($email, $subject, $message);

                        User::updateAll(['password' => $OTP], ['id' => $model->uid]);

                        $sms_log = new SmsLogs();
                        $sms_log->date_time = date('Y-m-d H:i:s');
                        $sms_log->recipient_number = $email;
                        $sms_log->message = $message;
                        $sms_log->sms_status = 1;
                        $sms_log->msg_category_id = 2;
                        $sms_log->member_number = $zssf;
                        $sms_log->save(false);
                        Yii::$app->session->setFlash('success', Yii::t('yii', 'We have sent OTP to your email address'));
                        return $this->redirect(['view','id'=>$model->id]);
                    } else {
                        Yii::$app->session->setFlash('danger', Yii::t('yii', Yii::t('yii', 'No email found in this account, please try another method')));
                        return $this->redirect(['view','id'=>$model->id]);
                    }

                } // SEND TO SMS
                elseif ($model->method == 1) {

                    if (!empty($phone)) {

                        if ($phone[0] == '0') {

                            $country_code = '255';

                            $new_number = substr_replace($phone, '' . $country_code, 0, ($phone[0] == '0'));


                            User::updateAll(['password' => $OTP], ['id' => $model->uid]);

                               $this->file_get_contents_curl($message, $new_number);

                            $sms_log = new SmsLogs();
                            $sms_log->date_time = date('Y-m-d H:i:s');
                            $sms_log->recipient_number = $new_number;
                            $sms_log->message = $message;
                            $sms_log->sms_status = 1;
                            $sms_log->msg_category_id = 2;
                            $sms_log->member_number = $zssf;
                            $sms_log->save(false);

                            Yii::$app->session->setFlash('success', Yii::t('yii', 'We have sent OTP to your email address'));
                            return $this->redirect(['view','id'=>$model->id]);
                        }
                        elseif ($phone[0] == '+') {
                            // echo 'hello',
                            //  die;

                            $country_code = '';

                            $new_number = substr_replace($phone, '' . $country_code, 0, ($phone[0] == '+'));

                            User::updateAll(['password' => $OTP], ['id' => $model->uid]);


                            //  $this->file_get_contents_curl($message, $new_number);

                            $sms_log = new SmsLogs();
                            $sms_log->date_time = date('Y-m-d H:i:s');
                            $sms_log->recipient_number = $new_number;
                            $sms_log->message = $message;
                            $sms_log->sms_status = 1;
                            $sms_log->msg_category_id = 2;
                            $sms_log->member_number = $zssf;
                            $sms_log->save(false);

                            Yii::$app->session->setFlash('success', Yii::t('yii', 'We have sent OTP to your email address'));
                            return $this->redirect(['view','id'=>$model->id]);
                        }
                        else {

                            User::updateAll(['password' => $OTP], ['id' => $model->uid]);

                            //   $this->file_get_contents_curl($message, $phone);

                            $sms_log = new SmsLogs();
                            $sms_log->date_time = date('Y-m-d H:i:s');
                            $sms_log->recipient_number = $phone;
                            $sms_log->message = $message;
                            $sms_log->sms_status = 1;
                            $sms_log->msg_category_id = 2;
                            $sms_log->member_number = $zssf;
                            $sms_log->save(false);
                            Yii::$app->session->setFlash('success', Yii::t('yii', 'We have sent OTP to your email address'));
                            return $this->redirect(['view','id'=>$model->id]);
                        }

                    } else {

                        Yii::$app->session->setFlash('danger', Yii::t('yii', Yii::t('yii', 'No phone number found in this account, please try another method')));
                        return $this->redirect(['view','id'=>$model->id]);
                    }

                }*/


              //  return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('reset', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to update'));
            return $this->redirect(['/']);
        }
    }

    /**
     * Deletes an existing ZssfMembers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('deleteMember')) {
            $model = Members::find()->where(['id' => $id])->one();

            User::deleteAll(['id' => $model->uid]);
            Contributions::deleteAll(['member_number' => $model->membership_number]);
            ContributionTrend::deleteAll(['member_id' => $model->member_sys_id]);
            BufferResults::deleteAll(['member_number' => $model->membership_number]);
            ApplicationsStatuses::deleteAll(['member_number' => $model->membership_number]);
            Complaints::deleteAll(['zssf_number' => $model->membership_number]);

            $audit = new AuditTrial();
            $audit->items = 'delete members (' . $model->membership_number . ')';
            // $audit->activity='Login';
            $audit->module = 'members';
            $audit->action = 'delete member';
            $audit->new = '';
            $audit->old = '';
            $audit->category = 2;
            $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
            $audit->maker_time = date('Y-m-d H:i:s');
            $audit->save(false);

            $this->findModel($id)->delete();

            Yii::$app->session->setFlash('', [
                'type' => 'success',
                'duration' => 50000,
                'icon' => 'fa fa-check',
                'message' => 'Account deleted Successfully',
                'positonY' => 'top',
                'positonX' => 'right',
            ]);
            Yii::$app->session->setFlash('success', Yii::t('yii', 'Account deleted Successfully'));

            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to delete'));
            return $this->redirect(['/']);
        }
    }

    private function file_get_contents_curl($message, $phone_number)
    {
        $url = 'https://gw.selcommobile.com:8443/bin/send.json?USERNAME=zssf&PASSWORD=9LxWuiWNuc&DESTADDR=' . $phone_number . '&MESSAGE=' . $message;
        $json_response = json_decode(file_get_contents($url));

        //$json_response->results[0]
        $sms_status = $json_response->results[0]->status;

    }

    /**
     * Finds the ZssfMembers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ZssfMembers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ZssfMembers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
