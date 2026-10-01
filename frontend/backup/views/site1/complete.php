<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Button;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Complete';
//$this->params['breadcrumbs'][] = $this->title;
$model = new \frontend\models\SignupForm();
?>

<div class="col-md-6 pull-right">
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?= Yii::t('yii','Thanks for Sign in ZSSF member portal, please click Login to continue')?>
        <?= Html::a('Login', Url::to(['site/login']));?>
    </div>
</div>



