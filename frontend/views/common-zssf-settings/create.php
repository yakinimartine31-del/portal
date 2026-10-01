<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CommonZssfSettings */

$this->title = Yii::t('yii', 'Create Common Zssf Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Common Zssf Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="common-zssf-settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
