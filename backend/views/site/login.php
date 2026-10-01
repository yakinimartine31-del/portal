<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>



        <div class="login-form">
            <?php if (Yii::$app->session->hasFlash('failure')): ?>
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-times"></i> Error!</h4>
                    <?= Yii::$app->session->getFlash('failure') ?>
                </div>
            <?php endif; ?>
            <?php $form = ActiveForm::begin(['id' => 'form','class'=>'form', 'enableClientValidation' => false]); ?>

                <h2 class="text-center">
                    <p class="login-box-msg" style="color: white"><?= Yii::t('yii','Administration Login')?></p>
                </h2>
            <hr>
            <?= $form
                ->field($model, 'username', $fieldOptions1)
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

            <?= $form
                ->field($model, 'password', $fieldOptions2)
                ->label(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('yii','Sign in'), ['class' => 'btn btn-info btn-block', 'name' => 'login-button']) ?>
                </div>
            <hr>
            <?php ActiveForm::end(); ?>

        </div>

        <style type="text/css">
            .btn{
                background-color: orange;
            }
            .login-form {
                width: 340px;
                margin: 50px auto;
                padding-top: 90px;
                margin-right: 190px;
            }
            .login-form form {
                width: 400px;
                margin-bottom: 15px;
                background: #1F824B;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                padding: 30px;
            }
            .login-form h2 {
                margin: 0 0 15px;
            }
            .form-control, .btn {
                min-height: 38px;
                border-radius: 2px;
            }
            .btn {
                font-size: 15px;
                font-weight: bold;
            }
        </style>


