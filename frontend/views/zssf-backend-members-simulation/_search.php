<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ZssfBackendMembersSimulationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zssf-backend-members-simulation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_time') ?>

    <?= $form->field($model, 'member_number') ?>

    <?= $form->field($model, 'mobile_number') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'validation_code') ?>

    <?php // echo $form->field($model, 'member_code') ?>

    <?php // echo $form->field($model, 'first_name') ?>

    <?php // echo $form->field($model, 'second_name') ?>

    <?php // echo $form->field($model, 'last_name') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'join_date') ?>

    <?php // echo $form->field($model, 'full_names') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'birthday') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
