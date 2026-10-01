<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Articles */

$this->title = Yii::t('yii', 'News and Events');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'News and Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<hr>
<div class="articles-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
