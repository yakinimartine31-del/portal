<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Publications */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="customers-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="item form-group">
        <div class="row">
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'publication_type')->textInput(['rows' => 6]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'publication_date')->widget(
                    DatePicker::className(), [
                    // inline too, not bad
                    'inline' => false,
                    // modify template for custom rendering
                    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',

                    ],
                    'options'=>['placeholder'=>Yii::t('yii','Publication date')]
                ])->label(false);?>

            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'publication')->textarea(['rows' => 6]) ?>
            </div>
        </div>
        <hr>
        <div class="item form-group">
            <?= Html::a(Yii::t('app', '<i class="fa fa-times text-yellow"></i> Cancel'), ['index'], ['class' => 'btn btn-primary']) ?>
            <button class="btn btn-warning" type="reset">Reset</button>
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success']) ?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

