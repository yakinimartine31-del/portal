<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Members34Repeat */

$this->title = Yii::t('app', 'Create Members34 Repeat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Members34 Repeats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="members34-repeat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
