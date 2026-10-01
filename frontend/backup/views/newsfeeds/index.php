<?php

use circulon\widgets\ColumnListView;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NewsfeedsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'News and Events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newsfeeds-index">

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_ui-card',
        'layout'=>'{items}{pager}',
        'itemOptions' => ['class' => 'col-xs-10 col-sm-4'],
        'summary' => '',
        'pager' => [
            'firstPageLabel' => 'first',
            'lastPageLabel' => 'last',
            'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
            'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
        ],


    ]) ?>

</div>

