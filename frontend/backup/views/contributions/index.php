<?php

use frontend\models\ContributionTrend;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ContributionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Contributions');
$this->params['breadcrumbs'][] = $this->title;

if (!Yii::$app->user->isGuest) {
    $id = Yii::$app->user->identity->getId();
    $member = \frontend\models\Members::find()->where(['uid' => $id])->one();
    $member_number = $member['membership_number'];
    $member_name = $member['full_names'];
    $member_sys_id = $member['member_sys_id'];
}
?><div class="contribution-trend-index">

    <?php
    $pdfHeader = [
        'L' => [
            'content' => 'ZSSF',
        ],
        'C' => [
            'content' => Html::a(Html::img('images/login.png', ['alt' => 'image', 'class' => 'image', 'height' => '80'])) . '<br>' . 'CONTRIBUTION REPORT' . '<br>' . 'MEMBER NAME: ' . $member_name . '<br>' . 'MEMBER NUMBER: ' . $member_number,
            //  'content' => 'ZSSF REPORT FOR MEMBER ' . $member_name . '(' . $member_number . ')',
            'font-size' => 10,
            'font-style' => 'B',
            'font-family' => 'arial',
            'height' => 119,
            'color' => '#333333'
        ],
        'R' => [
            'content' => 'Contribution Report:' . date('Y-m-d'),
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

    <?php

    $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '36px',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],
        [
            'attribute' => 'ContributionYear',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(ContributionTrend::find()->where(['member_id' => $member_sys_id])->asArray()->all(), 'ContributionYear', 'ContributionYear'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => Yii::t('yii', 'Year')],
        ],
        [
            'attribute' => 'JANUARYC',
            'format' => ['decimal', 2],
        ],
        [
            'attribute' => 'FEBRUARYC',
            'format' => ['decimal', 2],
        ],
        [
            'attribute' => 'MARCHC',
            'format' => ['decimal', 2],
        ],
        [
            'attribute' => 'APRILC',
            'format' => ['decimal', 2],
        ],
        [
            'attribute' => 'MAYC',
            'format' => ['decimal', 2],
        ],


        [
            'attribute' => 'JUNEC',
            'format' => ['decimal', 2],
        ],
        [
            'attribute' => 'JULYC',
            'format' => ['decimal', 2],
        ],

        [
            'attribute' => 'AUGUSTC',
            'format' => ['decimal', 2],
        ],
        [
            'attribute' => 'SEPTEMBERC',
            'format' => ['decimal', 2],
        ],
        [
            'attribute' => 'OCTOBERC',
            'format' => ['decimal', 2],
        ],
        [
            'attribute' => 'NOVEMBERC',
            'format' => ['decimal', 2],
        ],
        [
            'attribute' => 'DECEMBERC',
            'format' => ['decimal', 2],
        ],

    ];


    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //  'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'id' => 'grid',
        'toolbar' => [
            '{toggleData}',
            '{export}',

        ],
        'summary' => '',
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

        //   'floatHeader' => true,

        //   'floatHeaderOptions' => ['scrollingTop' => true],
        'showPageSummary' => true,
        'panel' => [
            //  'type' => GridView::TYPE_INFO,
            'heading' => Yii::t('yii', 'MEMBER CONTRIBUTION INFORMATION'),
            'before' => '<span class="text text-primary">' . $this->render('_search', ['model' => $searchModel]) . '</span>',

        ],
        'rowOptions' => function ($model) {
            return ['data-id' => $model->id];
        },
        'exportConfig' => [
            GridView::PDF => [
                'label' => Yii::t('yii', 'Export All Data'),

                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'filename' => Yii::t('yii', 'Member statement-') . $member_number,
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
<div class="contributions-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date_time',
            [
                'attribute' => 'id',
                'value' =>  'id0.full_names',
            ],
            'member_number',
            'cont_month',
            'cont_year',
            //'amount',
            //'salary',
            //'transaction_id',
            //'contributing_period',
            //'latest_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
