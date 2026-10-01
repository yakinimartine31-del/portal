<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ContactDetails */

$this->title = Yii::t('yii', 'Create Contact Details');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Contact Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
