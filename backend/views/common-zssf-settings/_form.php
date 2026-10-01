<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CommonZssfSettings */
/* @var $form yii\widgets\ActiveForm */
?>
<hr>
<div class="customers-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="item form-group">
        <div class="row">
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'best_average_earning_months')->textInput() ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'maternity_fixed_amount')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'maternity_for_twins')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4 ">

                <?= $form->field($model, 'complaints_email_address')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'refund_best_average_earning')->textInput() ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'hq_mobile_number')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4 ">

                <?= $form->field($model, 'pemba_mobile_number')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'max_calculator_months')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4 ">

                <?= $form->field($model, 'unguja_phone_number')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'employer_percentge')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'facebook_link')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'twitter_link')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'instagram_link')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'hotline_no')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'youtube_link')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'host_server')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'db_user')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'footer_message')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'head_office_fax_number')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'pemba_fax_number')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'employee_percentage')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">

            </div>
            <div class="col-md-4 col-sm-4 ">

            </div>
        </div>
        <hr>
        <div class="item form-group">
            <?= Html::a(Yii::t('app', '<i class="fa fa-times text-yellow"></i> Cancel'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success']) ?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

