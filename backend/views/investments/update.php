<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Investments */

$this->title = Yii::t('yii', 'Update Investments: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Investments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>
<hr>
<div class="investments-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
