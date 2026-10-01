<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Alerts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alerts-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'subject')->dropDownList(\backend\models\Alerts::getAllType(),
        ['prompt' => Yii::t('yii', '--- Select Subject ---')]) ?>


    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'message_type')
        ->checkboxList(['sms'=>'Through SMS','email'=>'Through Email','notification'=>'App Notification'],['class'=>'box']) ?>



    <div class="col-sm-4">
        <?= Html::submitButton('Send', ['class' => 'btn btn-block btn-success']) ?>


    </div>

    <?php ActiveForm::end(); ?>

</div>
