<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CommonZssfSettings */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Common Zssf Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="common-zssf-settings-view">
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead" style="color: #01214d;font-family: Tahoma"> <i class="fa fa-th-list text-blue"></i>
             <?= Yii::t('yii','COMMON SETTING')?>
            </strong>
        </div>

        <div class="col-md-2">
            <?= Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('yii', 'Are you sure you want to update ?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
    <hr/>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
          //  'date_time',
            'best_average_earning_months',
            'maternity_fixed_amount',
            'maternity_for_twins',
            'complaints_email_address:email',
            'percentage_deducted_on_refund',
            'refund_best_average_earning',
            'hq_mobile_number',
            'pemba_mobile_number',
            'hotline_no',
            'contact_email:email',
            'max_calculator_months',
            'max_calculator_years',
            'unguja_phone_number',
            'employer_percentge',
            'employee_percentage',
            'facebook_link',
            'twitter_link',
            'instagram_link',
          //  'pemba_cordinates',
          //  'unguja_cordinates',
            'youtube_link',
            'host_server',
            'db_user',
            'db_password',
            'database_name',
            'footer_message:ntext',
            'head_office_fax_number',
            'pemba_fax_number',
        ],
    ]) ?>

</div>
