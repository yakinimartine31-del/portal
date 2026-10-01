<?php

namespace frontend\controllers;

use Yii;
use frontend\models\NotificationsSubscription;
use frontend\models\NotificationsSubscriptionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotificationsSubscriptionController implements the CRUD actions for NotificationsSubscription model.
 */
class NotificationsSubscriptionController extends Controller
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

    /**
     * Lists all NotificationsSubscription models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotificationsSubscriptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NotificationsSubscription model.
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
     * Creates a new NotificationsSubscription model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();

        }

        $model = new NotificationsSubscription();

        if ($model->load(Yii::$app->request->post())) {

            $model->uid = Yii::$app->user->identity->getId();
            $model->date_time = date('Y-m-d H:i:s');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionNotify()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();

        }



        $model = new NotificationsSubscription();
        $check = NotificationsSubscription::find()->where(['uid' => Yii::$app->user->identity->getId()])->one();
        $not_type = substr($check->notification_types, 1, -1);
        $not_method = substr($check->notification_method, 1, -1);
        $array = explode(',', $not_type);
        $array_method = explode(',', $not_method);

        $new_contr = $array[0];
        $benefit = $array[1];
        $new_soft = $array[2];
        $new_service = $array[3];

        if ($array_method[0] != '') {
            $email = $array_method[0];
        }

        if (array_key_exists(1, $array)) {
            $sms = $array_method[1];
        }


        if (array_key_exists(0, $array_method)) {
            if (trim($email, '"') == 'Email') {
                $model->email = true;
            }
            if (trim($email, '"') == 'SMS') {
                $model->sms = true;
            }
        }


        if (trim($new_contr, '"') == 1) {
            $model->new_contr = true;
        }
        if (trim($benefit, '"') == 2) {
            $model->benefit = true;
        }
        if (trim($new_soft, '"') == 3) {
            $model->new_soft = true;
        }
        if (trim($new_service, '"') == 4) {
            $model->new_service = true;
        }

        if (array_key_exists(0, $array_method)) {
            if (trim($email, '"') == 'Email') {
                $model->email = true;
            }
            if (trim($email, '"') == 'SMS') {
                $model->sms = true;
            }
        }


        if (array_key_exists(1, $array_method)) {
            if (trim($sms, '"') == 'SMS') {
                $model->sms = true;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->uid = Yii::$app->user->identity->getId();
            $model->date_time = date('Y-m-d H:i:s');

            $email_post = $model->email;
            $sms_post = $model->sms;

            $new_contr_post = $model->new_contr;
            $benefit_post = $model->benefit;
            $new_soft_update = $model->new_soft;
            $new_service_post = $model->new_service;

            if ($email_post == 1 && $sms_post == 1) {
                $post = "[" . '"' . "Email" . '",' . '"' . "SMS" . '",' . '"' . "Both" . '"' . "]";
            } elseif ($email_post == 1 && $sms_post == 0) {
                $post = "[" . '"' . "Email" . '"' . "]";
            } elseif ($email_post == 0 && $sms_post == 1) {
                $post = "[" . '"' . "SMS" . '"' . "]";
            } else {
                $post = '';
            }

            if ($new_contr_post == 1) {
                $new_contr_post = 1;
            } else {
                $new_contr_post = 0;
            }

            if ($benefit_post == 1) {
                $benefit_post = 2;
            } else {
                $benefit_post = 0;
            }

            if ($new_soft_update == 1) {
                $new_soft_update = 3;
            } else {
                $new_soft_update = 0;
            }

            if ($new_service_post == 1) {
                $new_service_post = 4;
            } else {
                $new_service_post = 0;
            }


            if ($new_contr_post == 1 && $benefit_post == 2 && $new_soft_update == 3 && $new_service_post == 4) {
                $post_type = "[" . '"' . "1" . '",' . '"' . "2" . '",' . '"' . "3" . '",' . '"' . "4" . '",' . '"' . "5" . '"' . "]";
            }
            else {
                $post_type = "[" . '"' . "$new_contr_post" . '",' . '"' . "$benefit_post" . '",' . '"' . "$new_soft_update" . '",' . '"' . "$new_service_post" . '",' . '"' . "0" . '"' . "]";
            }

            NotificationsSubscription::updateAll(['notification_method' => $post,'notification_types'=>$post_type,
                'date_time' => date('Y-m-d H:i:s')],
                ['uid' => $model->uid]);

            Yii::$app->session->setFlash('subscription_success', [
                'type' => 'subscription_success',
                'duration' => 5000,
                'icon' => 'fa fa-check',
                'message' => Yii::t('yii', 'Successfully'),
                'positonY' => 'top',
                'positonX' => 'right',
            ]);
            //   print_r($model->notification_method);
            //   exit;
            return $this->redirect(['notify']);
//            if (empty($check)){
//
//                $model->uid=Yii::$app->user->identity->getId();
//                $model->date_time=date('Y-m-d H:i:s');
//                $types= $model->notification_types;
//                $methods= $model->notification_method;
//                $type = implode(',',$types);
//                $method = implode(',',$methods);
//                $type="[1,2,".$type."]";
//                $model->notification_method=$method;
//                $model->notification_types=$type;
//                $model->save();
//                //    Yii::$app->session->setFlash('subscription_success');
//
//                Yii::$app->session->setFlash('subscription_success', [
//                    'type' => 'subscription_success',
//                    'duration' => 5000,
//                    'icon' => 'fa fa-check',
//                    'message' => Yii::t('yii', 'Successfully'),
//                    'positonY' => 'top',
//                    'positonX' => 'right',
//                ]);
//                //   print_r($model->notification_method);
//                //   exit;
//                return $this->redirect(['notify']);
//            }
//            else{
//                $string = substr($check->notification_method, 1, -1);
//                $array = explode(',', $string);
//                $email = $array[0];
//                $sms = $array[1];
//                $both = $array[2];
//               // print_r($both);
//              //  die;
//                $model->uid=Yii::$app->user->identity->getId();
//                $model->date_time=date('Y-m-d H:i:s');
//                $types= $model->notification_types;
//                $methods= $model->notification_method;
//                $type = implode(',',$types);
//                $method = implode(',',$methods);
//                $type="[1,2,".$type."]";
//                $model->notification_method=$method;
//                $model->notification_types=$type;
//
//
//               NotificationsSubscription::updateAll(['notification_method'=>$method,
//                   'notification_types'=>$type,'date_time'=>date('Y-m-d H:i:s')],
//                   ['uid'=>$model->uid]);
//
//
//                Yii::$app->session->setFlash('subscription_success', [
//                    'type' => 'subscription_success',
//                    'duration' => 5000,
//                    'icon' => 'fa fa-check',
//                    'message' => Yii::t('yii', 'Successfully'),
//                    'positonY' => 'top',
//                    'positonX' => 'right',
//                ]);
//                //   print_r($model->notification_method);
//                //   exit;
//                return $this->redirect(['notify']);
//            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NotificationsSubscription model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();

        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NotificationsSubscription model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    /**
     * Finds the NotificationsSubscription model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NotificationsSubscription the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NotificationsSubscription::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
