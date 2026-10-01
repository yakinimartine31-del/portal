<?php

use kartik\money\MaskMoney;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Members */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="members-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4">

            <?= $form->field($model, 'amount')->widget(MaskMoney::classname(), [
                'pluginOptions' => [
                    'prefix' => 'TZS ',
                    //'suffix' => '',
                    'allowNegative' => false
                ]
            ]); ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'validation_method')->dropDownList(\frontend\models\SignupForm::getType(), ['prompt' => Yii::t('yii', '-- Select Validation Method--')]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Calculate'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
