<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AuditTrial */

$this->title = 'Create Audit Trial';
$this->params['breadcrumbs'][] = ['label' => 'Audit Trials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audit-trial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
