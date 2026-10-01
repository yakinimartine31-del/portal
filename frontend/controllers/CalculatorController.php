<?php

namespace frontend\controllers;

use frontend\models\Calculator;
use frontend\models\ComplaintsForm;
use frontend\models\Members;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\User;
use frontend\models\VerifyEmailForm;
use kartik\dialog\Dialog;
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
use yii\web\JsExpression;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class CalculatorController extends Controller
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



    public function actionContributionCalculator()
    {

        $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            $employee=(13/100) * $model->amount;
            $employer=(7/100) * $model->amount;

            Yii::$app->session->set('employee',$employee);
            Yii::$app->session->set('employer',$employer);
            Yii::$app->session->setFlash('success_contribution');
//            Yii::$app->getSession()->setFlash('success', [
//                'text' => 'My custom text',
//                'title' => 'My custom title',
//                'type' => 'success',
//                'timer' => 3000,
//                'showConfirmButton' => false
//            ]);
            return $this->redirect(['contribution-calculator']);

        }

        return $this->render('contribution', [
            'model' => $model,
        ]);
    }
    public function actionBenefitCalculator()
    {
         $model = new Calculator();

        if ($model->load(Yii::$app->request->post())) {
            $time_type=  $model->time_type;
            $time=$model->time;
            $gross_salary=$model->gross_salary;
          //  print_r($gross_salary);
          //  die;
            if($time_type==Calculator::year && ($time > 45)){
                Yii::$app->session->setFlash('year_fail');
                return $this->redirect(['benefit-calculator']);
            }

            if ($time_type == Calculator::month && ($time > 540)) {

                Yii::$app->session->setFlash('month_fail');
                return $this->redirect(['benefit-calculator']);
            }

            if ($time_type ==Calculator::month) {
                $years = $time / 12;
                $total_months = $time;
            } else {
                $years = $time;
                $total_months = $time * 12;
            }

            //Since this is a partial old age test, BAE would just be the gross salary
            $bae = $gross_salary;
            $monthly_contribution = (7 * $gross_salary) / 100;
            $computed = false;

            if ($years >= 13) {
                //Pension = Av. Salary x [36% + (2%(PC – 13))]
                //Gratuity = Answer*60
                $pension = ($gross_salary * (36 + (2 * ($years - 13)))) / 100;
                $gratuity = $pension * 60;
                $benefits['pension'] = ($pension);
                $benefits['gratuity'] = ($gratuity);
                $benefits['label'] = 'Gratuity';
                $computed = true;
            } else if ($total_months < 24) {
                //if PC months < 24
                //17% of (av salary x PC)
                $benefits['pension'] = 'N/A';
                $benefits['gratuity'] = ((17 * ($gross_salary * $total_months)) / 100);
                $benefits['label'] = 'Refund';
                $computed = true;
            } else if (($total_months >= 24) && ($total_months < 60)) {

                $benefits['pension'] = 'N/A';
                $benefits['gratuity'] = ((85 * (((20 * $gross_salary) / 100) * $total_months)) / 100);
                $benefits['label'] = 'Refund';
                $computed = true;
            } else if (($total_months >= 60) && ($total_months < 156)) {

                $pension = (2.5 * ($gross_salary * $years)) / 100;
                $gratuity = $pension * 60;
                $benefits['pension'] = ($pension);
                $benefits['gratuity'] = ($gratuity);
                $benefits['label'] = 'Gratuity';
                $computed = true;
            }

            if ($computed) {
                $benefits['average_salary'] = ($gross_salary);
                $benefits['total_months_contributed'] = (string)$total_months;
                $benefits['total_contributions'] = ($total_months * $monthly_contribution);
                $benefits['status'] = 200;
            }

            $pension=$benefits['pension'];
            $gratuity=$benefits['gratuity'];
            $average_salary=$benefits['average_salary'];
            $total_months_contributed=$benefits['total_months_contributed'];
            $total_contributions=$benefits['total_contributions'];

            if ($years >4 || $total_months >59){
                Yii::$app->session->set('pension',$pension);
                Yii::$app->session->set('gratuity',$gratuity);
                Yii::$app->session->set('average_salary',$average_salary);
                Yii::$app->session->set('total_months_contributed',$total_months_contributed);
                Yii::$app->session->set('total_contributions',$total_contributions);
            }
            else{
                $pension=0;
                Yii::$app->session->set('pension',$pension);
                Yii::$app->session->set('gratuity',$gratuity);
                Yii::$app->session->set('average_salary',$average_salary);
                Yii::$app->session->set('total_months_contributed',$total_months_contributed);
                Yii::$app->session->set('total_contributions',$total_contributions);
            }


//            Yii::$app->getSession()->setFlash('success', [
//                'text' => 'Months must not be greater than 540',
//                'title' => 'My custom title',
//                'type' => 'success',
//                'timer' => 3000,
//                'showConfirmButton' => false
//            ]);
            Yii::$app->session->setFlash('success_benefit');

            return $this->redirect(['benefit-calculator']);
          //  print_r($total_contributions);
         //   die;

        }

        return $this->render('benefit', [
            'model' => $model,
        ]);

    }


    public function actionBenefitCalculator1()
    {

        $model = new Calculator();


        if ($model->load(Yii::$app->request->post())) {
            $employee=(13/100) * $model->amount;
            $employer=(7/100) * $model->amount;

            Yii::$app->session->set('employee',$employee);
            Yii::$app->session->set('employer',$employer);
            Yii::$app->session->setFlash('success', Yii::t('yii', 'We have sent OTP to your email address'));

            Yii::$app->getSession()->setFlash('success', [
                'text' => 'My custom text',
                'title' => 'My custom title',
                'type' => 'success',
                'timer' => 3000,
                'showConfirmButton' => false
            ]);
            return $this->redirect(['contribution-calculator']);

        }

        return $this->render('contribution', [
            'model' => $model,
        ]);
    }

}
