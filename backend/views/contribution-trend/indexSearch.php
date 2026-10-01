
<?php


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComplaintsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title ='';
$this->params['breadcrumbs'][] = Yii::t('yii', 'Members Contributions');
?><div class="clerk-deni-index" style="padding-top: 10px">
    <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
            SEARCH FOR ZSSF MEMBERS CONTRIBUTIONS
        </div>

    </div>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
<hr style="color: greenyellow">
<div class="clerk-deni-index" style="padding-top: 10px">

    <?php  $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $pdfHeader = [
        'L' => [
            'content' =>Yii::t('yii','MEMBERS CONTRIBUTIONS'),
        ],
        'C' => [
            'content' => Html::a(Html::img('../images/login.png', ['alt' => 'image', 'class' => 'image', 'height' => '80'])) . '<br>' .  Yii::t('yii','LIST ZSSF MEMBERS CONTRIBUTIONS') . '<br>',
            //  'content' => 'ZSSF REPORT FOR MEMBER ' . $member_name . '(' . $member_number . ')',
            'font-size' => 10,
            'font-style' => 'B',
            'font-family' => 'arial',
            'height' => 119,
            'color' => '#333333'
        ],

        'R' => [
            'content' => Yii::t('yii','Date:') . date('Y-m-d'),
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
        [
            'label' => 'Full Names',
            'value' => 'member0.full_names'
        ],
        [
            'label' => 'Member Number',
            'value' => 'member0.membership_number'
        ],
      //  'member_number',
        'ContributionYear',
//        'JANUARY',
//        'FEBRUARY',
        //'MARCH',
        //'APRIL',
        //'MAY',
        //'JUNE',
        //'JULY',
        //'AUGUST',
        //'SEPTEMBER',
        //'OCTOBER',
        //'NOVEMBER',
        //'DECEMBER',
        'JANUARYC',
        'FEBRUARYC',
        'MARCHC',
        'APRILC',
        'MAYC',
        'JUNEC',
        'JULYC',
        'AUGUSTC',
        'SEPTEMBERC',
        'OCTOBERC',
        'NOVEMBERC',
        'DECEMBERC',
        [
            'attribute' => 'AnnualMonthsContributed',
            'pageSummary' => true,
        ],
        [
            'attribute' => 'AnnualSalaryContributed',
            'pageSummary' => true,
        ],
        [
            'attribute' => 'AnnualTotalContributed',
            'pageSummary' => true,
        ],
        'date_time',
    ];

    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id];
        },
        'columns' => $gridColumns,
        'id' => 'grid',
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export'] // remove this row from export
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
            'heading' => '<i class="fa fa-bars"></i>'.Yii::t('yii','LIST OF ZSSF MEMBERS CONTRIBUTIONS'),
            'type' => GridView::TYPE_SUCCESS,

        ],
        'exportConfig' => [
            GridView::PDF => [
                'label' => Yii::t('yii', 'Export All Data'),
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'filename' => Yii::t('yii', 'LIST ZSSF MEMBERS'),
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
        max-width: 250px !important;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .truncate:hover{
        overflow: visible;
        white-space: normal;
        width: auto;
    }
</style>

