<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SubscriptionTypes */

$this->title = 'Create Subscription Types';
$this->params['breadcrumbs'][] = ['label' => 'Subscription Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscription-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
