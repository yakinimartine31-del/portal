<?php

namespace frontend\controllers;

use backend\models\AuditTrial;
use frontend\models\Members;
use Yii;
use frontend\models\Contributions;
use frontend\models\ContributionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContributionsController implements the CRUD actions for Contributions model.
 */
class ContributionsController extends Controller
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
     * Lists all Contributions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContributionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $audit=new AuditTrial();
        $audit->items='View Contribution in member portal';
        // $audit->activity='Login';
        $audit->module='Contribution';
        $audit->action='list view';
        $audit->new='';
        //  $user=User::find()->where(['id'=>Yii::$app->user->identity->getId()])->one();
        $audit->old='';
        $audit->maker=Yii::$app->user->identity->getId();
        $audit->maker_time=date('Y-m-d H:i:s');
        $audit->save(false);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView()
    {
        $searchModel = new ContributionsSearch();
        $dataProvider = $searchModel->searchLast(Yii::$app->request->queryParams);


        $audit=new AuditTrial();
        $audit->items='View Contribution in member portal';
        // $audit->activity='Login';
        $audit->module='Contribution';
        $audit->action='view';
        $audit->new='';
        //  $user=User::find()->where(['id'=>Yii::$app->user->identity->getId()])->one();
        $audit->old='';
        $audit->maker=Yii::$app->user->identity->getId();
        $audit->maker_time=date('Y-m-d H:i:s');
        $audit->save(false);
        return $this->render('last', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMemberStatement()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        $searchModel = new ContributionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contributions model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView1()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model=new Contributions();
        $member = Members::findOne(['uid' => \Yii::$app->user->identity->getId()]);
        $member = Contributions::findOne(['member_number' => $member['membership_number']]);
        if ($member['id'])
        {
            $id = $member['id'];
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        else{
            Yii::$app->session->setFlash('contribution_fail', Yii::t('yii', 'No report found'));
            return $this->render('not_found', [
                'model' => $model,
            ]);

        }


    }

    /**
     * Creates a new Contributions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contributions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Contributions model.
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
     * Deletes an existing Contributions model.
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
     * Finds the Contributions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contributions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contributions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
