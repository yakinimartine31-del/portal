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
        $model = new NotificationsSubscription();

        if ($model->load(Yii::$app->request->post()) ) {

            $model->uid=Yii::$app->user->identity->getId();
            $model->date_time=date('Y-m-d H:i:s');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionNotify()
    {
        $model = new NotificationsSubscription();

      //  $model->notification_default = true;
        if ($model->load(Yii::$app->request->post())) {
            $check=NotificationsSubscription::find()->where(['uid'=>Yii::$app->user->identity->getId()])->one();
            if (empty($check)){
                $model->uid=Yii::$app->user->identity->getId();
                $model->date_time=date('Y-m-d H:i:s');
                $types= $model->notification_types;
                $methods= $model->notification_method;
                $type = implode(',',$types);
                $method = implode(',',$methods);
                $type="[1,2,".$type."]";
                $model->notification_method=$method;
                $model->notification_types=$type;
                $model->save();
                //    Yii::$app->session->setFlash('subscription_success');

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
            }
            else{
                $model->uid=Yii::$app->user->identity->getId();
                $model->date_time=date('Y-m-d H:i:s');
                $types= $model->notification_types;
                $methods= $model->notification_method;
                $type = implode(',',$types);
                $method = implode(',',$methods);
                $type="[1,2,".$type."]";
                $model->notification_method=$method;
                $model->notification_types=$type;
               NotificationsSubscription::updateAll(['notification_method'=>$method,
                   'notification_types'=>$type,'date_time'=>date('Y-m-d H:i:s')],
                   ['uid'=>$model->uid]);


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
            }

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
