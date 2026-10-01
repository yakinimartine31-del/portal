<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title = Yii::t('yii', 'Member Name: {name}', [
    'name' => $model->name,
]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['profile', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update Profile');
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
        'member' => $member,
    ]) ?>

</div>
