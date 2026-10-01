<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ContributionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Contributions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contributions-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'date_time',
            'member_number',
            'cont_month',
            'cont_year',
            'amount',
            'salary',
            'transaction_id',
            'contributing_period',
            'latest_updated',
        ],
    ]); ?>


</div>
