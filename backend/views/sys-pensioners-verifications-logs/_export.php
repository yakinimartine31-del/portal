<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$gridColumns = $gridColumns;
echo GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $models,
        'pagination' => false,
    ]),
    'columns' => $gridColumns,
    'options' => ['class' => 'kv-grid-container'],
    'tableOptions' => ['class' => 'kv-grid-table table table-bordered table-striped'],
    'headerRowOptions' => ['class' => 'kv-grid-header'],
    'layout' => '{items}',
    'showPageSummary' => false,
    'showFooter' => false,
]);