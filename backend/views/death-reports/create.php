<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DeathReports */

$this->title = 'Create Death Reports';
$this->params['breadcrumbs'][] = ['label' => 'Death Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="death-reports-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
