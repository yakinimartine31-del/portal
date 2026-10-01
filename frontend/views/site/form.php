<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title =Yii::t('yii', 'ENTER ZSSF NUMBER');
//$this->params['breadcrumbs'][] = $this->title;
$model = new \frontend\models\SignupForm();

?>
<!--<div style="padding-left: 400px">-->
<div style="margin-left : 15%">
    <div class="panel panel-heading"
         style="text-align: left;"><?= Yii::t('yii', 'ENTER ZSSF NUMBER') ?></div>

<div class="col-lg-4">
    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

    <?= $form->field($model, 'zssf_no')->textInput(['autofocus' => true, 'readOnly' => false]) ?>

    <?= $form->field($model, 'validation_method')->dropDownList(\frontend\models\SignupForm::getType(), ['prompt' => Yii::t('yii', '-- Select Validation Method--')]) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Submit'), ['class' => 'btn btn-success', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

</div>


