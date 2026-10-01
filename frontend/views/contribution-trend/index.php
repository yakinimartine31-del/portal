<?php

use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel frontend\models\ContributionTrendSearch */
/* @var $yearFilter array */

if (empty($yearFilter)) {
    $currentYear = (int)date('Y');
    $yearFilter = [];
    for ($y = $currentYear; $y >= 2010; $y--) {
        $yearFilter[$y] = $y;
    }
}

$exportParams = Yii::$app->request->queryParams;
$exportButtons = Html::tag('div',
    Html::a('Download PDF', array_merge(['export'], $exportParams, ['type' => 'pdf']), ['class' => 'btn btn-danger', 'data-pjax' => 0]) . ' ' .
    Html::a('Download Excel', array_merge(['export'], $exportParams, ['type' => 'excel']), ['class' => 'btn btn-success', 'data-pjax' => 0]) . ' ' .
    Html::a('Download CSV', array_merge(['export'], $exportParams, ['type' => 'csv']), ['class' => 'btn btn-info', 'data-pjax' => 0]),
    ['class' => 'pull-right']
);

// SAFE FORMAT
$safe = function ($value) {
    if (!is_numeric($value)) {
        $value = 0;
    }
    return number_format((float)$value, 2);
};

$months = [
    'JANUARY','FEBRUARY','MARCH','APRIL',
    'MAY','JUNE','JULY','AUGUST',
    'SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER'
];

$gridColumns = [];

// ================= YEAR COLUMN =================
$gridColumns[] = [
    'attribute' => 'ContributionYear',
    'label' => 'Year',
    'headerOptions' => ['style' => 'color:#4cb6de;font-weight:bold;'],
    'contentOptions' => ['style' => 'font-weight:bold;'],
];


// ================= MONTHLY COLUMNS =================
foreach ($months as $month) {

    // SALARY (DB column = JANUARY, FEBRUARY...)
    $gridColumns[] = [
        'label' => $month . ' Salary',
        'format' => 'raw',
        'headerOptions' => ['style' => 'color:#4cb6de'],
        'value' => function ($model) use ($month, $safe) {
            $field = $month;
            return $safe($model->$field ?? 0);
        },
    ];

    // CONTRIBUTION (DB column = JANUARYC, FEBRUARYC...)
    $gridColumns[] = [
        'label' => $month . ' Cont.',
        'format' => 'raw',
        'headerOptions' => ['style' => 'color:#28a745'],
        'value' => function ($model) use ($month, $safe) {
            $field = $month . 'C';
            return $safe($model->$field ?? 0);
        },
    ];
}

// ================= GRID =================
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,

    'columns' => $gridColumns,

    'pjax' => true,
    'pjaxSettings' => [
        'options' => ['id' => 'kv-pjax-container'],
        'neverTimeout' => true,
    ],
    'hover' => true,
    'striped' => true,
    'responsive' => true,
    'summary' => '',
    'containerOptions' => ['style' => 'overflow: auto'],
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => 'Contribution Trend',
        'before' => $this->render('_search', ['model' => $searchModel]) . '<div class="pull-right" style="margin-bottom:10px;">' . $exportButtons . '</div>',
    ],

    'filterRowOptions' => ['class' => 'kv-filter-row'],
    'filterPosition' => GridView::FILTER_POS_HEADER,

    // ================= TOOLBAR =================
    'toolbar' => [
        '{toggleData}',
    ],

    // Disable the default Kartik export dropdown and use controller exports instead
    'export' => false,
]);

?>