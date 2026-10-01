<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="customers-form">
    <?php
    $form = ActiveForm::begin([
        'enableClientValidation' => true,
        /*'enableAjaxValidation' => true,
        'validateOnSubmit'=>true,
        'validateOnChange' => false*/
        'id' => 'login-form',
        'type' => ActiveForm::TYPE_VERTICAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>
    <div class="item form-group">
        <div class="panel-heading">
            <?= Yii::t('app', 'New Role'); ?>
        </div>
        <div class="row">

            <div class="col-md-12 col-sm-4 ">
                <?php
                echo $form->field($model, 'name')->textInput();
                ?>
                <?php
                echo  $form->field($model, 'description')->textarea(['style' => 'height: 100px']) .
                    Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), [
                        'class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger'
                    ]);
                ?>
            </div>
        </div>
        <hr>
        <div class="panel-heading">
            <?= Yii::t('app', 'List of Available Permissions'); ?>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-4 ">
                <?= $form->field($model, '_permissions')->checkboxList($permissions,[

                    'itemOptions' => [

                        'labelOptions' => ['class' => 'col-md-6']

                    ]
                ]) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>