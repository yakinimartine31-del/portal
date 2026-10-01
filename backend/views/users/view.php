<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="users-view">
    <p>
        <?php Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Update Account'), ['update', 'id' => $model->id], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to change activation status to this account?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('yii', 'Back Home'), ['index'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
       //     'id',
            'name',
            'username',
//            'profile_picture',
            'email:email',
            [
                'attribute' => 'id',
                'label'=>'Role Assigned',
                'value' => $model->role0 ? $model->role0->item_name : '-'
            ],
            [
                'attribute' => 'activation',
                'value' => function ($model) {
                    if ($model->staff_login =='1') {
                        return 'ADMIN LOGIN ACTIVATED';
                    } elseif ($model->staff_login =='0') {
                        return 'ADMIN LOGIN DEACTIVATED';
                    } else {
                        return 'ADMIN LOGIN DEACTIVATED';
                    }
                }
            ],
//            'params:ntext',
//            'lastResetTime',
//            'resetCount',
//            'otpKey',
//            'otep',
//            'requireReset',
//            'create_at',
//            'updated_at',
        ],
    ]) ?>

</div>
