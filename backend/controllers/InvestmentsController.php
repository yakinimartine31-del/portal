<?php

namespace backend\controllers;

use backend\models\AuditTrial;
use Yii;
use backend\models\Investments;
use backend\models\InvestmentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * InvestmentsController implements the CRUD actions for Investments model.
 */
class InvestmentsController extends Controller
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
     * Lists all Investments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvestmentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $audit=new AuditTrial();
        $audit->items='view investment list';
        // $audit->activity='Login';
        $audit->module='Investment';
        $audit->action='view';
        $audit->new='';
        $audit->old='';
        $audit->category = 2;
        $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
        $audit->maker_time=date('Y-m-d H:i:s');
        $audit->save(false);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Investments model.
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
     * Creates a new Investments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Investments();

        if ($model->load(Yii::$app->request->post())) {
            $model->photo = UploadedFile::getInstance($model, 'photo');
            $model->date_time=date('Y-m-d H:i:s');
            if ($model->photo) {
                $model->photo = UploadedFile::getInstance($model, 'photo');
                $model->photo->saveAs('../../api/' .'INVESTMENT'. date('YmdHi') . '.' . $model->photo->extension);
                $model->image = 'NEWS'  . date('YmdHi') . '.' . $model->photo->extension;
                //  $attach->save('false');
            }
            $model->save(false);


            $audit=new AuditTrial();
            $audit->items='create new investment';
            // $audit->activity='Login';
            $audit->module='Investment';
            $audit->action='create';
            $audit->new=$model->title;
            $audit->old='';
            $audit->category = 2;
            $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
            $audit->maker_time=date('Y-m-d H:i:s');
            $audit->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Investments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->photo = UploadedFile::getInstance($model, 'photo');
            $model->date_time=date('Y-m-d H:i:s');
            if ($model->photo) {

                $model->photo = UploadedFile::getInstance($model, 'photo');
                $model->photo->saveAs('../../api/' .'INVESTMENT'. date('YmdHi') . '.' . $model->photo->extension);
                $model->image = 'INVESTMENT'  . date('YmdHi') . '.' . $model->photo->extension;
                //  $attach->save('false');
            }
            $model->save(false);


            $audit=new AuditTrial();
            $audit->items='update investment';
            // $audit->activity='Login';
            $audit->module='Investment';
            $audit->action='update';
            $audit->new='';
            $audit->category = 2;
            $audit->old=$model->title;
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
     * Deletes an existing Investments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    /**
     * Finds the Investments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Investments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Investments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
