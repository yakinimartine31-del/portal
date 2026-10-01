<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Employers */

$this->title = 'Create Employers';
$this->params['breadcrumbs'][] = ['label' => 'Employers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
