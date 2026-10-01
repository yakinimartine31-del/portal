<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComplaintsCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="complaints-categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'recepient_email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList([1 => 'ACTIVE',0=>'IN ACTIVE'],['prompt'=>'Select Status']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Submit'), ['class' => 'btn btn-success']) ?>
        <?=  Html::a(Yii::t('yii', 'Back Home', [
            'modelClass' => 'details',
        ]), ['index'], ['class' => 'btn btn-warning', 'id' => 'popupModal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
