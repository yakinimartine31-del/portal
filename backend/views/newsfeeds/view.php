<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Newsfeeds */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Newsfeeds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="newsfeeds-view">

    <hr>

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
//            'catid',
//            'id',
            'name',
//            'alias',
//            'link',
        //    'published',
//            'numarticles',
//            'cache_time:datetime',
//            'checked_out',
//            'checked_out_time',
       //     'ordering',
     //       'rtl',
         //   'access',
         //   'language',
            'params:ntext',
        //    'created',
        //    'created_by',
          //  'created_by_alias',
         //   'modified',
         //   'modified_by',
          //  'metakey:ntext',
        //    'metadesc:ntext',
         //   'metadata:ntext',
          //  'xreference',
           // 'publish_up',
          //  'publish_down',
            'description:ntext',
         //   'version',
         //   'hits',
            [
                'attribute' => 'images',
                'format' => 'html',
                'label' => 'Photo',
                'value' => function ($data) {
                    return Html::img('/../api/' . $data['images'],
                        ['width' => '100px', 'height' => '100px', 'class'=>'img-responsive']);
                },

            ],
        ],
    ]) ?>

</div>
