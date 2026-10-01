<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */

$this->title =Yii::t('yii', 'Update Verification Agent'). Yii::t('yii',': {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Verification Agent'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>
<div class="users-update">


    <?= $this->render('_formShehaUpdate', [
        'model' => $model,
        'member' => $member,
    ]) ?>

</div>
