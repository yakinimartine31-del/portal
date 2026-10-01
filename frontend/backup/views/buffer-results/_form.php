<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BufferResults */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buffer-results-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TotalNumberOfContribution')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BestAverageEarning')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TotalContributions')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ContributionAfterRetirement')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gratuity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MonthlyPension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Refund')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ContBeforeRetirement')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MONTHLYPENSIONCALCULATED')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MPFormula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MPFormulawnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GTFormula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GTFormulawnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RFFormula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RFFormulawnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'member_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'latest_contribution')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latest_updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
