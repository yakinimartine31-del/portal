<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ContactDetails */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Contact Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contact-details-view">

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
            'name',
            'alias',
            'con_position',
            'address:ntext',
            'suburb',
            'state',
            'country',
            'postcode',
            'telephone',
            'fax',
            'misc:ntext',
            'image',
            'email_to:email',
            'default_con',
            'published',
            'checked_out',
            'checked_out_time',
            'ordering',
            'params:ntext',
            'user_id',
            'catid',
            'access',
            'mobile',
            'webpage',
            'sortname1',
            'sortname2',
            'sortname3',
            'language',
            'created',
            'created_by',
            'created_by_alias',
            'modified',
            'modified_by',
            'metakey:ntext',
            'metadesc:ntext',
            'metadata:ntext',
            'featured',
            'xreference',
            'publish_up',
            'publish_down',
            'version',
            'hits',
        ],
    ]) ?>

</div>
