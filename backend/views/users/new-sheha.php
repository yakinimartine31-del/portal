<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */

$this->title = Yii::t('yii', 'Create New Verification Agent');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Verification Agent'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Create New Verification Agent');
?>
<div class="users-create">


    <?= $this->render('_formSheha', [
        'model' => $model,
        'member' => $member,
    ]) ?>

</div>
