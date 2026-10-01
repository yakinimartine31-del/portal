<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SmsLogs */

$this->title = Yii::t('yii', 'Create Sms Logs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Sms Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-logs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
