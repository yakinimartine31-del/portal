<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Investments */

$this->title ='';
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Investments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
