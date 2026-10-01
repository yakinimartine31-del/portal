<?php
ini_set('memory_limit', '-1');
ini_set('pcre.backtrack_limit', '100000000');
ini_set('pcre.recursion_limit', '100000000');

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;

use backend\models\SysPensionersVerificationsLogs;
use yii\helpers\Url;
use yii\grid\ActionColumn;


/** @var yii\web\View $this */
/** @var backend\models\SysPensionersVerificationsLogsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pensioners Verifications Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clerk-deni-index" style="padding-top: 10px">

    <?php $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $pdfHeader = [
        'L' => [
            'content' => Yii::t('yii', 'logs REPORT'),
        ],
        'C' => [
            'content' => Html::a(Html::img('../images/login.png', ['alt' => 'image', 'class' => 'image', 'height' => '80'])) . '<br>' . 'COMPLAINTS REPORT' . '<br>',
            //  'content' => 'ZSSF REPORT FOR MEMBER ' . $member_name . '(' . $member_number . ')',
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
            //'content' => 'RIGHT CONTENT (FOOTER)',
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


        //'id',
        'date_time',
        //'uid',
        'pension_number',
        'full_names',
        'verification_code',
        //'code_expiry_date',
        //'sent_date_time',
        'batch_code',
        //'kin_mobile_number',
        //'verified_by_uid',
        'verified_date_time',
        'verification_status',
        'checker_remarks:ntext',
        'date_renewed',
        'start_date',
        'expiry_date',
        'verified_location',
        'verified_by',
        'pensioner_phone_no',
        'mobile_phone_of_who_come_behalf_of_pensioner',

    ];

    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
         'filterModel' => $searchModel,
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
        'toolbar' => [
            [
                'content' => Html::a('<i class="fa fa-file-pdf-o"></i> PDF', array_merge(['export', 'format' => 'pdf'], $queryParams ?? []), [
                    'class' => 'btn btn-danger btn-sm',
                    'title' => Yii::t('yii', 'Export All Data to PDF'),
                    'target' => '_blank',
                    'data-pjax' => '0',
                ]) . ' ' .
                Html::a('<i class="fa fa-file-excel-o"></i> Excel', array_merge(['export', 'format' => 'excel'], $queryParams ?? []), [
                    'class' => 'btn btn-success btn-sm',
                    'title' => Yii::t('yii', 'Export All Data to Excel'),
                    'target' => '_blank',
                    'data-pjax' => '0',
                ]) . ' ' .
                Html::a('<i class="fa fa-file-text-o"></i> CSV', array_merge(['export', 'format' => 'csv'], $queryParams ?? []), [
                    'class' => 'btn btn-info btn-sm',
                    'title' => Yii::t('yii', 'Export All Data to CSV'),
                    'target' => '_blank',
                    'data-pjax' => '0',
                ]),
            ],
        ],
        'panel' => [
            'heading' => '<i class="fa fa-bars"></i>' . Yii::t('yii', 'Pensioners Verifications Logs'),
            'type' => GridView::TYPE_SUCCESS,
        ],

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
