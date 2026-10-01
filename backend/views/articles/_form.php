<?php

use kartik\editors\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Articles */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="customers-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="item form-group">
        <div class="row">
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?php $form->field($model, 'contents')->textarea(['rows' => 6]) ?>
                <?php
                echo $form->field($model, 'contents')->widget(Summernote::class, [
                    'options' => ['placeholder' => 'Edit your blog content here...']
                ]);

                ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'file')->fileInput() ?>
            </div>
        </div>
        <hr>
        <div class="item form-group">
            <?= Html::a(Yii::t('app', '<i class="fa fa-times text-yellow"></i> Cancel'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('yii', 'Reset'), ['class' => 'btn btn-warning']) ?>
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success']) ?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

