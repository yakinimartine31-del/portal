<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use drsdre\wizardwidget\WizardWidget;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Sign up';

?>
<?php if (Yii::$app->session->getFlash('form_success')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-success'],
        'body' => Yii::$app->session->getFlash('form_success'),
    ]);
} elseif (Yii::$app->session->getFlash('form_fail')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-danger'],
        'body' => Yii::$app->session->getFlash('form_fail'),
    ]);
}
elseif (Yii::$app->session->getFlash('otp_success')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-success'],
        'body' => Yii::$app->session->getFlash('otp_success'),
    ]);
}
elseif (Yii::$app->session->getFlash('otp_fail')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-danger'],
        'body' => Yii::$app->session->getFlash('otp_fail'),
    ]);
}
elseif (Yii::$app->session->getFlash('details_success')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-success'],
        'body' => Yii::$app->session->getFlash('details_success'),
    ]);
}elseif (Yii::$app->session->getFlash('details_fail')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-danger'],
        'body' => Yii::$app->session->getFlash('details_fail'),
    ]);
}


?>
<?php if (Yii::$app->user->isGuest == true) { ?>
    <?php echo Yii::t('yii','SIGN UP FORM')?>
    <?php
    $wizard_config = [
        'id' => 'stepwizard',
        'steps' => [
            1 => [
                'title' => Yii::t('yii','Enter ZSSF No'),
                'icon' => 'glyphicon glyphicon-home',
                'content' => $this->render('form',['model'=>$model]),

            ],
            2 => [
                'title' => Yii::t('yii','Enter OTP sent to phone/email'),
                'icon' => 'glyphicon glyphicon-phone',
                'content' => $this->render('otp_form',['otp'=>$otp]),
                'skippable' => false,
                'save' => false,
            ],
            3 => [
                'title' => Yii::t('yii','Member Information'),
                'icon' => 'glyphicon glyphicon-user',
                'content' => $this->render('member_form',['user'=>$user]),
                'skippable' => false,
                'save' => false,
            ],
        ],
        'complete_content' => Yii::t('yii','You are done!'), // Optional final screen
        'start_step' => 1, // Optional, start with a specific step
    ];
    ?>
    <?php
    $wizard_config1 = [
        'id' => 'stepwizard',
        'steps' => [
            1 => [
                'title' => Yii::t('yii','Enter ZSSF No'),
                'icon' => 'glyphicon glyphicon-cloud-download',
                'content' => $this->render('form',['model'=>$model]),

            ],
            2 => [
                'title' => Yii::t('yii','Enter OTP sent to phone/email'),
                'icon' => 'glyphicon glyphicon-phone',
                'content' => $this->render('otp_form',['otp'=>$otp]),
                'skippable' => false,
                'save' => false,
            ],
            3 => [
                'title' => Yii::t('yii','Member Information'),
                'icon' => 'glyphicon glyphicon-user',
                'content' =>Yii::$app->session->getFlash('otp_success') ? $this->render('member_form',['user'=>$user]) : '',
                'skippable' => false,
                'save' => false,
            ],
        ],
        'complete_content' => Yii::t('yii','You are done!'), // Optional final screen
        'start_step' => 2, // Optional, start with a specific step
    ];
    ?>
    <?php
    $wizard_config2 = [
        'id' => 'stepwizard',
        'steps' => [
            1 => [
                'title' => Yii::t('yii','Enter ZSSF No'),
                'icon' => 'glyphicon glyphicon-cloud-download',
                'content' => $this->render('form',['model'=>$model]),

            ],
            2 => [
                'title' => Yii::t('yii','Enter OTP sent to phone/email'),
                'icon' => 'glyphicon glyphicon-phone',
                'content' => $this->render('otp_form',['otp'=>$otp]),

            ],
            3 => [
                'title' => Yii::t('yii','Member Information'),
                'icon' => 'glyphicon glyphicon-user',
                'content' =>Yii::$app->session->getFlash('otp_success') ? $this->render('member_form',['user'=>$user]) : '',

            ],
        ],
        'complete_content' => Yii::t('yii','You are done!'), // Optional final screen
        'start_step' => 3, // Optional, start with a specific step
    ];
    ?>
    <?php
    $wizard_config3 = [
        'id' => 'stepwizard',
        'steps' => [
            1 => [
                'title' => Yii::t('yii','Enter ZSSF No'),
                'icon' => 'glyphicon glyphicon-cloud-download',
                'content' => $this->render('form',['model'=>$model]),

            ],
            2 => [
                'title' => Yii::t('yii','Enter OTP sent to phone/email'),
                'icon' => 'glyphicon glyphicon-phone',
                'content' => $this->render('otp_form',['otp'=>$otp]),

            ],
            3 => [
                'title' => Yii::t('yii','Member Information'),
                'icon' => 'glyphicon glyphicon-user',
                'content' =>Yii::$app->session->getFlash('details_fail') ? $this->render('member_form',['user'=>$user]) : '',

            ],
            4 => [
                'title' => Yii::t('yii','Member Information'),
                'icon' => 'glyphicon glyphicon-ok',
                'content' =>Yii::$app->session->getFlash('details_success') ? $this->render('complete') : '',
            ],
        ],
      //  'complete_content' =>Yii::$app->session->getFlash('details_success') ?  $this->render('complete') : '',
       // 'complete_content' => "Account was successfully created",
        'start_step' => 4, // Optional, start with a specific step
    ];
    ?>

    <?php
    if (Yii::$app->session->getFlash('form_success')){
        echo WizardWidget::widget($wizard_config1);
    }
    elseif (Yii::$app->session->getFlash('form_fail')){
        echo WizardWidget::widget($wizard_config);
    }
    elseif (Yii::$app->session->getFlash('otp_success')){
        echo WizardWidget::widget($wizard_config2);
    }
  elseif (Yii::$app->session->getFlash('otp_fail')){
        echo WizardWidget::widget($wizard_config1);
    }
    elseif (Yii::$app->session->getFlash('details_success')){
        echo WizardWidget::widget($wizard_config3);
    }
    elseif (Yii::$app->session->getFlash('details_fail')){
        echo WizardWidget::widget($wizard_config2);
    }
    else{
        echo WizardWidget::widget($wizard_config);
    }
    ?>

    <?php
}
?>
