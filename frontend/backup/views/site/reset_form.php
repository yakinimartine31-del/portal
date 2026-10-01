<?php

use frontend\models\Members;
use frontend\models\User;
use yii\helpers\Html;
use yii\web\Response;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Members */
/* @var $form yii\widgets\ActiveForm */
if (Yii::$app->session->getFlash('otp_success')) {
    $user = new Members();
    $otp = new User();
    if (Yii::$app->request->isAjax && $user->load(Yii::$app->request->post())) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return \yii\bootstrap\ActiveForm::validate($user);
    }
    $info = User::findOne(['otep' => $_POST['User']['otep']]);
    $info = User::find()->where(['LIKE BINARY', 'otep',$_POST['User']['otep']])->one();
    $detail = Members::findOne(['uid' =>$info['id']]);
}
elseif (Yii::$app->session->getFlash('details_fail')) {
    $user = new Members();
}
else {
    $user = new Members();
}

?>
<?php
if (Yii::$app->session->getFlash('otp_success')) {
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <?php $form = ActiveForm::begin([
                    'action' => ['site/finish-reset'],
                    'method' => 'POST ',
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>
                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'full_names')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $detail['full_names']]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <?= $form->field($user, 'email')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $detail['email']]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'membership_number')->textInput(['maxlength' => true, 'readOnly' => true,'value' => $detail['membership_number']]) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'date_of_birth')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $detail['date_of_birth']]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'address')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $detail['address']]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'mobile_number')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $detail['mobile_number']]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'gender')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $detail['gender']]) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'username', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $detail['username']]) ?>

                        </div>
                    </div>
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'password')->passwordInput(['maxlength' => true, 'readOnly' => false,]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'repassword')->passwordInput(['maxlength' => true, 'readOnly' => false,]) ?>
                        </div>
                    </div>
                </div>
                    <?= Html::submitButton($user->isNewRecord ? 'Submit' : 'Submit', ['class' => $user->isNewRecord ? 'btn btn-info btn-fill pull-left' : 'btn btn-info btn-fill pull-left']) ?>
                <div class="clearfix"></div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'full_names')->textInput(['maxlength' => true, 'readOnly' => true,]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <?= $form->field($user, 'email')->textInput(['maxlength' => true, 'readOnly' => true, ]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'membership_number')->textInput(['maxlength' => true, 'readOnly' => true,]) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'date_of_birth')->textInput(['maxlength' => true, 'readOnly' => true, ]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'address')->textInput(['maxlength' => true, 'readOnly' => true,]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'mobile_number')->textInput(['maxlength' => true, 'readOnly' => true,]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'gender')->textInput(['maxlength' => true, 'readOnly' => true,]) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'username')->textInput(['maxlength' => true, 'readOnly' => false, ]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'password')->textInput(['maxlength' => true, 'readOnly' => false,]) ?>
                        </div>
                    </div>
                </div>
                <?= Html::submitButton(Yii::t('yii', 'Submit'), ['class' => 'btn btn-info btn-fill pull-left']) ?>
                <div class="clearfix"></div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?php } ?>