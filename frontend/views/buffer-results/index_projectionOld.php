<?php

use frontend\models\BufferResults;
use frontend\models\Contributions;
use frontend\models\Members;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BufferResultsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'PROJECTION');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buffer-results-index">

    <?php echo $this->render('_searchProjection', ['model' => $searchModel]); ?>
<!--    Kwa mfano huyu Wardat-->
    <!--    Months - 336-->
    <!--    Years - (336/12) - 28-->
    <!---->
    <!--    ($gross_salary * (36 + (2 * ($years - 13)))) / 100;-->
    <!--    (1037000.00 * (36 + (2 * (28 - 13)))) / 100;-->
    <!--    = 684,420-->

    <?php
   // $user = \Yii::$app->user->identity->getId();
  //  $member_number = Members::find()->where(['uid' => $user])->one();

    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        //   'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'id',
                'label' => Yii::t('yii', 'Average salary'),
                'format' => ['decimal', 2],
                'value' => function ($model) {
                    if ($model->type == 1) {
                        $user = \Yii::$app->user->identity->getId();
                        $member_number = Members::find()->where(['uid' => $user])->one();
                        $salary = Contributions::find()->where(['member_number' => $member_number['membership_number']])->one();
                        return $salary['salary'];
                    } else {
                        return '0';
                    }
                }
            ],
            [
                'attribute' => 'id',
                'label' => Yii::t('yii', 'Number of Months contributed'),
                 'value'=> function ($model) {
                    if ($model->BestAverageEarning != '') {
                        $user=\Yii::$app->user->identity->getId();
                        $member_number=Members::find()->where(['uid'=>$user])->one();
                        $contribute_months = BufferResults::find()->where(['member_number' => $member_number['membership_number']])->one();
                        $contribute_amount=$contribute_months['TotalNumberOfContribution'];

                        $date=date_create( $member_number['date_of_birth']); // or your date string
                        date_add($date,date_interval_create_from_date_string("60 years"));// add number of days
                        $expect_year= date_format($date,"Y");
                        $expect_month= date_format($date,"m");

                        $current_year=date('Y');
                        $current_month=date('m');

                        $remaining_year_to_months=($expect_year - $current_year)*12;
                        $remaining_month=$expect_month -$current_month;
                        $total_remaining=$remaining_year_to_months + $remaining_month + $contribute_amount;

                        return $total_remaining;
                    } else {
                        return '0.00';
                    }
                },
            ],
            [
                'attribute' => 'id',
                'value' => function ($model) {
                    if ($model->BestAverageEarning != '') {
                        $user = \Yii::$app->user->identity->getId();
                        $member_number = Members::find()->where(['uid' => $user])->one();
                        $salary = Contributions::find()->where(['member_number' => $member_number['membership_number']])->one();
                        $gross_salary=$salary['salary'];

                        $contribute_months = BufferResults::find()->where(['member_number' => $member_number['membership_number']])->one();
                        $contribute_amount=$contribute_months['TotalNumberOfContribution'];

                        $date=date_create( $member_number['date_of_birth']); // or your date string
                        date_add($date,date_interval_create_from_date_string("60 years"));// add number of days
                        $expect_year= date_format($date,"Y");
                        $expect_month= date_format($date,"m");

                        $current_year=date('Y');
                        $current_month=date('m');

                        $remaining_year_to_months=($expect_year - $current_year)*12;
                        $remaining_month=$expect_month -$current_month;
                        $total_remaining_months=$remaining_year_to_months + $remaining_month + $contribute_amount;

                        $years=$total_remaining_months/12;
                        $pension = ($gross_salary * (36 + (2 * ($years - 13)))) / 100;
                        return $pension;
                    } else {
                        return '0.00';
                    }
                },
                //  'value'=>$model->BestAverageEarning * 0.38,
                'label' => Yii::t('yii', ' Pension'),
                'format' => ['decimal', 2],
            ],
            [
                'attribute' => 'Gratuity',
                'value' => function ($model) {
                    if ($model->Gratuity != '') {
                        $user = \Yii::$app->user->identity->getId();
                        $member_number = Members::find()->where(['uid' => $user])->one();
                        $salary = Contributions::find()->where(['member_number' => $member_number['membership_number']])->one();
                        $gross_salary=$salary['salary'];
                        $contribute_months = BufferResults::find()->where(['member_number' => $member_number['membership_number']])->one();
                        $contribute_amount=$contribute_months['TotalNumberOfContribution'];

                        $date=date_create( $member_number['date_of_birth']); // or your date string
                        date_add($date,date_interval_create_from_date_string("60 years"));// add number of days
                        $expect_year= date_format($date,"Y");
                        $expect_month= date_format($date,"m");

                        $current_year=date('Y');
                        $current_month=date('m');

                        $remaining_year_to_months=($expect_year - $current_year)*12;
                        $remaining_month=$expect_month -$current_month;
                        $total_remaining_months=$remaining_year_to_months + $remaining_month + $contribute_amount;

                        $years=$total_remaining_months/12;
                        $pension = ($gross_salary * (36 + (2 * ($years - 13)))) / 100;
                        $Gratuity = $pension * 60;
                        return $Gratuity;
                    } else {
                        return '0.00';
                    }
                },
                'format' => ['decimal', 2],
            ],

            //'Refund',
            //'ContBeforeRetirement',
            //'MONTHLYPENSIONCALCULATED',
            //'MPFormula',
            //'MPFormulawnumber',
            //'GTFormula',
            //'GTFormulawnumber',
            //'RFFormula',
            //'RFFormulawnumber',
            //'member_number',
            //'type',
            //'latest_contribution',
            //'latest_updated',

            //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);


    ?>


</div>
