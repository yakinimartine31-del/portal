<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ZssfMembersSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <br>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'employer_names')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'employer_code')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'date_from')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',

                ],
                'options' => ['placeholder' => Yii::t('yii', 'Date from')]
            ])->label('Date from'); ?>

        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'date_to')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',

                ],

                'options' => ['placeholder' => Yii::t('yii', 'Date to')]
            ])->label('Date to'); ?>
        </div>
        <div class="row">
            <div class="col-md-3">

                <?= Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">

                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
