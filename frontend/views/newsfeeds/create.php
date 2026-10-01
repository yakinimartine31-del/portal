<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Newsfeeds */

$this->title = Yii::t('yii', 'Create Newsfeeds');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Newsfeeds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newsfeeds-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
