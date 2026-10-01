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
if (Yii::$app->session->getFlash('success_contribution')) {

    $employee_amount = Yii::$app->session->get('employee');
    $employer_amount = Yii::$app->session->get('employer');
    echo SweetAlert::widget([
        'options' => [
            'title' => '  <div class="bs-example">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>'. Yii::t('yii','Employee deduction').' (7%)</th>
                            <th>'. Yii::t('yii','Employer deduction').' (13%)</th>
                         </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td rowspan="1">1</td>
                            <td>' . number_format($employer_amount, 2, ".", ",") . '</td>
                            <td>' . number_format($employee_amount, 2, ".", ",") . '</td>
                     
                          </tr>  
                        </tbody>
                      </table>
                    </div>',
            //'text' => Html::tag('h2', 'Custom Message'),
            'icon' => '',
            'animation' => 'slide-from-top',
            'type' => SweetAlert::TYPE_SUCCESS,
            'html' => true,
            'theme' => SweetAlert::THEME_GOOGLE
        ]
    ]);

} ?>

<div class="content-row">
    <div class="row">
        <div class="col-md-12">
            <h4 class="content-row-title"><?= Yii::t('yii', 'CONTRIBUTION CALCULATOR') ?></h4>
        </div>
    </div>
</div>
<hr>
<div class="members-form" >

    <?php $form = ActiveForm::begin([
        'action' => ['calculator/contribution-calculator'],
        'method' => 'POST ',
    ]); ?>
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
        <div class="col-lg-8">
            <h6><?= Yii::t('yii','The employer deduct 7% form the employees total gross monthly wage and 
            adds 13% of total gross monthly wage making a total contribution of 20% for each employee') ?></h6>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Calculate'), ['class' => 'btn btn-primary', 'id' => 'btn-custom-']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
