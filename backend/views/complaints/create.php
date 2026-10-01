<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Complaints */

$this->title = Yii::t('yii', 'Create Complaints');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Complaints'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaints-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
