<?php

use frontend\models\Members;
use frontend\models\User;
use yii\helpers\Html;
use yii\web\Response;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Members */
/* @var $form yii\widgets\ActiveForm */
if (Yii::$app->session->getFlash('otp_success') || Yii::$app->session->getFlash('z_number') ) {
    $user = new Members();
    $otp = new User();
    if (Yii::$app->request->isAjax && $user->load(Yii::$app->request->post())) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return \yii\bootstrap\ActiveForm::validate($user);
    }
    $info = User::findOne(['otep' => $_POST['User']['otep']]);
    $info = User::find()->where(['LIKE BINARY', 'otep',$_POST['User']['otep']])->one();
    $detail = Members::findOne(['uid' =>$info['id']]);

    $OTP=trim($_POST['User']['otep']);

    $zssf=Yii::$app->session->getFlash('z_number');
    $url = 'http://mobile.zssf.or.tz/api/v1/static/index.php/get-zssf-member';
    $data_json=json_encode(["member_number"=> "$zssf",'token'=>"$OTP"]);


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response  = curl_exec($ch);
    curl_close($ch);

    $detail=json_decode($response,true);

    $fist_name=$detail['MemberFirstName'];
    $middle_name=$detail['MemberMiddleName'];
    $sur_name=$detail['MemberSurName'];
    $full_name=$fist_name.' '.$middle_name.' '.$sur_name;
    $email=$detail['EmailAddress'];
    $membership_number=$detail['MemberCode'];
    $date_of_birth=$detail['DateofBirth']['date'];
    $MemberJoinDate=$detail['MemberJoinDate']['date'];
    $address=$detail['MemberAddress'];
    $mobile_number=$detail['MobilePhone'];
    $gender=$detail['Gender'];
    $marital_status=$detail['MaritalStatus'];


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
                    'action' => ['site/finish'],
                    'method' => 'POST ',
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>
                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'full_names')->textInput(['maxlength' => true, 'readOnly' => true, 'value' =>$full_name]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <?= $form->field($user, 'email')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $email]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'membership_number')->textInput(['maxlength' => true, 'readOnly' => true,'value' => $membership_number]) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'date_of_birth')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $date_of_birth]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'address')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $address]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'mobile_number')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $mobile_number]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'gender')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $gender]) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'marital_status')->hiddenInput(['maxlength' => true, 'readOnly' => true, 'value' =>$marital_status])->label(false) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'date_of_joining')->hiddenInput(['maxlength' => true, 'readOnly' => true, 'value' =>$MemberJoinDate])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'username', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'readOnly' => false]) ?>

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
                            <?= $form->field($user, 'full_names')->textInput(['maxlength' => true, 'readOnly' => true, 'value' =>$full_name]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <?= $form->field($user, 'email')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $email]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'membership_number')->textInput(['maxlength' => true, 'readOnly' => true,'value' => $membership_number]) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'date_of_birth')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $date_of_birth]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'address')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $address]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'mobile_number')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $mobile_number]) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <?= $form->field($user, 'gender')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $gender]) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'marital_status')->hiddenInput(['maxlength' => true, 'readOnly' => true, 'value' =>$marital_status])->label(false) ?>
                        </div>
                    </div>
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'date_of_joining')->hiddenInput(['maxlength' => true, 'readOnly' => true, 'value' =>$MemberJoinDate])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <?= $form->field($user, 'username', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'readOnly' => false]) ?>

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
                <?= Html::submitButton(Yii::t('yii', 'Submit'), ['class' => 'btn btn-info btn-fill pull-left']) ?>
                <div class="clearfix"></div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?php } ?>