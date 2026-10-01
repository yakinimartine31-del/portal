<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Contributions */

$this->title = $model->member_number;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Contributions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?php
echo  Alert::widget([
    'options' => ['class' => 'alert-success'],
    'body' => Yii::$app->session->getFlash('contribution_fail'),
]);
?>
<div class="content-row">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title text-center" style="color: green">
                       <?= Yii::t('yii','REPORT OF LATEST CONTRIBUTION INFORMATION') ?>
                    </div></div>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'id',
                      //  'date_time',
                        'member_number',
                        'cont_month',
                        'cont_year',
                        'amount',
                        'salary',
                        //'transaction_id',
                        'contributing_period',
                      //  'latest_updated',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
<div class="contributions-view">



</div>
