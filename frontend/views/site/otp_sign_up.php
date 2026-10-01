<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\bootstrap\Button;
use yii\helpers\Html;

$this->title = 'OTP';
//$this->params['breadcrumbs'][] = $this->title;
$model = new \frontend\models\User();
?>

<div class="row">
    <?php $form = ActiveForm::begin([
        'action' => ['site/verify-otp'],
        'method' => 'POST ',   /// get or post
    ]); ?>
    <div class="card-header">

        <div class="panel panel-heading"
             style="text-align: center;"><?= Yii::t('yii', 'ENTER OTP CODE') ?></div>
    </div>
    <div class="col-lg-4">
        <?= Yii::t('yii', '<span>Do you have a code ? , simply enter and click <b>verify to continue</b>.</span>') ?>
    </div>
    <div class="col-lg-4">

        <?= $form->field($otp, 'otep')->textInput(['autofocus' => true, 'readOnly' => false]) ?>
        <div id="time" style="color: red;size: 900px"></div>
    </div>
    <div class="col-lg-4" style="padding-top: 22px">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('yii', 'Verify'), ['class' => 'btn btn-success']) ?>

        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>
    function tick(time) {
        setTimeout(() => {
            const newTime = new Date();
            const diff = Math.floor((newTime.getTime() - time.getTime()) / 1000);
            const timeFrom15 = (5 * 60) - diff;
            const secs = timeFrom15 % 60;
            const mins = ((timeFrom15 - secs) / 60);
            document.getElementById('time').innerText = `${mins}:${secs < 10 ? '0' : ''}${secs}`;
            if (secs >= 0) {
                tick(time);
            } else {
                document.getElementById('time').innerText = '0:00  (OTP EXPIRED)';
            }
        }, 1000);
    }

    tick(new Date());
</script>

