<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Complaints */

$this->title = Yii::t('yii', 'Write Complaints');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Complaints'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaints-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
