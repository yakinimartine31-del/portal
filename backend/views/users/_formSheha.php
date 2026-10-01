<?php

use backend\models\Users;
use kartik\select2\Select2;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="report-search">

    <?php $form = ActiveForm::begin(); ?>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'required' => true])->label("Full Name") ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'maxlength' => 255,]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($member, 'mobile_number')->textInput(['maxlength' => true, 'required' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($member, 'mobile_phone_of_who_come_behalf_of_pensioner')->textInput(['maxlength' => true, 'placeholder' => 'Mobile Phone of Who Come Behalf of Pensioner']) ?>
        </div>
       <div class="col-md-3">
            <?= $form->field($member, 'device_number')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
        </div>

    </div>
    <div class="row">

        <div class="col-md-3">

            <?= $form->field($member, 'region')->dropDownList(Users::getRegions(), ['prompt' => Yii::t('yii', '-- Select --'), 'id' => 'cat-id']) ?>

        </div>
        <div class="col-md-3">
            <?=
            $form->field($member, 'district')->widget(DepDrop::classname(), [
                'options' => ['id' => 'subcat-id'],
                'pluginOptions' => [
                    'depends' => ['cat-id'],
                    'placeholder' => 'Select...',
                    'url' => Url::to(['users/sub'])
                ]
            ]);
            ?>
            <?php //$form->field($member, 'district')->dropDownList(Users::getDistricts(), ['prompt' => Yii::t('yii', '-- Select --')]) ?>

        </div>
        <div class="col-md-3">


            <?=

             $form->field($member, 'shehia')->widget(DepDrop::classname(), [
                'pluginOptions'=>[
                    'depends'=>['cat-id', 'subcat-id'],
                    'placeholder'=>'Select...',
                    'url'=>Url::to(['users/prod'])
                ]
            ]);


//            $form->field($member, 'shehia')->widget(DepDrop::classname(), [
//                'pluginOptions' => [
//                    'depends' => ['cat-id', 'subcat-id'],
//                    'placeholder' => 'Select...',
//                    'url' => Url::to(['users/prod']),
//                    'allowClear' => true
//                ],
//
//            ]);

            ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($member, 'address')->textInput(['maxlength' => true, 'readOnly' => false]) ?>
        </div>

        <div class="col-md-3">

            <?= $form->field($member, 'gender')->dropDownList(['MALE' => 'MALE', 'FEMALE' => 'FEMALE'], ['prompt' => 'Selet Gender', 'required' => true]) ?>

        </div>
        <div class="col-md-3">

            <?= $form->field($member, 'national_id')->textInput(['maxlength' => true, 'required' => false]) ?>

        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'maxlength' => 255, 'placeholder' => 'Username']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'password_new')->passwordInput(['maxlength' => true, 'required' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => true, 'required' => true]) ?>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-3">

            <div class="form-group">
                <?= Html::submitButton(Yii::t('yii', 'Submit'), ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('yii', 'Back'), ['index'], ['class' => 'btn btn-danger']) ?>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

