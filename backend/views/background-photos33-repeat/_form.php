<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BackgroundPhotos33Repeat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="background-photos33-repeat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'slide_name')->textInput(['maxlength' => true,'readOnly'=>true]) ?>

    <?= $form->field($model, 'picha')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('yii', 'Cancel'), ['index'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
