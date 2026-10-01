<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password_hash') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'verification_token') ?>

    <?php // echo $form->field($model, 'block') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'sendEmail') ?>

    <?php // echo $form->field($model, 'registerDate') ?>

    <?php // echo $form->field($model, 'lastvisitDate') ?>

    <?php // echo $form->field($model, 'activation') ?>

    <?php // echo $form->field($model, 'params') ?>

    <?php // echo $form->field($model, 'lastResetTime') ?>

    <?php // echo $form->field($model, 'resetCount') ?>

    <?php // echo $form->field($model, 'otpKey') ?>

    <?php // echo $form->field($model, 'otep') ?>

    <?php // echo $form->field($model, 'requireReset') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('yii', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
