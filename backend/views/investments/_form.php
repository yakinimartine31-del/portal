<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Investments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="item form-group">
        <div class="row">
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'article_date')->widget(
                    DatePicker::className(), [
                    // inline too, not bad
                    'inline' => false,
                    // modify template for custom rendering
                    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd '.date('H:i:s'),

                    ],
                   // 'options' => ['placeholder' => Yii::t('yii', 'Year from')]
                ]) ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'photo')->fileInput() ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </div>
        </div>
        <hr>
        <div class="item form-group">
            <?= Html::a(Yii::t('yii', 'Cancel'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::submitButton(Yii::t('yii', 'Submit'), ['class' => 'btn btn-success']) ?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

