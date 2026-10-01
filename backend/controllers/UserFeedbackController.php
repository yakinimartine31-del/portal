<?php

namespace backend\controllers;

use backend\models\AuditTrial;
use backend\models\UserCounters;
use Yii;
use backend\models\UserFeedback;
use backend\models\UserFeedbackSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserFeedbackController implements the CRUD actions for UserFeedback model.
 */
class UserFeedbackController extends Controller
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
     * Lists all UserFeedback models.
     * @return mixed
     */
    public function actionIndex()
    {

        $audit=new AuditTrial();
        $audit->items='view User Feedback list';
        // $audit->activity='Login';
        $audit->module='Contact Us';
        $audit->action='view';
        $audit->new='';
        $audit->old='';
        $audit->category = 2;
        $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
        $audit->maker_time=date('Y-m-d H:i:s');
        $audit->save(false);
        UserCounters::checkLastLogin();
        $searchModel = new UserFeedbackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTodayContact()
    {

        $audit=new AuditTrial();
        $audit->items='view Today User Feedback list';
        // $audit->activity='Login';
        $audit->module='Contact Us';
        $audit->action='view';
        $audit->new='';
        $audit->old='';
        $audit->category = 2;
        $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
        $audit->maker_time=date('Y-m-d H:i:s');
        $audit->save(false);

        $searchModel = new UserFeedbackSearch();
        $dataProvider = $searchModel->searchToday(Yii::$app->request->queryParams);



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserFeedback model.
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
     * Creates a new UserFeedback model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserFeedback();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserFeedback model.
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
     * Deletes an existing UserFeedback model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('deleteContactUs')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
        else{
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to delete'));
            return $this->redirect(['/']);
        }
    }

    /**
     * Finds the UserFeedback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserFeedback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserFeedback::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
