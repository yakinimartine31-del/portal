<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CommonZssfSettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Maternity Benefit');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="common-zssf-settings-index">

    <?php echo $this->render('_searchResults', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //  'filterModel' => $searchModel,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //  'id',
            //   'date_time',
            //   'best_average_earning_months',

            [
                'attribute' => 'maternity_fixed_amount',
                'value' => function ($model) {
                    if (!Yii::$app->user->isGuest) {
                        $member = \frontend\models\Members::find()->where(['uid' => Yii::$app->user->identity->getId()])->one();
                        $months = \frontend\models\BufferResults::findOne(['member_number' => $member['membership_number']]);
                        if (!empty($months)) {
                            return $months->TotalNumberOfContribution;
                        } else {
                            return '0';
                        }
                    } else {
                        return '0';
                    }
                },

                'label' => Yii::t('yii', 'Total number of months contributed'),
            ], [
                'attribute' => 'maternity_fixed_amount',
                'format' => ['decimal', 2],
            ],
            [
                'attribute' => 'maternity_for_twins',
                'format' => ['decimal', 2],
            ],

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

            //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
