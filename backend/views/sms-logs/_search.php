<?php

use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComplaintsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
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
                    'format' => 'yyyy-mm-dd',

                ],
                //   'options'=>['placeholder'=>Yii::t('yii','Year from')]
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
                    'format' => 'yyyy-mm-dd',

                ],
                // 'options'=>['placeholder'=>Yii::t('yii','Year to')]
            ])->label('Year To'); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'member_number')->textInput(['maxlength' => true]) ?>
            <?php $form->field($model, 'sms_status')
                ->dropDownList(\frontend\models\ComplaintsCategories::getAll(),
                    ['prompt' => Yii::t('yii', '-- Select Type --')])->label(false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'recipient_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($model, 'msg_category_id')->widget(Select2::classname(), [
                'data' => \backend\models\MsgCategories::getAll(),
                'options' => ['placeholder' => 'Select category'],
                'pluginOptions' => [
                    'allowClear' => true,

                ],
            ]);
            ?>
        </div>

        <div class="col-md-3" style="padding-top: 25px">
            <?= Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-primary']) ?>
        </div>

    </div>


    <?php ActiveForm::end(); ?>

</div>

