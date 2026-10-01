<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeathReportsSeacrh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="death-reports-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_time') ?>

    <?= $form->field($model, 'member_number') ?>

    <?= $form->field($model, 'pensioner_number') ?>

    <?= $form->field($model, 'death_date') ?>

    <?php // echo $form->field($model, 'death_place') ?>

    <?php // echo $form->field($model, 'death_cause') ?>

    <?php // echo $form->field($model, 'death_certificate') ?>

    <?php // echo $form->field($model, 'current_status_id') ?>

    <?php // echo $form->field($model, 'type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
