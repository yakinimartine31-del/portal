<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ZssfMembers */
/* @var $form yii\widgets\ActiveForm */
?>
<hr>
<div class="zssf-members-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'full_names')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'membership_number')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'date_of_birth')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',

                ],

                'options' => ['placeholder' => Yii::t('yii', 'Date of Birth')]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'marital_status')->dropDownList(['Married' =>'Married','Single'=>'Single','Divorce'=>'Divorce']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'gender')->dropDownList(['Male' => 'Male','Female'=>'Female']) ?>
        </div>
    </div>
<br>
    <div class="row">
        <div class="col-sm-3">
            <?= Html::submitButton(Yii::t('yii', 'Save'), ['class' => 'btn btn-block btn-success']) ?>
        </div>
        <div class="col-md-3">

            <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-warning btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
