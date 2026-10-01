<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ZssfMembers */

$this->title = $model->full_names;
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Zssf Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="zssf-members-view">

    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('yii', 'Reset password '), ['reset', 'id' => $model->id], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to reset password for this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<hr>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'date_time',
            'full_names',
            'membership_number',
            'email:email',
           // 'password',
            //'uid',
            //'group',
            'username',
            'mobile_number',
            'member_sys_id',
          //  'photo:ntext',
           // 'send_auth_code_via:ntext',
           // 'auth_code',
            'date_of_birth',
            'address',
            'marital_status:ntext',
            'gender:ntext',
          //  'national_id',
            'member_card:ntext',
            'date_of_joining',
          //  'registration_id',
        ],
    ]) ?>

</div>
