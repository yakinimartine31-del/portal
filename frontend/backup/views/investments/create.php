<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Investments */

$this->title = Yii::t('yii', 'Create Investments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Investments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
