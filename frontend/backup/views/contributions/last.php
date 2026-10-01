<?php

use frontend\models\ContributionTrend;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;

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
            'header' => Yii::t('yii','Full Names'),
            'value' =>  'id0.full_names',
            'headerOptions' => ['style'=>'color:#4cb6de'],
        ],
        'member_number',
        [
            'headerOptions' => ['style'=>'color:#4cb6de'],
            'label' => Yii::t('yii','Current Employer'),
            // 'value' =>  $model->memberNumber->employer_name,
            'value' =>function ($model) {
                $member=\frontend\models\Members::find()->where(['uid'=>Yii::$app->user->identity->getId()])->one();
                $employer=\frontend\models\Employments::find()->where(['member_code'=>$member['membership_number']])->one();
                if ($model != '') {
                    return $employer['employer_name'];
                }  else {
                    return '';
                }
            }
        ],

        'cont_month',
        'cont_year',

        [
            'attribute'=>'amount',
            'format' => ['decimal',2],
        ],
        [
            'attribute'=>'salary',
            'format' => ['decimal',2],
        ],
        [
            'label' => Yii::t('yii','Number of Months Contributed'),
            'value' => 'buffer0.TotalNumberOfContribution',
            'headerOptions' => ['style'=>'color:#4cb6de'],
        ],
        [
            'label' => Yii::t('yii','Total amount Contributed'),
            'format' => ['decimal',2],
            'value' =>  'buffer0.TotalContributions',
            'headerOptions' => ['style'=>'color:#4cb6de'],
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
            'heading' => Yii::t('yii', 'MEMBER STATEMENT'),
           // 'before' => '<span class="text text-primary">' . $this->render('_search', ['model' => $searchModel]) . '</span>',

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

