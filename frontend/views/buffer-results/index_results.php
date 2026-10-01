<?php

use frontend\models\Members;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BufferResultsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Test Benefit');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buffer-results-index">

    <?php echo $this->render('_searchResults', ['model' => $searchModel]); ?>
    <?php

        echo     \kartik\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            //   'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                [
                    'attribute' => 'type',
                    'value' => function ($model) {
                        if ($model->type == 1) {
                            return Yii::t('yii','Old Age');
                        } elseif ($model->type == 2) {
                            return Yii::t('yii','Invalidity');
                        } elseif ($model->type == 3) {
                            return Yii::t('yii','Survivor');
                        }
                    }
                ],
                [
                    'attribute'=>'TotalNumberOfContribution',
                ],
                [
                    'attribute'=>'TotalContributions',
                    'format' => ['decimal',2],
                ],
                [
                    'attribute'=>'Gratuity',
                    'format' => ['decimal',2],
                ],
                [
                    'attribute'=>'MonthlyPension',
                    'format' => ['decimal',2],
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
