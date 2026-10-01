<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$member = \frontend\models\Members::findOne(['uid' => Yii::$app->user->identity->getId()]);
$member_name = $member['full_names'];

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'label' => Yii::t('yii','Full Names'),
        'value' =>  'id0.full_names',
    ],
    'member_number',
    [
        'label' => Yii::t('yii','Current Employer'),
        'value' =>function ($model) {
            $member=\frontend\models\Members::find()->where(['uid'=>Yii::$app->user->identity->getId()])->one();
            $employer=\frontend\models\Employments::find()->where(['member_code'=>$member['membership_number']])->one();
            if ($model != '') {
                return $employer['employer_name'];
            }  else {
                return '';
            }
        }
    ],
    [
        'label' => Yii::t('yii','Latest Contribution (Month)'),
        'attribute' => 'cont_month',
        'value' => function($model) {
            $month_num = $model->cont_month;
            $month_name = date("F", mktime(0, 0, 0, $month_num, 10));
            return $month_name;
        }
    ],
    [
        'label' => Yii::t('yii','Latest Contribution (Year)'),
        'attribute' => 'cont_year',
    ],
    [
        'label' => Yii::t('yii','Latest amount Contributed'),
        'attribute'=>'amount',
        'format' => ['decimal',2],
    ],
    [
        'label' => Yii::t('yii','Latest Salary (Tshs)'),
        'attribute'=>'salary',
        'format' => ['decimal',2],
    ],
    [
        'label' => Yii::t('yii','Number of Months Contributed'),
        'value' => 'buffer0.TotalNumberOfContribution'
    ],
    [
        'label' => Yii::t('yii','Total amount Contributed'),
        'format' => ['decimal',2],
        'value' =>  'buffer0.TotalContributions'
    ],
];

// Simple CSS for PDF (inline styles work better with mPDF)
$css = <<<CSS
<style>
    body { font-family: Arial, sans-serif; font-size: 10px; margin: 20px; }
    h2 { text-align: center; color: green; margin-bottom: 10px; }
    h4 { text-align: center; margin: 5px 0; }
    .header-info { margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 9px; }
    th, td { border: 1px solid #333; padding: 5px; text-align: left; }
    th { background-color: #f2f2f2; font-weight: bold; }
    .text-center { text-align: center; }
</style>
CSS;

echo '<html><head>';
echo '<title>MEMBER STATEMENT - ' . $member_number . '</title>';
echo $css;
echo '</head><body>';

echo '<h2>ZSSF - MEMBER STATEMENT</h2>';
echo '<div class="header-info">';
echo '<h4>Member Name: ' . Html::encode($member_name) . '</h4>';
echo '<h4>Member Number: ' . Html::encode($member_number) . '</h4>';
echo '<h4>Date: ' . date('Y-m-d') . '</h4>';
echo '</div>';

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'layout' => '{items}',
    'tableOptions' => ['class' => 'table table-bordered table-striped'],
    'export' => false,
    'showOnEmpty' => false,
]);

echo '</body></html>';
