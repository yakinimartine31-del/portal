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
if (Yii::$app->session->getFlash('year_fail')) {
    echo SweetAlert::widget([
        'options' => [
            'title' => '',
            'text' => Html::tag('h2', Yii::t('yii','Years should not be greater than 45 ')),
            'icon' => '',
            'animation' => 'slide-from-top',
            'type' => SweetAlert::TYPE_WARNING,
            'html' => true,
           // 'theme' => SweetAlert::THEME_GOOGLE
        ]
    ]);

}
elseif (Yii::$app->session->getFlash('month_fail')) {
    echo SweetAlert::widget([
        'options' => [
            'title' => '',
            'text' => Html::tag('h2', Yii::t('yii','Months should not be greater than 540 ')),
            'icon' => '',
            'animation' => 'slide-from-top',
            'type' => SweetAlert::TYPE_WARNING,
            'html' => true,
           // 'theme' => SweetAlert::THEME_GOOGLE
        ]
    ]);

}elseif (Yii::$app->session->getFlash('success_benefit')){

    $pension = Yii::$app->session->get('pension');
    $gratuity = Yii::$app->session->get('gratuity');
    $average_salary = Yii::$app->session->get('average_salary');
    $total_months_contributed = Yii::$app->session->get('total_months_contributed');
    $total_contributions = Yii::$app->session->get('total_contributions');

    if ($pension > 0){
        echo SweetAlert::widget([
            'options' => [
                'title' => '  <div class="bs-example">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>'. Yii::t('yii','Average Salary').'</th>
                            <th>'. Yii::t('yii','Contributing Period').'</th>
                            <th>'. Yii::t('yii','Monthly Pension').'</th>
                            <th>'. Yii::t('yii','Gratuity').'</th>
            
                         </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td rowspan="1">1</td>
                            <td>'.number_format($average_salary, 2, ".", ",").'</td>
                            <td>'.$total_months_contributed.'</td>
                            <td>'.number_format($pension, 2, ".", ",").'</td>
                            <td>'.number_format($gratuity, 2, ".", ",").'</td>
                          </tr>  
                        </tbody>
                      </table>
                    </div>',
                //'text' => Html::tag('h2', 'Custom Message'),
                'icon' => '',
                'animation' => 'slide-from-top',
                'type' => SweetAlert::TYPE_SUCCESS,
                'html' => true,
                'customClass'=> 'swal-wide',
                'theme' => SweetAlert::THEME_GOOGLE
            ]
        ]);
    }
    else{
        echo SweetAlert::widget([
            'options' => [
                'title' => '  <div class="bs-example">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                          <th>'. Yii::t('yii','Average Salary').'</th>
                            <th>'. Yii::t('yii','Contributing Period').'</th>
                            <th>'. Yii::t('yii','Monthly Pension').'</th>
                            <th>'. Yii::t('yii','Refund').'</th>
                         </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td rowspan="1">1</td>
                            <td>'.number_format($average_salary, 2, ".", ",").'</td>
                            <td>'.$total_months_contributed.'</td>
                   
                            <td>N/A</td>
                            <td>'.number_format($gratuity, 2, ".", ",").'</td>
                          </tr>  
                        </tbody>
                      </table>
                    </div>',
                //'text' => Html::tag('h2', 'Custom Message'),
                'icon' => '',
                'animation' => 'slide-from-top',
                'type' => SweetAlert::TYPE_SUCCESS,
                'html' => true,
                'customClass'=> 'swal-wide',
                'theme' => SweetAlert::THEME_GOOGLE
            ]
        ]);
    }

}



?>
<style>
    .swal-wide{
        width:850px !important;
    }
</style>
<div class="content-row">
    <div class="row">
        <div class="col-md-12">
            <h4 class="content-row-title"><?= Yii::t('yii', 'BENEFIT CALCULATOR') ?></h4>
        </div>
    </div>
</div>
<hr>
<div class="members-form">

    <?php $form = ActiveForm::begin([
        'action' => ['calculator/benefit-calculator'],
        'method' => 'POST ',
    ]); ?>
    <div class="row">
        <div class="col-lg-4">

            <?= $form->field($model, 'gross_salary')->widget(MaskMoney::classname(), [
                'pluginOptions' => [
                    'prefix' => 'TZS ',
                    //'suffix' => '',
                    'allowNegative' => false
                ]
            ]); ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'time_type')->dropDownList(\frontend\models\Calculator::getType(), ['prompt' => Yii::t('yii', '-- Select contribution Period--')]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'time')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= Html::submitButton(Yii::t('yii', 'Calculate'), ['class' => 'btn btn-primary', 'id' => 'btn-custom-']) ?>
        </div>
        <div class="col-lg-8">
            <p><?= Yii::t('yii','Calculate benefits, maximum number of contribution should not exceed 45 years (540 Months)') ?></p>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
