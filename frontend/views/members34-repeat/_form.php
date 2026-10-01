<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Members34Repeat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="members34-repeat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'depedennt_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dependent_names')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'relationship')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
