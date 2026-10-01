<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ContributionTrend */

$this->title = Yii::t('yii', 'Create Contribution Trend');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Contribution Trends'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contribution-trend-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
