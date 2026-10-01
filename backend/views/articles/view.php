<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Articles */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'News and Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<hr>
<div class="articles-view">

    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('yii', 'Back Home'), ['index'], ['class' => 'btn btn-warning']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'date_time',
            'title',
            'contents:ntext',
          //  'category_id',
        //    'order_position',
            [
                'attribute' => 'intro_image',
                'format' => 'html',
                'label' => 'Photo',
                'value' => function ($data) {
                    return Html::img('/../api/' . $data['intro_image'],
                        ['width' => '100px', 'height' => '100px', 'class'=>'img-responsive']);
                },

            ],
        ],
    ]) ?>

</div>
