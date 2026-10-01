<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Alerts */

$this->title = 'Create New Notification To all Members';
$this->params['breadcrumbs'][] = ['label' => 'Notification', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alerts-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
