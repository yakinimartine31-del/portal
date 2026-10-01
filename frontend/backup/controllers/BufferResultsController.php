<?php

namespace frontend\controllers;

use backend\models\AuditTrial;
use Yii;
use frontend\models\BufferResults;
use frontend\models\BufferResultsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BufferResultsController implements the CRUD actions for BufferResults model.
 */
class BufferResultsController extends Controller
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
     * Lists all BufferResults models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BufferResultsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $audit=new AuditTrial();
        $audit->items='Benefit';
        // $audit->activity='Login';
        $audit->module='Benefit';
        $audit->action='view Test Benefit';
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

    public function actionResults()
    {
        $searchModel = new BufferResultsSearch();
        $dataProvider = $searchModel->searchResults(Yii::$app->request->queryParams);

        return $this->render('index_results', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProjectResults()
    {
        $searchModel = new BufferResultsSearch();
        $dataProvider = $searchModel->searchResults(Yii::$app->request->queryParams);

        return $this->render('index_projection', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProjection()
    {
        $searchModel = new BufferResultsSearch();
        $dataProvider = $searchModel->searchResults(Yii::$app->request->queryParams);

        return $this->render('projections', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProject()
    {
        $searchModel = new BufferResultsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $audit=new AuditTrial();
        $audit->items='Projection';
        // $audit->activity='Login';
        $audit->module='Projection';
        $audit->action='view Projection';
        $audit->new='';
        //  $user=Members::find()->where(['membership_number'=>Yii::$app->user->identity->getId()])->one();
        $audit->old='';
        $audit->maker=Yii::$app->user->identity->getId();
        $audit->maker_time=date('Y-m-d H:i:s');
        $audit->save(false);

        return $this->render('index_projection', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BufferResults model.
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
     * Creates a new BufferResults model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BufferResults();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BufferResults model.
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
     * Deletes an existing BufferResults model.
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
     * Finds the BufferResults model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BufferResults the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BufferResults::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
