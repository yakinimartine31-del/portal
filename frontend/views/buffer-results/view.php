<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\BufferResults */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Buffer Results'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="buffer-results-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'TotalNumberOfContribution',
            'BestAverageEarning',
            'TotalContributions',
            'ContributionAfterRetirement',
            'Gratuity',
            'MonthlyPension',
            'Refund',
            'ContBeforeRetirement',
            'MONTHLYPENSIONCALCULATED',
            'MPFormula',
            'MPFormulawnumber',
            'GTFormula',
            'GTFormulawnumber',
            'RFFormula',
            'RFFormulawnumber',
            'member_number',
            'type',
            'latest_contribution',
            'latest_updated',
        ],
    ]) ?>

</div>
