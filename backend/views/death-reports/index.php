<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeathReportsSeacrh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pensioners Death Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="death-reports-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       <!-- <?= Html::a('Create Death Reports', ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'date_time',
            'member_number',
            'pensioner_number',
            'death_date',
            //'death_place',
            //'death_cause',
            //'death_certificate',
            //'current_status_id',
            //'type',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
