<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ZssfBackendMembersSimulation */

$this->title = 'Create Zssf Backend Members Simulation';
$this->params['breadcrumbs'][] = ['label' => 'Zssf Backend Members Simulations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zssf-backend-members-simulation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
