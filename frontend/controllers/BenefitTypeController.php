<?php

namespace frontend\controllers;

use backend\models\AuditTrial;
use frontend\models\Calculator;
use frontend\models\ComplaintsForm;
use frontend\models\Members;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\User;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\bootstrap\ActiveForm;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class BenefitTypeController extends Controller
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
     * {@inheritdoc}
     */



    public function actionBenefit()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $audit=new AuditTrial();
        $audit->items='Benefit Type';
        // $audit->activity='Login';
        $audit->module='Benefit';
        $audit->action='view Benefit Type';
        $audit->new='';
        $audit->category=2;
        //  $user=Members::find()->where(['membership_number'=>Yii::$app->user->identity->getId()])->one();
        $audit->old='';
        $audit->maker=Yii::$app->user->identity->getId();
        $audit->maker_time=date('Y-m-d H:i:s');
        $audit->save(false);

        return $this->render('benefit', [
            'model' => $model,
        ]);
    }

    public function actionOldAge()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('old_age', [
            'model' => $model,
        ]);
    }

    public function actionMaternity()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('maternity', [
            'model' => $model,
        ]);
    }

    public function actionInvalidity()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('invalidity', [
            'model' => $model,
        ]);
    }

    public function actionStartUp()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('start', [
            'model' => $model,
        ]);
    }

    public function actionSurvivor()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('survivor', [
            'model' => $model,
        ]);
    }

    public function actionEducationLoan()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('education', [
            'model' => $model,
        ]);
    }

    public function actionPensioner()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('pensioner', [
            'model' => $model,
        ]);
    }

}
