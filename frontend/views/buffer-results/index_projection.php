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


 //   print_r($resullts['benefitsCalculations']);


    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        //   'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'id',
                'label' => Yii::t('yii', 'Average salary'),
               // 'format' => ['decimal', 2],
                'value' => function ($model) {
                    if ($model->id != ''){
                        $resullts = BufferResults::getProjection();
                        return $resullts['benefitsCalculations']['current_salary'];

                    }
                }

            ],
            [
                'attribute' => 'id',
                'label' => Yii::t('yii', 'Number of Months contributed'),
                'value' => function ($model) {
                    if ($model->id != ''){
                        $resullts = BufferResults::getProjection();
                        return $resullts['benefitsCalculations']['total_months_contributed'];

                    }
                }

            ],
            [
                'attribute' => 'id',
                //  'value'=>$model->BestAverageEarning * 0.38,
                'label' => Yii::t('yii', ' Pension'),
              //  'format' => ['decimal', 2],
                'value' => function ($model) {
                    if ($model->id != ''){
                        $resullts = BufferResults::getProjection();

                        return $resullts['benefitsCalculations']['pension'];

                    }
                }
            ],
            [
                'attribute' => 'Gratuity',
               // 'format' => ['decimal', 2],
                'value' => function ($model) {
                    if ($model->id != ''){
                        $resullts = BufferResults::getProjection();

                        return $resullts['benefitsCalculations']['partial_gratuity'];
                    }
                }
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
