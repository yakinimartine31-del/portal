<?php

use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuditTrialSearch */
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
                'options' => ['placeholder' => Yii::t('yii', 'Year from')]
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

                'options' => ['placeholder' => Yii::t('yii', 'Year to')]
            ])->label('Year To'); ?>
        </div>
        <div class="col-md-2">
            <?php $form->field($model, 'module')->dropDownList(['site login'=>'Site Login','Image Settings'=>'Image Settings',
                'Users'=>'Users','Complaints'=>'Complaints','Contact Us'=>'Contact Us','Complaints Category'=>'Complaints Category',
                'Profile'=>'Profile','Member Card'=>'Member Card','Contribution Trend'=>'Contribution Trend','members'=>'Members','contribution'=>'contribution',
                'Benefit'=>'Benefit','SMS LOGS'=>'SMS LOGS','members contribution'=>'members contribution'],['prompt'=>'Select Module']) ?>
            <?=
            $form->field($model, 'module')->widget(Select2::classname(), [
                'data' => \backend\models\AuditTrial::getAll(),
                'options' => ['placeholder' => 'Select Module'],
                'pluginOptions' => [
                    'allowClear' => true,

                ],
            ]);
            ?>
        </div>
        <div class="col-md-2">

            <?= $form->field($model, 'category')->dropDownList(['1'=>'Application Activities','2'=>'Web Portal Activities'],['prompt'=>'Select Category']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <br>
            <?= Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-md-3">

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