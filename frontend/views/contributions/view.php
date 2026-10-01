<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Contributions */

$this->title = $model->member_number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Contributions'), 'url' => ['view']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="content-row">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info" data-collapsed="0">

                    <div class="panel-title text-center" style="color: green">
                        <?= Yii::t('yii', 'MEMBER STATEMENT') ?>
                    </div>

                <hr>
                <?php
                if (!Yii::$app->user->isGuest) {
                    $id = Yii::$app->user->identity->getId();
                    $member = \frontend\models\Members::find()->where(['uid' => $id])->one();
                    $member_number = $member['membership_number'];
                    $member_name = $member['full_names'];
                    $member_sys_id = $member['member_sys_id'];
                }
                $pdfHeader = [
                    'L' => [
                        'content' => 'ZSSF',
                    ],
                    'C' => [
                        'content' => 'CONTRIBUTION REPORT' . '<br>' . 'MEMBER NAME: ' . $member_name . '<br>' . 'MEMBER NUMBER: ' . $member_number,
                        //  'content' => 'ZSSF REPORT FOR MEMBER ' . $member_name . '(' . $member_number . ')',
                        'font-size' => 10,
                        'font-style' => 'B',
                        'font-family' => 'arial',
                        'height' => 119,
                        'color' => '#333333'
                    ],
                    'R' => [
                        'content' => 'Contribution Report:' . date('Y-m-d'),
                    ],
                    'line' => true,
                ];

                $pdfFooter = [
                    'L' => [
                        'content' => '&copy; ZSSF',
                        'font-size' => 10,
                        'color' => '#333333',
                        'font-family' => 'arial',
                    ],
                    'C' => [
                        'content' => '',
                    ],
                    'R' => [
                        //'content' => 'RIGHT CONTENT (FOOTER)',
                        'font-size' => 10,
                        'color' => '#333333',
                        'font-family' => 'arial',
                    ],
                    'line' => true,
                ];
                ?>
                
                <div style="text-align: right; margin-bottom: 10px;">
                    <?= Html::a('<i class="fa fa-download"></i> ' . Yii::t('yii', 'Print/Export'), 
                        ['export-pdf', 'member_number' => $member_number], 
                        ['class' => 'btn btn-info', 'target' => '_blank']
                    ) ?>
                </div>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'label' => Yii::t('yii','Full Names'),
                            'value' =>  $model->id0->full_names
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
                             'attribute'=>'cont_month',
                            'value'=>function($model){
                                $month_num = $model->cont_month;
                                $month_name = date("F", mktime(0, 0, 0, $month_num, 10));
                                return $month_name;
                            }
                        ],
                        'cont_year',
                        [
                            'attribute'=>'amount',
                            'format' => ['decimal',2],
                        ],
                        [
                            'attribute'=>'salary',
                            'format' => ['decimal',2],
                        ],
                        [
                            'label' => Yii::t('yii','Number of Months Contributed'),
                            'value' =>  $model->buffer0->TotalNumberOfContribution
                        ],
                        [
                            'label' => Yii::t('yii','Total amount Contributed'),
                            'format' => ['decimal',2],
                            'value' =>  $model->buffer0->TotalContributions
                        ],
                    ],
                ]) ?>



            </div>
        </div>
    </div>
</div>
