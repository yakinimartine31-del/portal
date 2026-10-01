<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */

$this->title = "";
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Sheha'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Create New Sheha');
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formNew', [
        'model' => $model,
    ]) ?>

</div>
