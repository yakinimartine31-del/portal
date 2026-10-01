<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ComplaintsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Complaints List');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaints-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'date_time',
            [
                'attribute' => 'zssf_number',
                'contentOptions' => ['class' => 'truncate'],
            ],
            [
                'attribute' => 'subject',
                'contentOptions' => ['class' => 'truncate'],
            ],

            [
                'attribute' => 'category',
                'value'=>'category0.category_name'
            ],
        [
            'attribute' => 'message',
            'contentOptions' => ['class' => 'truncate'],
        ],
       //     'message:ntext',
            [

                'attribute' => 'photo_file',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->photo_file == null) {
                        return '';
                    } elseif ($model->photo_file != null) {
                        $basepath = Yii::$app->request->baseUrl . '/../../api/' . $model->photo_file;
                        //$path = str_replace($basepath, '', $model->attachment);
                        return Html::a('<i class="fa fa-file text-green"></i>', $basepath, ['target' => '_blank', 'data-pjax' => "0"]);


                    }
                }
            ],
            [
                'attribute' => 'response_message',
                'contentOptions' => ['class' => 'truncate'],
            ],
            //  'email_address:email',
            //  'phone_number',
          //  'response_message:ntext',
            'status_type:ntext',


         //   ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
<style>
    .truncate {
        max-width: 100px !important;
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