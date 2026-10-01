<?php

namespace backend\controllers;

use backend\models\AuditTrial;
use Yii;
use backend\models\ComplaintsCategories;
use backend\models\ComplaintsCategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ComplaintsCategoriesController implements the CRUD actions for ComplaintsCategories model.
 */
class ComplaintsCategoriesController extends Controller
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
     * Lists all ComplaintsCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('viewSetting')) {
            $searchModel = new ComplaintsCategoriesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


            $audit = new AuditTrial();
            $audit->items = 'view complaints categories';
            // $audit->activity='Login';
            $audit->module = 'Complaints Category';
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

    /**
     * Displays a single ComplaintsCategories model.
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
     * Creates a new ComplaintsCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('newComplaintCategory')) {
            $model = new ComplaintsCategories();

            $model->date_time = date('Y-m-d H:i:s');
            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                $audit = new AuditTrial();
                $audit->items = 'create complaints list';
                // $audit->activity='Login';
                $audit->module = 'Complaints category';
                $audit->action = 'create';
                $audit->new = '';
                $audit->old = '';
                $audit->category = 2;
                $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
                $audit->maker_time = date('Y-m-d H:i:s');
                $audit->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else{
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to create'));
            return $this->redirect(['/']);
        }
    }

    /**
     * Updates an existing ComplaintsCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->date_time=date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $audit=new AuditTrial();
            $audit->items='update complaints category';
            // $audit->activity='Login';
            $audit->module='Complaints category';
            $audit->action='update';
            $audit->new=$model->category_name;
            $audit->old='';
            $audit->category = 2;
            $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
            $audit->maker_time=date('Y-m-d H:i:s');
            $audit->save(false);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ComplaintsCategories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */


    /**
     * Finds the ComplaintsCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ComplaintsCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComplaintsCategories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
