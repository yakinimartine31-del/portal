<?php

use frontend\models\ContributionsSearch;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
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
                <div class="panel-heading">
                    <div class="panel-title text-center" style="color: green">
                        <?= Yii::t('yii', 'MEMBER STATEMENT OF CONTRIBUTION INFORMATION') ?>
                    </div>
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
                        'content' => Html::a(Html::img('images/login.png', ['alt' => 'image', 'class' => 'image', 'height' => '80'])) . '<br>' . 'CONTRIBUTION REPORT' . '<br>' . 'MEMBER NAME: ' . $member_name . '<br>' . 'MEMBER NUMBER: ' . $member_number,
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
                <?php
                $searchModel = new ContributionsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $gridColumns = [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => Yii::t('yii','Full Names'),
                        'value' =>  'id0.full_names',
                    ],
                    'member_number',
                    [
                        'label' => Yii::t('yii','Current Employer'),
                        // 'value' =>  $model->memberNumber->employer_name,
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

                    'cont_month',
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
                        'value' => 'buffer0.TotalNumberOfContribution'
                    ],
                    [
                        'label' => Yii::t('yii','Total amount Contributed'),
                        'format' => ['decimal',2],
                        'value' =>  'buffer0.TotalContributions'
                    ],
                ];
                echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'target' => ExportMenu::TARGET_BLANK,
                    'showConfirmAlert' => true,

                    'filename' =>'MEMBER STATEMENT-'.$member_number,

                    'dropdownOptions' => [
                        'label' => Yii::t('yii','Export'),
                        'class' => 'btn btn-info',
                        'export' => true,
                        'itemsBefore' => [
                            '<div class="dropdown-header">'.Yii::t('yii','Export All Data').'</div>',
                        ],

                    ],
                    'exportConfig'=>[
                        ExportMenu::FORMAT_HTML=>false,
                        ExportMenu::FORMAT_TEXT=>false,
                        ExportMenu::FORMAT_EXCEL=>false,
                        ExportMenu::FORMAT_CSV=>false,
                        ExportMenu::FORMAT_EXCEL_X=>false,

                    ],
                ]);

                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        //'id',
                      //  'date_time',
                        [
                            'label' => Yii::t('yii','Full Names'),
                            'value' =>  $model->id0->full_names
                        ],
                        'member_number',
                        [
                            'label' => Yii::t('yii','Current Employer'),
                           // 'value' =>  $model->memberNumber->employer_name,
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

                        'cont_month',
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
                        //'transaction_id',
                      //  'contributing_period',
                     //   'latest_updated',
                    ],
                ])


                ?>

            </div>
        </div>
    </div>
</div>