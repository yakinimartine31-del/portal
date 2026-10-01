<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MembersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Member Card Status');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="members-index">

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
     //   'filterModel' => $searchModel,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'id',
          //  'date_time',
            'full_names',
            'membership_number',
            [
                'attribute' => 'member_card',
                'value' => function ($model) {
                    if ($model->member_card =='N') {
                        echo 'NOT PRINTED';
                    }
                    if ($model->member_card =='P') {
                        return 'PRINTED';
                    }
                    else {
                        echo '';
                    }
                },
                //  'value'=>$model->BestAverageEarning * 0.38,
            ],
            //'password',
            //'uid',
            //'group',
            //'username',
            //'mobile_number',
            //'member_sys_id',
            //'photo:ntext',
            //'send_auth_code_via:ntext',
            //'auth_code',
            //'date_of_birth',
            //'address',
            //'marital_status:ntext',
            //'gender:ntext',
            //'national_id',
            //'member_card:ntext',

       //     ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
