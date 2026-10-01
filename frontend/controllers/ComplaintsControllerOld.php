<?php

namespace frontend\controllers;

use backend\models\AuditTrial;
use frontend\models\Members;
use frontend\models\User;
use Yii;
use frontend\models\Complaints;
use frontend\models\ComplaintsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Complaints models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComplaintsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        if (Yii::$app->user->can('')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        else{
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 2000,
                'icon' => 'fa fa-check',
                'message' => 'You do not have permission to update',
                'positonY' => 'top',
                'positonX' => 'right',
            ]);
            return $this->redirect(['/']);
        }
    }

    /**
     * Creates a new Complaints model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionComplaints()
    {

        if (!Yii::$app->user->isGuest) {
            $model = new Complaints();
            $member=Members::find()->where(['uid'=>Yii::$app->user->identity->getId()])->one();
            $model->email_address=Yii::$app->user->identity->email;
            $model->zssf_number=$member['membership_number'];
            $model->phone_number=$member['mobile_number'];


            $audit=new AuditTrial();
            $audit->items='Send Complaints';
            // $audit->activity='Login';
            $audit->module='Complaints';
            $audit->action='send Complaints';
            $audit->new='';
            $audit->category=2;
            //  $user=Members::find()->where(['membership_number'=>Yii::$app->user->identity->getId()])->one();
            $audit->old='';
            $audit->maker=Yii::$app->user->identity->getId();
            $audit->maker_time=date('Y-m-d H:i:s');
            $audit->save(false);

            if ($model->load(Yii::$app->request->post())) {
                $model->date_time=date('Y-m-d H:i:s');
                $model->status_type='Pending';
                $model->save();
                Yii::$app->session->setFlash('success', Yii::t('yii','Thank you for writing your complaints. We will respond to you as soon as possible'));
                return $this->redirect(['complaints/complaints']);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else{
            $model = new Complaints();
            if ($model->load(Yii::$app->request->post())) {
                $model->date_time=date('Y-m-d H:i:s');
                $model->status_type='Pending';
                $model->save();
                Yii::$app->session->setFlash('success', Yii::t('yii','Thank you for writing your complaints. We will respond to you as soon as possible'));
                return $this->redirect(['complaints/create']);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Complaints model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
        else{
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 2000,
                'icon' => 'fa fa-check',
                'message' => 'You do not have permission to update',
                'positonY' => 'top',
                'positonX' => 'right',
            ]);
            return $this->redirect(['/']);
        }
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
        if (Yii::$app->user->can('')){
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
        else{
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 2000,
                'icon' => 'fa fa-check',
                'message' => 'You do not have permission to delete',
                'positonY' => 'top',
                'positonX' => 'right',
            ]);
            return $this->redirect(['/']);
        }

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
