<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SubscriptionTypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="received-devices-index" style="padding-top: 2%">

    <?php

    $gridColumns = [

        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '36px',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],
        'type_name',
        'type_name_sw',
        [
            'attribute' => 'default',
            'format'=>'html',
            'value' => function ($model) {
                if ($model->default =='1') {
                    return '<span style="color:limegreen;">DEFAULT</span>';
                } elseif ($model->default =='0') {
                    return '<span style="color:red;">NOT DEFAULT</span>';
                } else {
                    return '<span style="color:red;">NOT DEFAULT</span>';
                }
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'template' => '{update}',
            'buttons' => [
                'update' => function ($url, $model) {
                    $url = ['update', 'id' => $model->id];
                    return Html::a('<span class="fa fa-pencil"></span>', $url, [
                        'title' => 'Edit',
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
        'export'=>false,
        'floatHeader' => false,
        'floatHeaderOptions' => ['scrollingTop' => true],
        'showPageSummary' => true,
        'panel' => [
            'heading' => '<i class="fa fa-bars"></i>'.Yii::t('yii','LIST OF SUBSCRIPTION NOTIFICATION'),
            'type' => GridView::TYPE_SUCCESS,
        ],

    ]);
 ?>
</div>

