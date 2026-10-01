<?php

namespace frontend\controllers;

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
class SchemeController extends Controller
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



    public function actionMandatoryScheme()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('mandatory_scheme', [
            'model' => $model,
        ]);
    }

    public function actionMandatorySchemeIntroduction()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('mandatory_introduction', [
            'model' => $model,
        ]);
    }

    public function actionMandatorySchemeRegistration()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('mandatory_registration', [
            'model' => $model,
        ]);
    }

    public function actionMandatorySchemeBenefit()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('mandatory_benefit', [
            'model' => $model,
        ]);
    }

    public function actionMandatorySchemeMembership()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('mandatory_membership', [
            'model' => $model,
        ]);
    }

    public function actionMandatorySchemeEmployee()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('mandatory_employee', [
            'model' => $model,
        ]);
    }

    public function actionMandatorySchemeEmployer()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('mandatory_employer', [
            'model' => $model,
        ]);
    }

    public function actionVoluntaryScheme()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('voluntary_scheme', [
            'model' => $model,
        ]);
    }

    public function actionVoluntarySchemeIntroduction()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('voluntary_introduction', [
            'model' => $model,
        ]);
    }
    public function actionVoluntarySchemeRegistration()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('voluntary_registration', [
            'model' => $model,
        ]);
    }

    public function actionVoluntarySchemeBenefit()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('voluntary_benefit', [
            'model' => $model,
        ]);
    }

    public function actionVoluntarySchemeMembership()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('voluntary_membership', [
            'model' => $model,
        ]);
    }

    public function actionVoluntarySchemeEmployee()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('voluntary_employee', [
            'model' => $model,
        ]);
    }

    public function actionVoluntarySchemeEmployer()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('voluntary_employer', [
            'model' => $model,
        ]);
    }

}
