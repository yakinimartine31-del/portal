<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Publications */

$this->title = Yii::t('yii', 'Create Publications');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Publications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publications-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
