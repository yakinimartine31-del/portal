<?php

namespace frontend\controllers;

use backend\models\AuditTrial;
use frontend\models\Members;
use Yii;
use frontend\models\Complaints;
use frontend\models\ComplaintsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
        $audit=new AuditTrial();
        $audit->items='Complaints List';
        // $audit->activity='Login';
        $audit->module='Complaints';
        $audit->action='view Complaints List';
        $audit->new='';
        //  $user=Members::find()->where(['membership_number'=>Yii::$app->user->identity->getId()])->one();
        $audit->old='';
        $audit->maker=Yii::$app->user->identity->getId();
        $audit->maker_time=date('Y-m-d H:i:s');
        $audit->save(false);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionList()
    {
        $searchModel = new ComplaintsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $audit=new AuditTrial();
        $audit->items='Complaints List';
        // $audit->activity='Login';
        $audit->module='Complaints';
        $audit->action='view Complaints List';
        $audit->new='';
        //  $user=Members::find()->where(['membership_number'=>Yii::$app->user->identity->getId()])->one();
        $audit->old='';
        $audit->maker=Yii::$app->user->identity->getId();
        $audit->maker_time=date('Y-m-d H:i:s');
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
    public function actionComplaints()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new Complaints();
            $member=Members::find()->where(['uid'=>Yii::$app->user->identity->getId()])->one();

            $model->email_address=Yii::$app->user->identity->email;
            $model->zssf_number=$member['membership_number'];
            $model->phone_number=$member['mobile_number'];
            $model->date_time=date('Y-m-d H:i:s');
            $model->status_type='Pending';

            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file) {

                $model->file = UploadedFile::getInstance($model, 'file');
                $model->file->saveAs('../api/' .'/images/complaints/'.$model->zssf_number. date('YmdHi') . '.' . $model->file->extension);
                $model->photo_file = '/images/complaints/' .$model->zssf_number . date('YmdHi') . '.' . $model->file->extension;
                //  $attach->save('false');
            }

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                Yii::$app->session->setFlash('success', Yii::t('yii','Thank you for writing your complaints. We will respond to you as soon as possible'));
                return $this->redirect(['complaints/complaints']);

            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
        $model = new Complaints();
        $model->date_time=date('Y-m-d H:i:s');
        $model->status_type='Pending';

        $model->file = UploadedFile::getInstance($model, 'file');

        if ($model->file) {

            $model->file = UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('../api/' .'/images/complaints/'.$model->zssf_number. date('YmdHi') . '.' . $model->file->extension);
            $model->photo_file = '/images/complaints/' .$model->zssf_number . date('YmdHi') . '.' . $model->file->extension;
            //  $attach->save('false');
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('yii','Thank you for writing your complaints. We will respond to you as soon as possible'));
            return $this->redirect(['complaints/complaints']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionComplaints1()
    {

        if (!Yii::$app->user->isGuest) {
            $model = new Complaints();
            $member=Members::find()->where(['uid'=>Yii::$app->user->identity->getId()])->one();

            $model->email_address=Yii::$app->user->identity->email;
            $model->zssf_number=$member['membership_number'];
            $model->phone_number=$member['mobile_number'];

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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
