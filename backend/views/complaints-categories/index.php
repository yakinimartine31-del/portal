<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComplaintsCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = $this->title;
$model = new \backend\models\ComplaintsCategories();
?>
<div class="clerk-deni-index" style="padding-top: 10px">

    <?php $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '36px',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],
        //  'date_time',
        'category_name',
        'recepient_email',
        [
            'attribute' => 'status',
            'value' => function ($model) {
                if ($model->status == '1') {
                    return 'ACTIVE';
                } elseif ($model->status == '0') {
                    return 'IN ACTIVE';
                } else {
                    return '';
                }
            }
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
        'export' => false,
        'floatHeader' => false,
        'floatHeaderOptions' => ['scrollingTop' => true],
        'showPageSummary' => true,
        'panel' => [
            'heading' => '<i class="fa fa-bars"></i>' . Yii::t('yii', 'LIST OF COMPLAINTS CATEGORY'),
            'type' => GridView::TYPE_SUCCESS,
            'before' => '<span class="text text-primary">' . Html::a(Yii::t('yii', 'New Category', [
                    'modelClass' => 'details',
                ]), ['create'], ['class' => 'btn btn-success', 'id' => 'popupModal']) . '</span>',
        ],

    ]);

    ?>
</div>

