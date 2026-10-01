<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ZssfBackendMembersSimulation */

$this->title = 'Update Zssf Backend Members Simulation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Zssf Backend Members Simulations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zssf-backend-members-simulation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
