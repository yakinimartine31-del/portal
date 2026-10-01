<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BackgroundPhotos33Repeat */

$this->title = $model->image;
$this->params['breadcrumbs'][] = ['label' => 'Background Photos33 Repeats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="background-photos33-repeat-view" style="padding-top: 30px">

    <p>
        <?php Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => 'Are you sure you want to update this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
           // 'parent_id',
            'slide_name',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img('../' . $data['image'],
                        ['width' => '400px', 'height' => '400px','class'=>'img-horizontal']);
                },

            ],
        ],
    ]) ?>

</div>
