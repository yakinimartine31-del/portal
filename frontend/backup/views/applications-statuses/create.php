<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ApplicationsStatuses */

$this->title = Yii::t('yii', 'Create Applications Statuses');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Applications Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applications-statuses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
