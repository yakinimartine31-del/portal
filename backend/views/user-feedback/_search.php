<?php

use dosamigos\datepicker\DatePicker;
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
                'options'=>['placeholder'=>Yii::t('yii','Year from')]
            ])->label(false);?>

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

                'options'=>['placeholder'=>Yii::t('yii','Year to')]
            ])->label(false);?>
        </div>
        <div class="col-md-3">
            <?= Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">

                </div>
            </div>
        </div>

    </div>



    <?php ActiveForm::end(); ?>

</div>

