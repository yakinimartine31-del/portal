<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Newsfeeds */

$this->title = Yii::t('yii', 'Create News feeds');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'News feeds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newsfeeds-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
