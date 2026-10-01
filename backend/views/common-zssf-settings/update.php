<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CommonZssfSettings */

$this->title = Yii::t('yii', 'Update Common Zssf Settings', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Common Zssf Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>
<div class="common-zssf-settings-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
