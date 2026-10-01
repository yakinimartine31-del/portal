<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Contributions */

$this->title = Yii::t('yii', 'Create Contributions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Contributions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contributions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
