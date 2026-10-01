<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ZssfMembers */
/* @var $form yii\widgets\ActiveForm */
?>
<hr>
<div class="zssf-members-form">

    <?php $form = ActiveForm::begin([
        'action' => ['reset','id'=>$model->id],
        'method' => 'post',
    ]); ?>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'membership_number')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
        </div>
        <?php /*
        <div class="col-sm-4">
            <?= $form->field($model, 'method')->dropDownList([1 => 'SMS', 2 => 'EMAIL']) ?>
        </div>
        */ ?>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-2">
            <?= Html::submitButton(Yii::t('yii', 'Reset'), ['class' => 'btn btn-block btn-success']) ?>
        </div>
        <div class="col-md-2">

            <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-warning btn-block']) ?>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
