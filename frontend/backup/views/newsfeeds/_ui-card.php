<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>
<a href="<?= \yii\helpers\Url::toRoute(['view', 'id' => $model->id]) ?>">
    <div class="card">
        <img src="<?= Yii::$app->request->baseUrl . '/../api/' . $model->images; ?>" alt="Avatar"
             style="width:270px;height:120px">
        <div class="card-body">
            <h5 class="truncate" style="overflow: hidden;max-width: 75ch;"> <?= Html::encode($model->params) ?></h5>
            <p class="card-text"><?= Html::encode($model->publish_up) ?></p>
        </div>
    </div>
</a>


<style>
    .truncate {
        max-width: 250px !important;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .truncate:hover {
        overflow: visible;
        white-space: normal;
        width: auto;
    }
</style>



