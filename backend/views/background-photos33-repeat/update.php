<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BackgroundPhotos33Repeat */

$this->title = 'Update Background Photos: ' . $model->image;
$this->params['breadcrumbs'][] = ['label' => 'Background Photos33 Repeats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="background-photos33-repeat-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
