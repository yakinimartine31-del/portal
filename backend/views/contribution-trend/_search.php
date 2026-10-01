<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComplaintsSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<hr style="color: greenyellow">
<div class="customers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index-search'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'date1')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy',


                ],
                'options' => ['placeholder' => Yii::t('app', 'Year from')]
            ])->label('Year From'); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'date2')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy',


                ],

                'options' => ['placeholder' => Yii::t('app', 'Year to'),]
            ])->label('Year To'); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'member_number')->textInput(['maxlength' => true,'required'=>true]) ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-success']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-warning']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
