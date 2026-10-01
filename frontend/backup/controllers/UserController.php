<?php

namespace frontend\controllers;

use backend\models\AuditTrial;
use frontend\models\Members;
use Yii;
use frontend\models\User;
use frontend\models\UserSearch;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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

    public function actionProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();

        }
        $user_id=User::find()->where(['id'=>Yii::$app->user->identity->id])->one();

        $audit=new AuditTrial();
        $audit->items='View Member profile to member portal';
        // $audit->activity='Login';
        $audit->module='Profile';
        $audit->action='view';
        $audit->new='';
      //  $user=User::find()->where(['id'=>Yii::$app->user->identity->getId()])->one();
        $audit->old='';
        $audit->maker=Yii::$app->user->identity->getId();
        $audit->maker_time=date('Y-m-d H:i:s');
        $audit->save(false);

        return $this->render('profile', [
            'model' => $this->findModel($user_id['id']),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model->username;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $member=$this->findMember($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
       // $member_data=Members::find()->where(['uid'=>Yii::$app->user->identity->getId()])->one();
       // $phone=$member_data['mobile_number'];
      //  $member->mobile_number=$phone;


        if ($model->load(Yii::$app->request->post()) && $member->load(Yii::$app->request->post())) {

            if ($model->password_new !=''){



                $model->setPassword($model->password_new);
                $model->generateAuthKey();
                $model->generateEmailVerificationToken();
                $password=User::find()->where(['id'=>Yii::$app->user->identity->getId()])->one();
                $password=$password['password'];

                $validateOldPass = Yii::$app->security->validatePassword($model->oldpass,$password);


                if($validateOldPass)
                {
                    if ($model->save(false)){
                        Members::updateAll(['mobile_number'=>$member->mobile_number,'username'=>$model->username,'email'=>$model->email],['uid'=>$model->id]);
                    }

                    return $this->redirect(['profile', 'id' => $model->id]);
                }
                else{

                    Yii::$app->session->setFlash('oldpass_fail', Yii::t('yii', 'old password is Incorrect'));
                    return $this->render('update', [
                        'model' => $model,
                        'member' => $member,
                    ]);
                }
            }
            else{


                $password=User::find()->where(['id'=>Yii::$app->user->identity->getId()])->one();
                $password=$password['password'];
                $validateOldPass = Yii::$app->security->validatePassword($model->oldpass,$password);

                if($validateOldPass)
                {
                    if ($model->save(false)){
                        Members::updateAll(['mobile_number'=>$member->mobile_number,'username'=>$model->username,'email'=>$model->email],['uid'=>$model->id]);
                    }

                    return $this->redirect(['profile', 'id' => $model->id]);
                }
                else{

                    Yii::$app->session->setFlash('oldpass_fail', Yii::t('yii', 'old password is Incorrect'));
                    return $this->render('update', [
                        'model' => $model,
                        'member' => $member,
                    ]);
                }
            }



        }

        return $this->render('update', [
            'model' => $model,
            'member' => $member,
        ]);
    }





    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */


    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findMember($id)
    {
        if (($model = Members::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionVery($data)
    {
        $otp = new User();
        $dataProvider=User::find()->where(['OTP'=>$data])->one();

        $dataProvider=$_POST['OTP'];
        Yii::$app->session->setFlash('otp_success', Yii::t('yii', "valid $dataProvider"));
        return $this->redirect(['site/signup']);

    }



}

