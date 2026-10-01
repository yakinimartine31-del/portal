<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ComplaintsCategories */

$this->title = $model->category_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Complaints Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<br>
<div class="complaints-categories-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'date_time',
            'category_name',
            'recepient_email',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    if ($model->status == '1') {
                        return 'ACTIVE';
                    } elseif ($model->status == '0') {
                        return 'IN ACTIVE';
                    } else {
                        return '';
                    }
                }
            ],
        ],
    ]) ?>

</div>
<p>
    <?= Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('yii', 'Back Home', [
        'modelClass' => 'details',
    ]), ['index'], ['class' => 'btn btn-warning', 'id' => 'popupModal']) ?>
    <?php Html::a(Yii::t('yii', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],
    ]) ?>
</p>