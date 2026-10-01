<?php

use aryelds\sweetalert\SweetAlert;
use drsdre\wizardwidget\WizardWidget;
use kartik\alert\AlertBlock;
use kartik\dialog\Dialog;
use kartik\money\MaskMoney;

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Members */
/* @var $form yii\widgets\ActiveForm */

?>
<?php
if (Yii::$app->session->getFlash('sms_fail')) {
    echo SweetAlert::widget([
        'options' => [
            'title' => '',
            'text' => Html::tag('h2', Yii::t('yii','No phone number found, please update your profile and try again ')),
            'icon' => '',
            'animation' => 'slide-from-top',
            'type' => SweetAlert::TYPE_WARNING,
            'html' => true,
            // 'theme' => SweetAlert::THEME_GOOGLE
        ]
    ]);

}
elseif (Yii::$app->session->getFlash('sms_success')){

    echo SweetAlert::widget([
        'options' => [
            'title' => '',
            'text' => Html::tag('h2', Yii::t('yii','Statement sent successfully to your phone number ')),
            'icon' => '',
            'animation' => 'slide-from-top',
            'type' => SweetAlert::TYPE_SUCCESS,
            'html' => true,
            // 'theme' => SweetAlert::THEME_GOOGLE
        ]
    ]);
}


?>
<div class="content-row">
    <div class="row">
        <div class="col-md-12">
            <h4 class="content-row-title"><?= Yii::t('yii', 'SMS STATEMENT') ?></h4>
        </div>
    </div>
</div>
<hr>
<div class="members-form"style="padding-bottom: 130px">

    <?php $form = ActiveForm::begin([
        'action' => ['statement/sms'],
        'method' => 'POST ',
    ]); ?>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'zssf_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-8">
            <p><?= Yii::t('yii','This will send your member statement to the phone number you are registered with') ?></p>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Request Statement'), ['class' => 'btn btn-primary', 'id' => 'btn-custom-']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
