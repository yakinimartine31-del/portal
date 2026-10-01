<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ContributionsTemp */

$this->title = Yii::t('yii', 'Create Contributions Temp');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Contributions Temps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contributions-temp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
