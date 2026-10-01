<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommonZssfSettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Common Zssf Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="common-zssf-settings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date_time',
            'best_average_earning_months',
            'maternity_fixed_amount',
            'maternity_for_twins',
            //'complaints_email_address:email',
            //'percentage_deducted_on_refund',
            //'refund_best_average_earning',
            //'hq_mobile_number',
            //'pemba_mobile_number',
            //'contact_email:email',
            //'max_calculator_months',
            //'max_calculator_years',
            //'unguja_phone_number',
            //'employer_percentge',
            //'employee_percentage',
            //'facebook_link',
            //'twitter_link',
            //'instagram_link',
            //'pemba_cordinates',
            //'unguja_cordinates',
            //'youtube_link',
            //'host_server',
            //'db_user',
            //'db_password',
            //'database_name',
            //'footer_message:ntext',
            //'head_office_fax_number',
            //'pemba_fax_number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
