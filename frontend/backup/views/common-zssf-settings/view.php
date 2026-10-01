<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CommonZssfSettings */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Common Zssf Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="common-zssf-settings-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date_time',
            'best_average_earning_months',
            'maternity_fixed_amount',
            'maternity_for_twins',
            'complaints_email_address:email',
            'percentage_deducted_on_refund',
            'refund_best_average_earning',
            'hq_mobile_number',
            'pemba_mobile_number',
            'contact_email:email',
            'max_calculator_months',
            'max_calculator_years',
            'unguja_phone_number',
            'employer_percentge',
            'employee_percentage',
            'facebook_link',
            'twitter_link',
            'instagram_link',
            'pemba_cordinates',
            'unguja_cordinates',
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
