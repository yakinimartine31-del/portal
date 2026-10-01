<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Articles;
use frontend\models\ArticlesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
    public function actionNews()
    {
        $searchModel = new ArticlesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBoards()
    {
        $id=Articles::find()->select('id')->where(['id'=>36])->one();
        return $this->render('board', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionStructure()
    {
        $id=Articles::find()->select('id')->where(['id'=>6])->one();
        return $this->render('structure', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionManagement()
    {
        $id=Articles::find()->select('id')->where(['id'=>5])->one();
        return $this->render('management', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAbout()
    {
        $id=Articles::find()->select('id')->where(['id'=>20])->one();
        return $this->render('overview', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionRegulations()
    {
        $id=Articles::find()->select('id')->where(['id'=>19])->one();
        return $this->render('regulations', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionValues()
    {
        $id=Articles::find()->select('id')->where(['id'=>7])->one();
        return $this->render('core', [
            'model' => $this->findModel($id),
        ]);
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
        $model = new Articles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
