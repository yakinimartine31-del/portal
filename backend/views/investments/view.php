<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Investments */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Investments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<hr>
<div class="investments-view">

    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Back Home'), ['index',], ['class' => 'btn btn-warning']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'date_time',
            'category:ntext',
            'title',
            'description:ntext',
            'image:ntext',
            'map',
            'article_date',
        ],
    ]) ?>

</div>
