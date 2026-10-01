<?php
ini_set('memory_limit', '5024M');

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComplaintsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = Yii::t('yii', 'Complaints');

// ✅ UPDATED LOGIC: Forwarded complaints should remain Pending
$pendingStatusValues = [1, '1', 'Pending', null, ''];
$sortedStatusValues = [0, '0', 'Sorted'];

// ✅ FIXED: Updated logic to handle forwarded complaints correctly
$isAutoSorted = function ($model) {
    // Check if complaint has been PROPERLY responded to (not just forwarded)
    // 1. Has actual response_message (not empty)
    if (!empty($model->response_message) && trim($model->response_message) !== '') {
        return true;
    }
    
    // 2. Status_type is explicitly set to Sorted values
    if (in_array($model->status_type, [0, '0', 'Sorted'])) {
        return true;
    }
    
    // 3. If only respond_date or response_by is set (from forwarding), don't auto-sort
    return false;
};

$formatStatus = function ($model) use ($pendingStatusValues, $sortedStatusValues, $isAutoSorted) {
    $status = $model->status_type;
    
    // 1. If status_type is already 'Sorted' values
    if (in_array($status, $sortedStatusValues, true)) {
        return 'Sorted';
    }
    
    // 2. If has actual response_message (not empty)
    if (!empty($model->response_message) && trim($model->response_message) !== '') {
        return 'Sorted';
    }
    
    // 3. If status_type is 'Pending' values
    if (in_array($status, $pendingStatusValues, true)) {
        return 'Pending';
    }
    
    // 4. Default to Pending
    return 'Pending';
};
?>
<div class="clerk-deni-index" style="padding-top: 10px">

    <?php $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $pdfHeader = [
        'L' => [
            'content' => Yii::t('yii', 'COMPLAINTS REPORT'),
        ],
        'C' => [
            'content' => Html::a(Html::img('../images/login.png', ['alt' => 'image', 'class' => 'image', 'height' => '80'])) . '<br>' . 'COMPLAINTS REPORT' . '<br>',
            'font-size' => 10,
            'font-style' => 'B',
            'font-family' => 'arial',
            'height' => 119,
            'color' => '#333333'
        ],

        'R' => [
            'content' => Yii::t('yii', 'Date:') . date('Y-m-d'),
        ],
        'line' => true,
    ];

    $pdfFooter = [
        'L' => [
            'content' => '&copy; ZSSF',
            'font-size' => 10,
            'color' => '#333333',
            'font-family' => 'arial',
        ],
        'C' => [
            'content' => '',
        ],
        'R' => [
            'font-size' => 10,
            'color' => '#333333',
            'font-family' => 'arial',
        ],
        'line' => true,
    ];
    ?>
    <?php $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '36px',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],

        [
            'value' => 'member0.full_names',
            'label' => 'Full Names'
        ],
        [
            'attribute' => 'zssf_number',
            'contentOptions' => ['class' => 'truncate'],
        ],
        [
            'value' => function ($model) {
                if ($model->complaint_from == 1) {
                    return 'FROM APP';
                } elseif ($model->complaint_from == 0) {
                    return 'FROM WEB';
                } else {
                    return 'NOT REGISTERED';
                }

            },
            'attribute' => 'complaint_from',
        ],
        'date_time',

        [
            'attribute' => 'subject',
            'contentOptions' => ['class' => 'truncate'],
        ],

        [
            'attribute' => 'category',
            'value' => 'category0.category_name'
        ],
        [
            'attribute' => 'message',
            'format' => 'ntext',
            'contentOptions' => [
                'style' => 'width:280px; max-width:280px; white-space:normal; overflow-wrap:anywhere;',
            ],
            'headerOptions' => [
                'style' => 'width:280px; max-width:280px;',
            ],
        ],
        [

            'attribute' => 'photo_file',
            'format' => 'raw',
            'value' => function ($model) {
                if ($model->photo_file == null) {
                    return '';
                } elseif ($model->photo_file != null) {
                    $previewUrl = \yii\helpers\Url::to(['preview-image', 'id' => $model->id]);
                    return Html::a('<i class="fa fa-file text-green"></i>', $previewUrl, ['target' => '_blank', 'data-pjax' => "0"]);
                }
            }
        ],
        'respond_date',
        [
            'attribute' => 'status_type',
            'label' => 'Status',
            'value' => function ($model) use ($formatStatus) {
                return $formatStatus($model);
            },
            'filter' => false, // Disable GridView built-in filter, use only search form
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                    $url = ['view', 'id' => $model->id];
                    return Html::a('<span class="fa fa-eye"></span>', $url, [
                        'title' => 'View',
                        'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                        'class' => 'btn btn-primary',
                    ]);
                },
            ]
        ],
    ];

    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => [
            'exportCallback' => function () use ($dataProvider) {
                $exportProvider = clone $dataProvider;
                $exportProvider->pagination = false;
                return $exportProvider;
            },
        ],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id];
        },
        'columns' => $gridColumns,
        'id' => 'grid',
        'containerOptions' => ['style' => 'overflow: auto'],
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export']
            ]
        ],

        'pjax' => true,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => false,
        'floatHeaderOptions' => ['scrollingTop' => true],
        'showPageSummary' => true,
        'panel' => [
            'heading' => '<i class="fa fa-bars"></i>' . Yii::t('yii', 'LIST OF SUBMITTED COMPLAINTS'),
            'type' => GridView::TYPE_SUCCESS,
            'before' => '<span class="text text-primary">' . $this->render('_search', ['model' => $searchModel]) . '</span>',
        ],

        // Export all filtered data, not just current page
        'export' => [
            'fontAwesome' => true,
            'showConfirmAlert' => false,
            'target' => GridView::TARGET_BLANK,
        ],
        'exportConfig' => [
            GridView::PDF => [
                'label' => Yii::t('yii', 'Export All Data'),
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'filename' => Yii::t('yii', 'COMPLAINTS REPORTS'),
                'alertMsg' => Yii::t('yii', 'The PDF export file will be generated for download.'),
                'options' => ['title' => Yii::t('yii', 'Portable Document Format')],
                'config' => [
                    'mode' => 'c',
                    'marginTop' => 50,
                    'marginBottom' => 50,
                    'cssInline' => '.kv-wrap{padding:20px;}' .
                        '.kv-align-center{text-align:center;}' .
                        '.kv-align-left{text-align:left;}' .
                        '.kv-align-right{text-align:right;}' .
                        '.kv-align-top{vertical-align:top!important;}' .
                        '.kv-align-bottom{vertical-align:bottom!important;}' .
                        '.kv-align-middle{vertical-align:middle!important;}' .
                        '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',

                    'methods' => [
                        'SetHeader' => [
                            ['odd' => $pdfHeader, 'even' => $pdfHeader]
                        ],
                        'SetFooter' => [
                            ['odd' => $pdfFooter, 'even' => $pdfFooter]
                        ],
                    ],

                ]
            ],
        ]
    ]);

    ?>
</div>
<style>
    .truncate {
        max-width: 150px !important;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .truncate:hover {
        overflow: visible;
        white-space: normal;
        width: auto;
    }

    .truncate1 {
        max-width: 350px !important;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .truncate1:hover {
        overflow: visible;
        white-space: normal;
        width: auto;
    }
</style>