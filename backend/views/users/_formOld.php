<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="report-search">

    <?php $form = ActiveForm::begin(); ?>

    <hr>
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-4">
            <?=
            $form->field($model, 'role')->widget(Select2::classname(), [
                'data' => \backend\models\Users::getArrayRole(),
                'options' => ['placeholder' => 'Select Role'],
                'pluginOptions' => [
                    'allowClear' => true,

                ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-4">
            <?php $form->field($model, 'staff_login')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'activation')->dropDownList(
                ['1' => 'ACTIVATE', '0' => 'DEACTIVATE'],           // Flat array ('id'=>'label')
                ['prompt' => 'Select Activate/Deactivate','required'=>true]    // options
            ); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-3">

            <div class="form-group">
                <?= Html::submitButton(Yii::t('yii', 'Submit'), ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('yii', 'Back'), ['index'], ['class' => 'btn btn-danger']) ?>
            </div>

        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>

