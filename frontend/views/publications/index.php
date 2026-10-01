<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PublicationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Publications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publications-index"style="padding-bottom: 170px">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //  'filterModel' => $searchModel,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //   'id',
            //    'date_time',
            'publication_type:ntext',
            'title',
            //  'publication:ntext',
            //'publication_date',
            [
                'attribute' => 'id',
                'format'=>'html',
                'label' => '',
                   'value' => function ($model) {
                    return Html::a(Yii::t('yii','Read more'), ['view', 'id' => $model->id]);

                },

            ]

            //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
