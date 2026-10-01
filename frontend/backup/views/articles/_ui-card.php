<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>
<div style="padding-bottom: 60px">
<a href="<?= \yii\helpers\Url::toRoute(['view', 'id' => $model->id]) ?>" >
    <div class="card">
        <img src="<?= Yii::$app->request->baseUrl . '/../api/' . $model->intro_image; ?>" alt="Avatar"
             style="width:200px;height:100px">
        <div class="card-body">
            <h5 class="truncate" style="overflow: hidden;max-width: 75ch;"> <?= Html::encode($model->title) ?></h5>
            <p class="card-text"><?= Html::encode($model->date_time) ?></p>
        </div>
    </div>
</a>
</div>

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



