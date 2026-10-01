<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
if ( Yii::$app->session->getFlash('oldpass_fail')){
    echo Alert::widget([
        'options' => ['class' => 'alert-success'],
        'body' => Yii::$app->session->getFlash('oldpass_fail'),
    ]);

}

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput(['autofocus' => true,]) ?>
            <?php $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['autofocus' => true,]) ?>
            <?php $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($member, 'mobile_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'password_new')->passwordInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'repassword')->passwordInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'oldpass')->passwordInput(['maxlength' => 60, 'placeholder' => $model->getAttributeLabel('oldpass')]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
