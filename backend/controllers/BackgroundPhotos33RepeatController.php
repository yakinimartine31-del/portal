<?php

namespace backend\controllers;

use backend\models\AuditTrial;
use Yii;
use backend\models\BackgroundPhotos33Repeat;
use backend\models\BackgroundPhotos33RepeatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * BackgroundPhotos33RepeatController implements the CRUD actions for BackgroundPhotos33Repeat model.
 */
class BackgroundPhotos33RepeatController extends Controller
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
     * Lists all BackgroundPhotos33Repeat models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $phone_number='255655747073';
//        $message='test';
//        $url = 'https://gw.selcommobile.com:8443/bin/send.json?USERNAME=zssf&PASSWORD=9LxWuiWNuc&DESTADDR=' . '255655747073' . '&MESSAGE=' . 'test';
//        $json_response = json_decode(file_get_contents($url));
//
//        //$json_response->results[0]
//        $sms_status = $json_response->results[0]->status;
//
//        print_r($sms_status);die;
        if (Yii::$app->user->can('viewSetting')) {
            $searchModel = new BackgroundPhotos33RepeatSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $audit = new AuditTrial();
            $audit->items = 'view images setting';
            // $audit->activity='Login';
            $audit->module = 'Image Settings';
            $audit->action = 'view';
            $audit->new = '';
            $audit->category = 2;
            $audit->old = '';
            $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
            $audit->maker_time = date('Y-m-d H:i:s');
            $audit->save(false);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to view'));
            return $this->redirect(['/']);
        }
    }

    /**
     * Displays a single BackgroundPhotos33Repeat model.
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
     * Creates a new BackgroundPhotos33Repeat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

    }

    /**
     * Updates an existing BackgroundPhotos33Repeat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('updateBackgroundPhoto')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                $model->picha = UploadedFile::getInstance($model, 'picha');
                $model->picha_image = UploadedFile::getInstance($model, 'picha');
                $name = $model->slide_name;
                $path = '../images/slides/';
                $file = $model->slide_name . '.png';

                $file_path = $path . $file;


                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                $model->picha_image = UploadedFile::getInstance($model, 'picha');
                $model->picha_image->saveAs('../images/slides/' . $name . '.' . $model->picha_image->extension);

                try {

                    if ($model->picha) {

                        $model->picha = UploadedFile::getInstance($model, 'picha');


                        $model->picha->saveAs('../../api/' . '/images/slides/' . $model->slide_name . '.' . $model->picha->extension);

                        $model->image = '/images/slides/' . $model->slide_name . '.' . $model->picha->extension;

                    }

                    $model->save(false);
                    $audit = new AuditTrial();
                    $audit->items = 'update images setting';// $audit->activity='Login';
                    $audit->module = 'Image Settings';
                    $audit->action = 'update';
                    $audit->new = $model->slide_name;
                    $audit->old = '';
                    $audit->category = 2;
                    $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
                    $audit->maker_time = date('Y-m-d H:i:s');
                    $audit->save(false);
                } catch (\Exception $e) {
                }

                return $this->redirect(['index']);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to update'));
            return $this->redirect(['/']);
        }
    }

    /**
     * Deletes an existing BackgroundPhotos33Repeat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //  $this->findModel($id)->delete();

        //   return $this->redirect(['index']);
    }

    /**
     * Finds the BackgroundPhotos33Repeat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BackgroundPhotos33Repeat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BackgroundPhotos33Repeat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
