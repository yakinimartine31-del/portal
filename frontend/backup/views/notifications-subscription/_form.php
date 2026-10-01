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


    <?php $form->field($model, 'notification_method')
        ->checkboxList($method,['class'=>'box1']) ?>

<h6><?= Yii::t('yii','Default Notification')   ?></h6>
    <input type="checkbox" id="cbx1" onClick="return readOnlyCheckBox(this)" CHECKED /><?= Yii::t('yii','New Contribution') ?>
    <input type="checkbox" id="cbx1" onClick="return readOnlyCheckBox(this)" CHECKED /><?= Yii::t('yii','Benefit Application Status') ?>
    <hr>
    <?= $form->field($model, 'notification_types')
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