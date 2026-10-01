<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeathReports */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="death-reports-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_time')->textInput() ?>

    <?= $form->field($model, 'member_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pensioner_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'death_date')->textInput() ?>

    <?= $form->field($model, 'death_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'death_cause')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'death_certificate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_status_id')->textInput() ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
