<?php

use frontend\models\BufferResults;
use frontend\models\Members;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BufferResultsSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="content-row">


    <?php
    $form = ActiveForm::begin([
        'action' => ['project-results'],
        'method' => 'get',
    ]); ?>

    <?php
   // \frontend\models\BufferResults::getProjection();
    $user=\Yii::$app->user->identity->getId();
    $member_number=Members::find()->where(['uid'=>$user])->one();
    // $member_number['date_of_birth'];
    $date=date_create( $member_number['date_of_birth']); // or your date string
    date_add($date,date_interval_create_from_date_string("60 years"));// add number of days
   // $expect= date_format($date,"Y-m-d");

    $expect = BufferResults::getProjection();
    $status= $expect['benefitsCalculations']['status'];
    if ($status !=400){
        $expected_retirement_date= $expect['benefitsCalculations']['expected_retirement_date'];
        $total_months_contributed= $expect['benefitsCalculations']['total_months_contributed'];
        $average_salary= $expect['benefitsCalculations']['average_salary'];
        $pension= $expect['benefitsCalculations']['pension'];
        $gratuity= $expect['benefitsCalculations']['gratuity'];
    }
    else{
        $expected_retirement_date= '';
        $total_months_contributed= '';
        $average_salary= '';
        $pension= '';
        $gratuity= '';
    }

    ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'type')->dropDownList(['1'=>Yii::t('yii','Old Age')]) ?>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col"><?= Yii::t('yii', 'Full Name') ?></th>
                    <th scope="col"><?= Yii::t('yii', 'Member Number') ?></th>
                    <th scope="col"><?= Yii::t('yii', 'Expected Retiring date') ?></th>
                    <th scope="col"><?= Yii::t('yii', 'Number of Months Contributed') ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= $member_number['full_names'] ?></td>
                    <td><?= $member_number['membership_number'] ?></td>
                    <td><?= $expected_retirement_date ?></td>
                    <td><?= $total_months_contributed ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col"><?= Yii::t('yii', 'Avarage Salary') ?></th>
                    <th scope="col"><?= Yii::t('yii', 'Pension') ?></th>
                    <th scope="col"><?= Yii::t('yii', 'Gratuity') ?></th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= $average_salary ?></td>
                    <td><?= $pension ?></td>
                    <td><?= $gratuity ?></td>

                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php // echo $form->field($model, 'latest_contribution') ?>

    <?php // echo $form->field($model, 'latest_updated') ?>

    <div class="form-group">
        <?php Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php Html::resetButton(Yii::t('yii', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>