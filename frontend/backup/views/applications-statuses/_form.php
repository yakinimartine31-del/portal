<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ApplicationsStatuses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="applications-statuses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_time')->textInput() ?>

    <?= $form->field($model, 'application_date')->textInput() ?>

    <?= $form->field($model, 'benefit_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employer_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'processing_stage_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'application_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_date')->textInput() ?>

    <?= $form->field($model, 'member_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
