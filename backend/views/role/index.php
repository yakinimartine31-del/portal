<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Roles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index" style="padding-top: 20px">
    <div class="row">
        <div class="col-lg-8">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?php
                if (Yii::$app->user->can('createNewRole')){
                    echo Html::a(Yii::t('app', 'Create ') . Yii::t('app', 'Role'), ['create'], ['class' => 'btn btn-success']) ;
                }
                ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    //  ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'name',
                    ],
                    'description',
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template' => '{view}{update}',
//                'header' => 'Actions',
//             //   'visible' => yii::$app->user->can('createEmployee'),
//
//            ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view}&nbsp;&nbsp;&nbsp;&nbsp;{update}',
                        // 'visible'=>Yii::$app->user->can('accountantApproval'),
                        'buttons' => [
                            'view' => function ($url, $model) {
                                $url = ['role/view', 'name' => $model->name];
                                return Html::a('<span class="fa fa-eye"></span>', $url, [
                                    'title' => 'View',
                                    'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                                    'class' => 'btn btn-danger',

                                ]);

                            },
                            'update' => function ($url, $model) {
                                $url = ['role/update', 'name' => $model->name];
                                return Html::a('<span class="fa fa-pencil"></span>', $url, [
                                    'title' => 'Update',
                                    'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                                    'class' => 'btn btn-danger',

                                ]);

                            },


                        ]
                    ],

                ],
            ]); ?>
        </div>
    </div>
</div>
