<?php

namespace backend\controllers;

use backend\models\AlertsSchedule;
use backend\models\UserCounters;
use backend\models\ZssfMembers;
use Yii;
use backend\models\AlertsScheduleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AlertsController implements the CRUD actions for Alerts model.
 */
class AlertsScheduleController extends Controller
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
     * Lists all Alerts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlertsScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBulkVerification()
    {
        $model = new AlertsSchedule();

        if ($model->load(Yii::$app->request->post()) ) {

            $model->created_at=date('Y-m-d H:i:s');
            $model->uid=Yii::$app->user->identity->id;
            $model->msg_category_id=3;
            $model->status="Pending";

            $send_date=$model->schedule_date;

            $url = 'https://mobile.zssf.or.tz/api2/public/index.php/pensioner-bulk-verification/';
            $data_json = json_encode(["send_date" => "$send_date"]);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $response = json_decode($response, true);

            if ($response === null) {
                Yii::$app->session->setFlash('fail', Yii::t('yii', 'Invalid response from API'));
                return $this->render('create-bulk-verification', [
                    'model' => $model,
                ]);
            }

            $responseStatus=$response['status'];
            $responseMessage=$response['message'];

            if($responseStatus =='200'){

                $model->save(false);

                Yii::$app->session->setFlash('success', Yii::t('yii', $responseMessage));
                return $this->redirect(['index']);
            }
            else{

                Yii::$app->session->setFlash('fail', Yii::t('yii', $response));

                return $this->render('create-bulk-verification', [
                    'model' => $model,
                ]);
            }

        }

        return $this->render('create-bulk-verification', [
            'model' => $model,
        ]);




    }

    /**
     * Displays a single Alerts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
    }

    /**
     * Creates a new Alerts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
//        $model = new Alerts();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
    }

    public function actionBulk()
    {
        if (Yii::$app->user->can('viewNotification')) {
            UserCounters::checkLastLogin();
            $model = new AlertsSchedule();

            if ($model->load(Yii::$app->request->post())) {

                $types = $model->message_type;
                $type = implode(',', $types);
                //   print_r($type);
                // die;

                if ($type == 'email') {
                    $members = ZssfMembers::find()->select('id')->where(['!=', 'email', ''])->all();
                    foreach ($members as $member) {

                        $alert = new AlertsSchedule();
                        $alert->created_at = date('Y-m-d H:i:s');
                        $alert->message_type = $type;
                        $alert->message = $model->message;
                        $alert->subject = $model->subject;
                        $alert->status = 'Pending';
                        $alert->uid = $member['id'];
                        $alert->save(false);
                    }
                    Yii::$app->session->setFlash('info', Yii::t('yii', 'Notification sent successfully'));
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                } elseif ($type == 'sms') {
                    $members = ZssfMembers::find()->select('id')->where(['!=', 'mobile_number', ''])->all();
                    foreach ($members as $member) {

                        $alert = new AlertsSchedule();
                        $alert->created_at = date('Y-m-d H:i:s');
                        $alert->message_type = $type;
                        $alert->message = $model->message;
                        $alert->subject = $model->subject;
                        $alert->status = 'Pending';
                        $alert->uid = $member['id'];
                        $alert->save(false);
                    }
                    Yii::$app->session->setFlash('info', Yii::t('yii', 'Notification sent successfully'));

                    return $this->render('create', [
                        'model' => $model,
                    ]);
                } elseif ($type == 'notification') {

                    $members = ZssfMembers::find()->select('id')->where(['!=', 'mobile_number', ''])->all();
                    foreach ($members as $member) {

                        $alert = new AlertsSchedule();
                        $alert->created_at = date('Y-m-d H:i:s');
                        $alert->message_type = $type;
                        $alert->message = $model->message;
                        $alert->subject = $model->subject;
                        $alert->status = 'Pending';
                        $alert->uid = $member['id'];
                        $alert->save(false);
                    }


                    $members = ZssfMembers::find()->select('id')->where(['!=', 'email', ''])->all();
                    foreach ($members as $member) {

                        $alert = new AlertsSchedule();
                        $alert->created_at = date('Y-m-d H:i:s');
                        $alert->message_type = $type;
                        $alert->message = $model->message;
                        $alert->subject = $model->subject;
                        $alert->status = 'Pending';
                        $alert->uid = $member['id'];
                        $alert->save(false);
                    }


                    Yii::$app->session->setFlash('info', Yii::t('yii', 'Notification sent successfully'));
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                } elseif ($type == 'sms,email,notification' || $type == 'sms,email' || $type == 'sms,notification'
                    || $type == 'email,notification' || $type == 'sms,notification') {

                    $members = ZssfMembers::find()->select('id')->where(['!=', 'mobile_number', ''])->all();
                    foreach ($members as $member) {

                        $alert = new AlertsSchedule();
                        $alert->created_at = date('Y-m-d H:i:s');
                        $alert->message_type = $type;
                        $alert->message = $model->message;
                        $alert->subject = $model->subject;
                        $alert->status = 'Pending';
                        $alert->uid = $member['id'];
                        $alert->save(false);
                    }


                    $members = ZssfMembers::find()->select('id')->where(['!=', 'email', ''])->all();
                    foreach ($members as $member) {

                        $alert = new AlertsSchedule();
                        $alert->created_at = date('Y-m-d H:i:s');
                        $alert->message_type = $type;
                        $alert->message = $model->message;
                        $alert->subject = $model->subject;
                        $alert->status = 'Pending';
                        $alert->uid = $member['id'];
                        $alert->save(false);
                    }


                    Yii::$app->session->setFlash('info', Yii::t('yii', 'Notification sent successfully'));
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('yii', 'Notification Fail'));

                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }


            }


            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else{
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to view'));
            return $this->redirect(['/']);
        }
    }


    /**
     * Updates an existing Alerts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Alerts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
    }

    /**
     * Finds the Alerts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Alerts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Alerts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
