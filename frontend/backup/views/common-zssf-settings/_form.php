<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CommonZssfSettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="common-zssf-settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_time')->textInput() ?>

    <?= $form->field($model, 'best_average_earning_months')->textInput() ?>

    <?= $form->field($model, 'maternity_fixed_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maternity_for_twins')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'complaints_email_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'percentage_deducted_on_refund')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refund_best_average_earning')->textInput() ?>

    <?= $form->field($model, 'hq_mobile_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pemba_mobile_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_calculator_months')->textInput() ?>

    <?= $form->field($model, 'max_calculator_years')->textInput() ?>

    <?= $form->field($model, 'unguja_phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employer_percentge')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_percentage')->textInput() ?>

    <?= $form->field($model, 'facebook_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'twitter_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instagram_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pemba_cordinates')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unguja_cordinates')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'youtube_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'host_server')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'db_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'db_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'database_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'footer_message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'head_office_fax_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pemba_fax_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
