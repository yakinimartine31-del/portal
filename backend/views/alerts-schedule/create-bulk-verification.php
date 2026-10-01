<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SmsLogs */

$this->title = Yii::t('yii', 'Schedule Time to send Verification code');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'verification'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-logs-create">

    <?= $this->render('_formBulkVerification', [
        'model' => $model,
    ]) ?>

</div>
