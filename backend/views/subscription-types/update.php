<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SubscriptionTypes */

$this->title = 'Update Subscription Types: ' . $model->type_name;
$this->params['breadcrumbs'][] = ['label' => 'Subscription Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subscription-types-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
