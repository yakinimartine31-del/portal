<?php


use backend\models\ZssfMembers;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComplaintsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = Yii::t('yii', 'List of Verification Agent');
?>
<div class="clerk-deni-index" style="padding-top: 10px">

    <?php $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $pdfHeader = [
        'L' => [
            'content' => Yii::t('yii', 'Verification Agent'),
        ],
        'C' => [
            'content' => Html::a(Html::img('../images/login.png', ['alt' => 'image', 'class' => 'image', 'height' => '80'])) . '<br>' . Yii::t('yii', 'LIST USERS LOGIN ACCOUNTS') . '<br>',
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
        // 'name',
        'username',
        //   'profile_picture',
        'email:email',
        [
            'attribute' => 'id',
            'label' => 'Role Assigned',
            'value' => function($model){
                return $model->role0 ? $model->role0->item_name : '-';
            }
        ],
        //  'block',
        //   'status',
        //   'sendEmail:email',
        'registerDate',
        [
            'attribute' => 'id',
            'label'=>"Device Number",
            'value' => function($model){
                static $membersCache = [];
                if(isset($membersCache[$model->id])){
                    return $membersCache[$model->id]->device_number ?? '';
                }
                $member=ZssfMembers::findOne(['uid'=>$model->id]);
                $membersCache[$model->id] = $member;
                return $member ? $member->device_number : '';
            }
        ],
        [
            'attribute' => 'id',
            'label'=>"Gender",
            'value' => function($model){
                static $membersCache = [];
                if(isset($membersCache[$model->id])){
                    return $membersCache[$model->id]->gender ?? '';
                }
                $member=ZssfMembers::findOne(['uid'=>$model->id]);
                $membersCache[$model->id] = $member;
                return $member ? $member->gender : '';
            }
        ],
//        [
//            'attribute' => 'id',
//            'label'=>"Marital Status",
//            'value' => function($model){
//                $member=ZssfMembers::findOne(['uid'=>$model->id]);
//                if($member){
//                    return $member->marital_status;
//                }
//            }
//        ],
        [
            'attribute' => 'id',
            'label'=>"Mobile Number",
            'value' => function($model){
                static $membersCache = [];
                if(isset($membersCache[$model->id])){
                    return $membersCache[$model->id]->mobile_number ?? '';
                }
                $member=ZssfMembers::findOne(['uid'=>$model->id]);
                $membersCache[$model->id] = $member;
                return $member ? $member->mobile_number : '';
            }
        ],
        [
            'attribute' => 'id',
            'label'=>"Mobile Phone of Who Come Behalf of Pensioner",
            'value' => function($model){
                static $membersCache = [];
                if(isset($membersCache[$model->id])){
                    return $membersCache[$model->id]->mobile_phone_of_who_come_behalf_of_pensioner ?? '';
                }
                $member=ZssfMembers::findOne(['uid'=>$model->id]);
                $membersCache[$model->id] = $member;
                return $member ? $member->mobile_phone_of_who_come_behalf_of_pensioner : '';
            }
        ],
        [
            'attribute' => 'id',
            'label'=>"Address",
            'value' => function($model){
                static $membersCache = [];
                if(isset($membersCache[$model->id])){
                    return $membersCache[$model->id]->address ?? '';
                }
                $member=ZssfMembers::findOne(['uid'=>$model->id]);
                $membersCache[$model->id] = $member;
                return $member ? $member->address : '';
            }
        ],
        [
            'attribute' => 'created_by',
            'label' => 'Created By',
            'value' => function($model){
                return $model->createdBy ? $model->createdBy->name : '';
            }
        ],
//        [
//            'attribute' => 'id',
//            'label'=>'Region',
//            'value' => function($model){
//                $member=ZssfMembers::findOne(['uid'=>$model->id]);
//                if($member){
//                    return $member->region;
//                }
//            }
//        ],
//        [
//            'attribute' => 'id',
//            'label'=>'District',
//            'value' => function($model){
//                $member=ZssfMembers::findOne(['uid'=>$model->id]);
//                if($member){
//                    return $member->district;
//                }
//            }
//        ],
//        [
//            'attribute' => 'id',
//            'label'=>'shehia',
//            'value' => function($model){
//                $member=ZssfMembers::findOne(['uid'=>$model->id]);
//                if($member){
//                    return $member->shehia;
//                }
//            }
//        ],

//        [
//            'attribute' => 'staff_login',
//            'format' => 'html',
//            'value' => function ($model) {
//                if ($model->staff_login == '1') {
//                    return '<span style="color:limegreen;">ACTIVATED</span>';
//                } elseif ($model->staff_login == '0') {
//                    return '<span style="color:red;">DEACTIVATED</span>';
//                } else {
//                    return '<span style="color:red;">DEACTIVATED</span>';
//                }
//            }
//        ],


//        'params:ntext',
//        'lastResetTime',
//        'resetCount',
//        'otpKey',
//        'otep',
//        'requireReset',
//        'create_at',
//        'updated_at',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'template' => '{view}',
            // 'visible' => yii::$app->user->can('applyForUinCertificate'),
            'buttons' => [
                'view' => function ($url, $model) {
                    $url = ['view-sheha', 'id' => $model->id];
                    return Html::a('<span class="fa fa-eye"></span>', $url, [
                        'title' => 'View',
                        'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                        'class' => 'btn btn-info',

                    ]);


                },

            ]
        ],

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
        'toolbar' => [

            ['content' =>
             //   Html::beginForm(['users/new'],'post'),
                Html::button("<span class='fa fa-plus' aria-hidden='true'></span>",
                    ['class' => 'btn btn-success',
                        'onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['users/new-agent']) . "';",
                        'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to create new verification Agent ?'),
                        'method' => 'post',

                    ],
                        'data-toggle' => 'tooltip',
                        'title' => Yii::t('app', 'Create New User'),
                    ]
                ),
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['new-agent'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Reset Grid'])
            ],
            '{toggleData}',
            '{export}',
        ],
        'panel' => [
            'heading' => '<i class="fa fa-bars"></i>' . Yii::t('yii', 'LIST ALL REGISTERED VERIFICATION AGENTS'),
            'type' => GridView::TYPE_SUCCESS,
            'before' => '<span class="text text-primary">' . $this->render('_searchSheha', ['model' => $searchModel]) . '</span>',
        ],
        'exportConfig' => [
            GridView::PDF => [
                'label' => Yii::t('yii', 'Export All Data'),
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'filename' => Yii::t('yii', 'LIST ALL REGISTERED VERIFICATION AGENTS'),
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

    .truncate:hover {
        overflow: visible;
        white-space: normal;
        width: auto;
    }
</style>
