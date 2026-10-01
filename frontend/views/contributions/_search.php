<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ContributionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contributions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_time') ?>

    <?= $form->field($model, 'member_number') ?>

    <?= $form->field($model, 'cont_month') ?>

    <?= $form->field($model, 'cont_year') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'salary') ?>

    <?php // echo $form->field($model, 'transaction_id') ?>

    <?php // echo $form->field($model, 'contributing_period') ?>

    <?php // echo $form->field($model, 'latest_updated') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('yii', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
