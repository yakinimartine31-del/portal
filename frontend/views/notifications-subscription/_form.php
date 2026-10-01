<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\NotificationsSubscription */
/* @var $form yii\widgets\ActiveForm */

$method=['SMS'=>'SMS','Email'=>'Email']
?>
<hr>
<div class="notifications-subscription-form">

    <?php $form = ActiveForm::begin(); ?>

<h6><?= Yii::t('yii','Notification Method')   ?></h6>
    <?php $form->field($model, 'notification_method')
        ->checkboxList($method,['class'=>'box1']) ?>

    <?= $form->field($model, 'email')->checkbox() ?>
    <?= $form->field($model, 'sms')->checkbox() ?>
    <hr>
    <h6><?= Yii::t('yii','Notification Types')   ?></h6>
    <?= $form->field($model, 'new_contr')->checkbox() ?>
    <?= $form->field($model, 'benefit')->checkbox() ?>
    <?= $form->field($model, 'new_soft')->checkbox() ?>
    <?= $form->field($model, 'new_service')->checkbox() ?>

    <?php $form->field($model, 'notification_types')
        ->checkboxList(\frontend\models\NotificationsSubscription::getType(),['class'=>'box']) ?>

<hr>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<style>
    .box {
        width:250px;
    }
    .box1 {
        width:70px;
    }
</style>

<script>
    function readOnlyCheckBox(el) {
        return el.checked;
    }

    function uncheck() {
        document.getElementById('cbx1').checked = false;
    }
</script>