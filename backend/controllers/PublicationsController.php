<?php

namespace backend\controllers;

use backend\models\AuditTrial;
use Yii;
use backend\models\Publications;
use backend\models\PublicationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PublicationsController implements the CRUD actions for Publications model.
 */
class PublicationsController extends Controller
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
     * Lists all Publications models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PublicationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $audit=new AuditTrial();
        $audit->items='view Publication List';
        // $audit->activity='Login';
        $audit->module='Publication';
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
     * Displays a single Publications model.
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
     * Creates a new Publications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publications();

        $model->date_time=date('Y-m-d H:i:s');
        $model->publication_date=date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $audit=new AuditTrial();
            $audit->items='create Publication';
            // $audit->activity='Login';
            $audit->module='Publication';
            $audit->action='create';
            $audit->new=$model->title;
            $audit->old='';
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
     * Updates an existing Publications model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $audit=new AuditTrial();
            $audit->items='Update Publication';
            // $audit->activity='Login';
            $audit->module='Publication';
            $audit->action='update';
            $audit->new='';
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
     * Deletes an existing Publications model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      //  $this->findModel($id)->delete();

      //  return $this->redirect(['index']);
    }

    /**
     * Finds the Publications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Publications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publications::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
