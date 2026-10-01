<?php

namespace backend\controllers;

use backend\models\AuditTrial;
use Yii;
use backend\models\SmsLogs;
use backend\models\SmsLogsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SmsLogsController implements the CRUD actions for SmsLogs model.
 */
class SmsLogsController extends Controller
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
     * Lists all SmsLogs models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('viewLogs')) {
            $searchModel = new SmsLogsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $audit = new AuditTrial();
            $audit->items = 'view SMS Logs';
            // $audit->activity='Login';
            $audit->module = 'SMS LOGS';
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
        else{
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to view'));
            return $this->redirect(['/']);
        }
    }


    public function actionPhp(){
      return  phpinfo();

    }

    /**
     * Displays a single SmsLogs model.
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
     * Creates a new SmsLogs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionBulkVerification()
    {
        $model = new SmsLogs();

        if ($model->load(Yii::$app->request->post()) ) {

            $send_date=$model->date_time;
            print_r($send_date);die;

            $url = 'https://mobile.zssf.or.tz/api2/public/index.php/pensioner-bulk-verification';
            $data_json = json_encode(["send_date" => "$send_date"]);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            $model->save();

        }

        return $this->render('create-bulk-verification', [
            'model' => $model,
        ]);




    }

    /**
     * Updates an existing SmsLogs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

    }

    /**
     * Deletes an existing SmsLogs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      //  $this->findModel($id)->delete();

     //   return $this->redirect(['index']);
    }

    /**
     * Finds the SmsLogs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SmsLogs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SmsLogs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
