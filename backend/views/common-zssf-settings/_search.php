<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CommonZssfSettingsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="common-zssf-settings-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_time') ?>

    <?= $form->field($model, 'best_average_earning_months') ?>

    <?= $form->field($model, 'maternity_fixed_amount') ?>

    <?= $form->field($model, 'maternity_for_twins') ?>

    <?php // echo $form->field($model, 'complaints_email_address') ?>

    <?php // echo $form->field($model, 'percentage_deducted_on_refund') ?>

    <?php // echo $form->field($model, 'refund_best_average_earning') ?>

    <?php // echo $form->field($model, 'hq_mobile_number') ?>

    <?php // echo $form->field($model, 'pemba_mobile_number') ?>

    <?php // echo $form->field($model, 'contact_email') ?>

    <?php // echo $form->field($model, 'max_calculator_months') ?>

    <?php // echo $form->field($model, 'max_calculator_years') ?>

    <?php // echo $form->field($model, 'unguja_phone_number') ?>

    <?php // echo $form->field($model, 'employer_percentge') ?>

    <?php // echo $form->field($model, 'employee_percentage') ?>

    <?php // echo $form->field($model, 'facebook_link') ?>

    <?php // echo $form->field($model, 'twitter_link') ?>

    <?php // echo $form->field($model, 'instagram_link') ?>

    <?php // echo $form->field($model, 'pemba_cordinates') ?>

    <?php // echo $form->field($model, 'unguja_cordinates') ?>

    <?php // echo $form->field($model, 'youtube_link') ?>

    <?php // echo $form->field($model, 'host_server') ?>

    <?php // echo $form->field($model, 'db_user') ?>

    <?php // echo $form->field($model, 'db_password') ?>

    <?php // echo $form->field($model, 'database_name') ?>

    <?php // echo $form->field($model, 'footer_message') ?>

    <?php // echo $form->field($model, 'head_office_fax_number') ?>

    <?php // echo $form->field($model, 'pemba_fax_number') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('yii', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
