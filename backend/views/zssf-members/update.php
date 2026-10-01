<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ZssfMembers */

$this->title = Yii::t('yii', 'Update Zssf Members: {name}', [
    'name' => $model->full_names,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Zssf Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>
<div class="zssf-members-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
