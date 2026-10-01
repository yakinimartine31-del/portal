<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComplaintsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="complaints-search"> <!-- CHANGED: from "report-search" to "complaints-search" -->

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!-- Row ya Year From / Year To / Category -->
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'date1')->widget(
                DatePicker::className(), [
                'inline' => false,
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ],
                'options' => ['placeholder' => Yii::t('yii', 'Year from')]
            ])->label(false); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'date2')->widget(
                DatePicker::className(), [
                'inline' => false,
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ],
                'options' => ['placeholder' => Yii::t('yii', 'Year to')]
            ])->label(false); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'category')
                ->dropDownList(\frontend\models\ComplaintsCategories::getAll(),
                    ['prompt' => Yii::t('yii', '-- Select Category --')])->label(false) ?>
        </div>
    </div>

    <!-- Row ya Status Type / Message / ZSSF Number -->
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'status_type')
                ->dropDownList([
                    '' => 'All Status',
                    '1' => 'Pending',
                    'Sorted' => 'Sorted',
                ], ['prompt' => Yii::t('yii', '-- Select Status --')])->label(false) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'subject')->textInput(['placeholder'=>'Subject'])->label(false) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'zssf_number')->textInput(['placeholder'=>'Member Number'])->label(false) ?>
        </div>
    </div>

    <!-- Row ya Email / Phone Number / Complaint From -->
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'email_address')->textInput(['placeholder'=>'Email Address'])->label(false) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'phone_number')->textInput(['placeholder'=>'Phone Number'])->label(false) ?>
        </div>
    </div>

    <!-- Row mpya kwa Sorted From / Sorted To - INAONYESHWA TU KWA SORTED STATUS -->
    <div class="row" id="sorted-date-filters" style="display: none;">
        <div class="col-md-3">
            <?= $form->field($model, 'sorted_from_date')->widget(DatePicker::className(), [
                'inline' => false,
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ],
                'options' => ['placeholder' => Yii::t('yii', 'Date from (Sorted)')]
            ])->label(false); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'sorted_to_date')->widget(DatePicker::className(), [
                'inline' => false,
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ],
                'options' => ['placeholder' => Yii::t('yii', 'Date to (Sorted)')]
            ])->label(false); ?>
        </div>
    </div>

    <!-- Row ya Search Button -->
    <div class="row">
        <div class="col-md-3">
            <?= Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('yii', 'Reset'), ['index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
// JavaScript kuonyesha/hide sorted date filters based on status selection
$this->registerJs(<<<JS
$(document).ready(function() {
    function toggleSortedFilters() {
        var status = $('#complaintssearch-status_type').val();
        if (status === 'Sorted') {
            $('#sorted-date-filters').show();
        } else {
            $('#sorted-date-filters').hide();
            $('#complaintssearch-sorted_from_date').val('');
            $('#complaintssearch-sorted_to_date').val('');
        }
    }
    
    // Initialize on page load
    toggleSortedFilters();
    
    // Watch for changes
    $('#complaintssearch-status_type').change(function() {
        toggleSortedFilters();
    });
});
JS
);
?>