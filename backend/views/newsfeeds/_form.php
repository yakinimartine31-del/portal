<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Newsfeeds */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="customers-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="item form-group">
        <div class="row">
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>

          <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'params')->textInput(['maxlength' =>70]) ?>
            </div>

            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

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

