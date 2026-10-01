<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserFeedback */

$this->title = Yii::t('yii', 'Create User Feedback');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'User Feedbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-feedback-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
