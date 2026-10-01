<?php

namespace backend\controllers;

use backend\models\AuditTrial;
use backend\models\UserCounters;
use frontend\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

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
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'demo'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
        ];
    }



    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        
    
        UserCounters::checkLastLogin();

       // $url="https://gw.selcommobile.com:8443/bin/send.json?USERNAME=zssf&PASSWORD=zssf&DESTADDR=255766727073&MESSAGE=Test";
//        $url="https://gw.selcommobile.com:8443/bin/send.json?USERNAME=zssf&PASSWORD=zssf&DESTADDR=255766727073&MESSAGE=Test";
//
//        $curl = curl_init($url);
//        curl_setopt($curl, CURLOPT_POST, true);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
//       // curl_setopt($curl, CURLOPT_POSTFIELDS, $encode);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//
//        if (curl_exec($curl) === FALSE) {
//            die("Curl Failed: " . curl_error($curl));
//        } else {
//
//            return curl_exec($curl);
//        }





        return $this->render('index');
    }





    private function file_get_contents_curl($message, $phone_number)
    {
        $msg = urlencode($message);
        //  $url = "http://api.infobip.com/api/v3/sendsms/plain?user=EFDWEB&password=Web@2019&sender=EFDWEB&SMSText=$msg&GSM=$phone_number";

        $url="https://gw.selcommobile.com:8443/bin/send.json?USERNAME=ZSSF&PASSWORD=ZSSF&DESTADDR=255766727073&MESSAGE=Test";

        curl_setopt($ch = curl_init(), CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;

    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            if (\Yii::$app->user->identity->staff_login == '1') {
                User::updateAll(['lastvisitDate' => date('Y-m-d H:i:s')],['id'=>Yii::$app->user->identity->getId()]);

                $audit=new AuditTrial();
                $audit->items='Login to staff panel';
               // $audit->activity='Login';
                $audit->module='Site login';
                $audit->action='Site login';
                $audit->new='new login ('.date('Y-m-d H:i:s').')';

                $user=User::find()->where(['id'=>Yii::$app->user->identity->getId()])->one();
                $audit->old='last login ('.$user['lastvisitDate'].')';
                $audit->maker=Yii::$app->user->identity->getId();
                $audit->maker_time=date('Y-m-d H:i:s');
                $audit->save(false);
                return $this->goBack();
            }
            else {
                Yii::$app->user->logout();

                Yii::$app->session->setFlash('failure', "You do not have permission to log in admin panel");

                //redirect again page to login form.
                return $this->redirect(['site/login']);
            }


        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
