<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SmsLogs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sms-logs-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row" style="margin-bottom: 8px">
        <div class="col-sm-6">
            <?php
            echo '<label class="control-label">Select Schedule Time</label>';
            echo DateTimePicker::widget([
                'model' => $model,
                'attribute' => 'schedule_date',
                'options' => ['placeholder' => 'Select Date and Time ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii'
                ]
            ]);


            ?>
        </div>
    </div>

    <?php


    // $form->field($model, 'date_time')->d()
    ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Send Verification Code'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
