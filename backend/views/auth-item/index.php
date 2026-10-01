<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Auth Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index" style="padding-top: 20px">
    <div class="row">
        <div class="col-lg-8">
            <h5 style="color: #003b4c;font-family: Tahoma">
                <i class="fa fa-server text-default">
                </i><strong>USERS PERMISSION LIST</strong></h5>

            <?php \yii\widgets\Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'summary'=>'',
                'columns' => [
                    //   ['class' => 'yii\grid\SerialColumn'],

                    'name',
                    // 'type',
                    'description:ntext',
                    // 'rule_name',
                    //'data:ntext',
                    //'created_at',
                    //'updated_at',


                ],
            ]); ?>
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
    </div>
</div>


