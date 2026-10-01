<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SubscriptionTypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscription-types-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_name_sw')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'default')->dropDownList(['1'=>Yii::t('yii','Default'),'0'=>Yii::t('yii','Not Default')],
        ['prompt' => Yii::t('yii', '--- Select Option ---')]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('yii', 'Cancel'), ['index'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
