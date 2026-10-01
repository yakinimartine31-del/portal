<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\NotificationsSubscription */

$this->title = Yii::t('yii', 'Create Notifications Subscription');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Notifications Subscriptions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifications-subscription-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
