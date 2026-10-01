<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ZssfMembers */

$this->title = Yii::t('yii', 'Send Message To Zssf Members');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Bulk Sending'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zssf-members-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
