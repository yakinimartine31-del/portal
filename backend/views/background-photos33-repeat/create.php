<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BackgroundPhotos33Repeat */

$this->title = 'Create Background Photos33 Repeat';
$this->params['breadcrumbs'][] = ['label' => 'Background Photos33 Repeats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="background-photos33-repeat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
