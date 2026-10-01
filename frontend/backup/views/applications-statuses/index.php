<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ApplicationsStatusesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Applications Statuses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applications-statuses-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'id',
           // 'date_time',
            'application_date',
         //   'benefit_type',
          //  'employer_number',
            'processing_stage_name',
            'application_status',
            //'payment_date',
            //'member_number',

          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
