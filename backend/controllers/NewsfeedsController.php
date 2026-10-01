<?php

namespace backend\controllers;

use Yii;
use backend\models\Newsfeeds;
use backend\models\NewsfeedsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * NewsfeedsController implements the CRUD actions for Newsfeeds model.
 */
class NewsfeedsController extends Controller
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
     * Lists all Newsfeeds models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsfeedsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Newsfeeds model.
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
     * Creates a new Newsfeeds model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Newsfeeds();

        if ($model->load(Yii::$app->request->post())) {

            $model->created_by = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
            $model->created=date('Y-m-d H:i:s');
            $model->publish_up=date('Y-m-d H:i:s');
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file) {

                $model->file = UploadedFile::getInstance($model, 'file');
                $model->file->saveAs('../news/' .'/images/news/'. date('YmdHi') . '.' . $model->file->extension);
                $model->images = '/images/news/'  . date('YmdHi') . '.' . $model->file->extension;
                //  $attach->save('false');
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Newsfeeds model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file) {

                $model->file = UploadedFile::getInstance($model, 'file');
                $model->file->saveAs('../api/' .'/images/news/'. date('YmdHi') . '.' . $model->file->extension);
                $model->images = '/images/news/'  . date('YmdHi') . '.' . $model->file->extension;
                //  $attach->save('false');
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Newsfeeds model.
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
     * Finds the Newsfeeds model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Newsfeeds the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Newsfeeds::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
