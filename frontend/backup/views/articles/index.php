<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ArticlesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'News and Events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_ui-card',
        'layout'=>'{items}{pager}',
        'itemOptions' => ['class' => 'col-xs-10 col-sm-3'],
        'summary' => '',
        'pager' => [
            'firstPageLabel' => 'first',
            'lastPageLabel' => 'last',
            'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
            'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
        ],


    ]) ?>


</div>
