<?php

namespace backend\controllers;

use backend\models\AuditTrial;
use Yii;
use backend\models\Articles;
use backend\models\ArticlesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * ArticlesController implements the CRUD actions for Articles model.
 */
class ArticlesController extends Controller
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
     * Lists all Articles models.
     * @return mixed
     */
    public function actionIndex()
    {
        // Temporarily disabled permission check for development
        // if (Yii::$app->user->can('viewArticles')) {
            $searchModel = new ArticlesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $audit = new AuditTrial();
            $audit->items = 'view News and Events list';
            // $audit->activity='Login';
            $audit->module = 'News and Events';
            $audit->action = 'view';
            $audit->category = 2;
            $audit->new = '';
            $audit->old = '';
            $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
            $audit->maker_time = date('Y-m-d H:i:s');
            $audit->save(false);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        // }
        // else{
        //     Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to view articles'));
        //     return $this->redirect(['/']);
        // }
    }

    /**
     * Displays a single Articles model.
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
     * Creates a new Articles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // Temporarily disabled permission check for development
        // if (Yii::$app->user->can('viewArticles')) {
        $model = new Articles();

        if ($model->load(Yii::$app->request->post())) {

            $model->date_time = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file) {

                $model->file = UploadedFile::getInstance($model, 'file');
                $model->file->saveAs('../../api/' . '/images/news/' . date('YmdHi') . '.' . $model->file->extension);
                $model->intro_image = '/images/news/' . date('YmdHi') . '.' . $model->file->extension;
                //  $attach->save('false');
            }
            $model->save();

            $audit = new AuditTrial();
            $audit->items = 'create News and Events';
            // $audit->activity='Login';
            $audit->module = 'News and Events';
            $audit->action = 'create';
            $audit->new = $model->title;
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
        // }
        // else{
        //     Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to create new article'));
        //     return $this->redirect(['/']);
        // }
    }

    /**
     * Updates an existing Articles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // Temporarily disabled permission check for development
        // if (Yii::$app->user->can('viewArticles')) {
            $model = $this->findModel($id);

            $model->date_time = date('Y-m-d H:i:s');
            if ($model->load(Yii::$app->request->post())) {

                $model->date_time = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
                $model->file = UploadedFile::getInstance($model, 'file');
                //   $model->category_id=34;

                if ($model->file) {

                    $model->file = UploadedFile::getInstance($model, 'file');
                    $model->file->saveAs('../../api/' . '/images/news/' . date('YmdHi') . '.' . $model->file->extension);
                    $model->intro_image = '/images/news/' . date('YmdHi') . '.' . $model->file->extension;
                    //  $attach->save('false');
                }
                $model->save();

                $audit = new AuditTrial();
                $audit->items = 'update News and Events';
                // $audit->activity='Login';
                $audit->module = 'News and Events';
                $audit->action = 'update';
                $audit->category = 2;
                $audit->new = $model->title;
                $audit->old = $model->title;
                $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
                $audit->maker_time = date('Y-m-d H:i:s');
                $audit->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        // }
        // else{
        //     Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to update'));
        //     return $this->redirect(['/']);
        // }
    }

    /**
     * Deletes an existing Articles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */


    /**
     * Finds the Articles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Articles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
