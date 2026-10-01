<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BufferResults */

$this->title = Yii::t('yii', 'Create Buffer Results');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Buffer Results'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buffer-results-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
