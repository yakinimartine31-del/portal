<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContributionTrend */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contribution-trend-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ContributionYear')->textInput() ?>

    <?= $form->field($model, 'JANUARY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FEBRUARY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MARCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'APRIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MAY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JUNE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JULY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AUGUST')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SEPTEMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OCTOBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOVEMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DECEMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JANUARYC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FEBRUARYC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MARCHC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'APRILC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MAYC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JUNEC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JULYC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AUGUSTC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SEPTEMBERC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OCTOBERC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOVEMBERC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DECEMBERC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AnnualMonthsContributed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AnnualSalaryContributed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AnnualTotalContributed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
