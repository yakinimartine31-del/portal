<?php

namespace backend\controllers;

use backend\models\Alerts;
use backend\models\AuditTrial;
use backend\models\UserCounters;
use frontend\models\CommonZssfSettings;
use frontend\models\Members;
use frontend\models\SignupForm;
use frontend\models\SmsLogs;
use frontend\models\User;
use Yii;
use yii\helpers\Url;
use backend\models\Complaints;
use backend\models\ComplaintsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * ComplaintsController implements the CRUD actions for Complaints model.
 */
class ComplaintsController extends Controller
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
     * Serve image preview for authenticated users
     */
    public function actionPreviewImage($id)
    {
        $model = $this->findModel($id);
        
        if (!$model->photo_file) {
            // Very attractive fallback HTML when no image exists
            Yii::$app->response->format = Response::FORMAT_RAW;
            Yii::$app->response->headers->set('Content-Type', 'text/html; charset=utf-8');
            $backUrl = Url::to(['view', 'id' => $model->id]);
            Yii::$app->response->data = '<!doctype html><html><head><meta charset="utf-8"><title>No image</title><style>' .
                'body{background:linear-gradient(135deg,#f6d365 0%,#fda085 100%);font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;margin:0;height:100vh;display:flex;align-items:center;justify-content:center}' .
                '.card{background:rgba(255,255,255,0.98);padding:36px;border-radius:18px;box-shadow:0 12px 36px rgba(0,0,0,0.12);text-align:center;max-width:560px}' .
                'h1{margin:0 0 10px;font-size:28px;color:#222;font-weight:700}' .
                'p{margin:0 0 18px;color:#555;font-size:15px}' .
                'a.button{display:inline-block;padding:12px 30px;background:linear-gradient(90deg,#667eea 0%,#764ba2 100%);color:#fff;text-decoration:none;border-radius:999px;font-weight:700;box-shadow:0 10px 30px rgba(118,75,162,0.22);transition:transform .15s ease,box-shadow .15s ease}' .
                'a.button:hover{transform:translateY(-4px);box-shadow:0 18px 40px rgba(118,75,162,0.28)}' .
                '.icon{display:inline-flex;margin-bottom:14px;background:linear-gradient(90deg,#ffafbd 0%,#ffc3a0 100%);width:64px;height:64px;border-radius:50%;align-items:center;justify-content:center;box-shadow:0 12px 28px rgba(0,0,0,0.12)}' .
                '.icon svg{width:36px;height:36px;fill:#fff}' .
                '</style></head><body><div class="card"><div class="icon">' .
                '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21 19V5a2 2 0 0 0-2-2H5C3.9 3 3 3.9 3 5v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2zM8.5 13.5l2.5 3L15 11l4 5H5l3.5-2.5z"/></svg>' .
                '</div><h1>Please upload image</h1><p>No preview is available for this complaint\'s image.</p>' .
                '<a class="button" href="' . $backUrl . '">Back to complaint</a></div></body></html>';
            return Yii::$app->response;
        }
        
        // Try multiple possible upload paths
        $possiblePaths = [
            Yii::getAlias('@webroot/../api') . $model->photo_file,
            Yii::getAlias('@webroot') . '/../../api' . $model->photo_file,
            Yii::getAlias('@frontend/web') . '/../../api' . $model->photo_file,
            dirname(Yii::getAlias('@webroot')) . '/api' . $model->photo_file,
            $model->photo_file // absolute path if already full
        ];
        
        foreach ($possiblePaths as $filePath) {
            if (file_exists($filePath)) {
                $mimeType = mime_content_type($filePath);
                Yii::$app->response->format = Response::FORMAT_RAW;
                Yii::$app->response->headers->set('Content-Type', $mimeType);
                Yii::$app->response->headers->set('Content-Disposition', 'inline; filename="' . basename($filePath) . '"');
                Yii::$app->response->data = file_get_contents($filePath);
                return Yii::$app->response;
            }
        }
        
        // File exists in none of the expected locations — show the same attractive fallback
        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->set('Content-Type', 'text/html; charset=utf-8');
        $backUrl = Url::to(['view', 'id' => $model->id]);
        Yii::$app->response->data = '<!doctype html><html><head><meta charset="utf-8"><title>No image</title><style>' .
            'body{background:linear-gradient(135deg,#f6d365 0%,#fda085 100%);font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;margin:0;height:100vh;display:flex;align-items:center;justify-content:center}' .
            '.card{background:rgba(255,255,255,0.98);padding:36px;border-radius:18px;box-shadow:0 12px 36px rgba(0,0,0,0.12);text-align:center;max-width:560px}' .
            'h1{margin:0 0 10px;font-size:28px;color:#222;font-weight:700}' .
            'p{margin:0 0 18px;color:#555;font-size:15px}' .
            'a.button{display:inline-block;padding:12px 30px;background:linear-gradient(90deg,#667eea 0%,#764ba2 100%);color:#fff;text-decoration:none;border-radius:999px;font-weight:700;box-shadow:0 10px 30px rgba(118,75,162,0.22);transition:transform .15s ease,box-shadow .15s ease}' .
            'a.button:hover{transform:translateY(-4px);box-shadow:0 18px 40px rgba(118,75,162,0.28)}' .
            '.icon{display:inline-flex;margin-bottom:14px;background:linear-gradient(90deg,#ffafbd 0%,#ffc3a0 100%);width:64px;height:64px;border-radius:50%;align-items:center;justify-content:center;box-shadow:0 12px 28px rgba(0,0,0,0.12)}' .
            '.icon svg{width:36px;height:36px;fill:#fff}' .
            '</style></head><body><div class="card"><div class="icon">' .
            '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21 19V5a2 2 0 0 0-2-2H5C3.9 3 3 3.9 3 5v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2zM8.5 13.5l2.5 3L15 11l4 5H5l3.5-2.5z"/></svg>' .
            '</div><h1>Please upload image</h1><p>No preview is available for this complaint\'s image.</p>' .
            '<a class="button" href="' . $backUrl . '">Back to complaint</a></div></body></html>';
        return Yii::$app->response;
    }

    /**
     * Lists all Complaints models.
     * @return mixed
     */
    public function actionIndex()
    {
        UserCounters::checkLastLogin();
        \yii\helpers\Url::remember();
        $searchModel = new ComplaintsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Disable pagination for export requests
        if (Yii::$app->request->get('_export')) {
            $dataProvider->pagination = false;
        }

        $audit = new AuditTrial();
        $audit->items = 'view complaints list';
        // $audit->activity='Login';
        $audit->module = 'Complaints';
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
    }

    public function actionBack()
    {
        return $this->goBack();
    }

    public function actionSms()
    {
        //  UserCounters::checkLastLogin();

        $url = "https://gw.selcommobile.com:8443/bin/send.json?USERNAME=zssf&PASSWORD=zssf&DESTADDR=255766727073&MESSAGE=Test";

        //  $url = 'https://gw.selcommobile.com:8443/bin/send.json?USERNAME=zssf&PASSWORD=zssf&DESTADDR='.$phone_number.'&MESSAGE='.$message;
        $json_response = json_decode(file_get_contents($url));
        $sms_status = $json_response->results[0]->status;
        if ($sms_status == 0) {
            return json_encode($json_response);
        } else {
            return json_encode($json_response);

        }


        // print_r($url);
        //  die;
        //  $url="https://gw.selcommobile.com:8443/bin/send.json?USERNAME=zssf&PASSWORD=zssf&DESTADDR=255766727073&MESSAGE=Test";


//        $curl = curl_init($url);
//        curl_setopt($curl, CURLOPT_POST, true);
//        //curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
//        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
//        // curl_setopt($curl, CURLOPT_POSTFIELDS, $encode);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//
//        if (curl_exec($curl) === FALSE) {
//            die("Curl Failed: " . curl_error($curl));
//        } else {
//
//            return curl_exec($curl);
//        }


        $ch = curl_init(json_encode($url));
# Setup request to send json via POST.
        //$payload = json_encode( array( "customer"=> $data ) );
        // curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
# Send request.
        $result = curl_exec($ch);
        curl_close($ch);

        print_r($result);
        die;


    }

    public function actionTodayComplaints()
    {
        $searchModel = new ComplaintsSearch();
        $dataProvider = $searchModel->searchToday(Yii::$app->request->queryParams);

        $audit = new AuditTrial();
        $audit->items = 'view Today complaints list';
        // $audit->activity='Login';
        $audit->module = 'Complaints';
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
    }


    public function actionPending()
    {
        $searchModel = new ComplaintsSearch();
        $dataProvider = $searchModel->searchPending(Yii::$app->request->queryParams);

        $audit = new AuditTrial();
        $audit->items = 'view Today complaints list';
        // $audit->activity='Login';
        $audit->module = 'Complaints';
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
    }


    public function actionSorted()
    {
        $searchModel = new ComplaintsSearch();
        $dataProvider = $searchModel->searchSorted(Yii::$app->request->queryParams);

        $audit = new AuditTrial();
        $audit->items = 'view Today complaints list';
        // $audit->activity='Login';
        $audit->module = 'Complaints';
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
    }

    /**
     * Displays a single Complaints model.
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
     * Creates a new Complaints model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Complaints();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Complaints model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSort($id)
    {
        $model = $this->findModel($id);
        
        // ✅ SORT WITHOUT COMMENT - response_message EMPTY, response_by SET
        $model->status_type = 'Sorted';
        $model->respond_date = date('Y-m-d H:i:s');
        $model->response_by = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null; // ✅ HII SET (inaonesha kwenye view)
        $model->response_message = ''; // ✅ EMPTY STRING (blank/empty)
        
        $model->save(false);

        $audit = new AuditTrial();
        $audit->items = 'Mark complaints as sorted (without comment)';
        $audit->module = 'Complaints';
        $audit->action = 'sort';
        $audit->new = '';
        $audit->old = '';
        $audit->category = 2;
        $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
        $audit->maker_time = date('Y-m-d H:i:s');
        $audit->save(false);

        Yii::$app->session->setFlash('form_success', Yii::t('yii', 'Complaint marked as sorted successfully'));
        return $this->redirect(['view', 'id' => $model->id]);
    }


    public function actionForward($id)
    {
        $model = $this->findModel($id);
        $category = $_POST['Complaints']['category'];
        
        // ✅ Forwarded complaints should REMAIN with their current status
        $model->category = $category;
        
        // ✅ Clear ALL response fields
        $model->response_message = null;
        $model->response_by = null;
        $model->respond_date = null;
        
        // ✅ Keep status as Pending (not 'Sorted')
        if (empty($model->status_type) || $model->status_type == 'Sorted') {
            $model->status_type = 'Pending';
        }
        
        $model->save(false);

        $audit = new AuditTrial();
        $audit->items = 'Forward user complaints';
        $audit->module = 'Complaints';
        $audit->action = 'forward complaints';
        $audit->new = '';
        $audit->old = '';
        $audit->category = 2;
        $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
        $audit->maker_time = date('Y-m-d H:i:s');
        $audit->save(false);

        Yii::$app->session->setFlash('form_success', Yii::t('yii', 'Complaint forwarded successfully'));
        return $this->redirect(['view', 'id' => $model->id]);
    }


    public function actionRespond($id)
    {
        $post = new Complaints();
        $model = $this->findModel($id);
        $method_array = $_POST['Complaints']['method'];
        $now = date('Y-m-d H:i:s');
        
        $count = count(array_count_values($method_array));
        if ($count == 1) {
            $email = 'email';
            $sms = 'sms';
            if (in_array($email, $method_array)) {
                $method = 'email';
            } elseif (in_array($sms, $method_array)) {
                $method = 'sms';
            }
        } else {
            $method = 'both';
        }

        $member = Members::find()->where(['membership_number' => $model->zssf_number])->one();
        if (!empty($member)) {
            $uid = $member['uid'];
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($method == SignupForm::email) {
                if (!empty($model->email_address)) {
                    try {
                        $sent_from = CommonZssfSettings::findOne(['id' => 1]);
                        $email_from = $sent_from['contact_email'];
                        
                        // ✅ Respond WITH comment
                        $model->response_message = $model->response;
                        $model->response_by = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
                        $model->status_type = 'Sorted';
                        $model->respond_date = $now;
                        $model->save(false);

                        Yii::$app->mailer->compose()
                            ->setFrom($email_from)
                            ->setTo($model->email_address)
                            ->setSubject('Reply to your Complains')
                            ->setTextBody($model->response)
                            ->send();

                        if ($uid != '') {
                            $alert = new Alerts();
                            $alert->created_at = date('Y-m-d H:i:s');
                            $alert->message_type = 'EMAIL';
                            $alert->message = $model->response;
                            $alert->subject = $model->subject;
                            $alert->status = 'Pending';
                            $alert->uid = $uid;
                            $alert->save(false);
                        }
                        Yii::$app->session->setFlash('form_success', Yii::t('yii', 'Response sent successfully'));
                        return $this->redirect(['view', 'id' => $model->id]);
                    } catch (\Exception $e) {
                        // Still save the response even if email fails
                        $model->response_message = $model->response;
                        $model->response_by = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
                        $model->status_type = 'Sorted';
                        $model->respond_date = $now;
                        $model->save(false);
                        
                        Yii::$app->session->setFlash('form_fail', Yii::t('yii', Yii::t('yii', 'Invalid Email address, save successfully but not sent')));
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    Yii::$app->session->setFlash('form_fail', Yii::t('yii', Yii::t('yii', 'No email found in this account, please try another method')));
                    return $this->redirect(['view', 'id' => $model->id]);
                }

            } // SEND TO SMS
            elseif ($method == SignupForm::sms) {
                if (!empty($model->phone_number)) {
                    // ✅ Respond WITH comment
                    $model->response_message = $model->response;
                    $model->response_by = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
                    $model->status_type = 'Sorted';
                    $model->respond_date = $now;
                    $model->save(false);

                    if ($uid != '') {
                        $alert = new Alerts();
                        $alert->created_at = date('Y-m-d H:i:s');
                        $alert->message_type = 'SMS';
                        $alert->message = $model->response;
                        $alert->subject = $model->subject;
                        $alert->status = 'Pending';
                        $alert->uid = $uid;
                        $alert->save(false);

                        $audit = new AuditTrial();
                        $audit->items = 'Respond to user complaints (' . $alert->message . ')';
                        $audit->module = 'Complaints';
                        $audit->action = 'respond';
                        $audit->new = '';
                        $audit->old = '';
                        $audit->category = 2;
                        $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
                        $audit->maker_time = date('Y-m-d H:i:s');
                        $audit->save(false);
                    }

                    Yii::$app->session->setFlash('form_success', Yii::t('yii', 'Response sent successfully'));
                    return $this->redirect(['view', 'id' => $model->id]);

                } else {
                    Yii::$app->session->setFlash('form_fail', Yii::t('yii', Yii::t('yii', 'No phone number found in this account, please try another method')));
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                if (!empty($model->phone_number) || !empty($model->email_address)) {
                    $sent_from = CommonZssfSettings::findOne(['id' => 1]);
                    $email_from = $sent_from['contact_email'];

                    // Send email
                    if (!empty($model->email_address)) {
                        Yii::$app->mailer->compose()
                            ->setFrom($email_from)
                            ->setTo($model->email_address)
                            ->setSubject('Reply to your Complains')
                            ->setTextBody($model->response)
                            ->send();
                    }

                    // ✅ Respond WITH comment
                    $model->response_message = $model->response;
                    $model->response_by = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
                    $model->status_type = 'Sorted';
                    $model->respond_date = $now;
                    $model->save(false);

                    if ($uid != '') {
                        $alert = new Alerts();
                        $alert->created_at = date('Y-m-d H:i:s');
                        $alert->message_type = 'SMS';
                        $alert->message = $model->response;
                        $alert->subject = $model->subject;
                        $alert->status = 'Pending';
                        $alert->uid = $uid;
                        $alert->save(false);

                        $audit = new AuditTrial();
                        $audit->items = 'Respond to user complaints (' . $alert->message . ')';
                        $audit->module = 'Complaints';
                        $audit->action = 'respond';
                        $audit->new = '';
                        $audit->old = '';
                        $audit->category = 2;
                        $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
                        $audit->maker_time = date('Y-m-d H:i:s');
                        $audit->save(false);
                    }

                    Yii::$app->session->setFlash('form_success', Yii::t('yii', 'Response sent successfully'));
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Complaints model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Complaints model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Complaints the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Complaints::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}