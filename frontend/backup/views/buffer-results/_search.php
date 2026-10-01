<?php

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
        'action' => ['results'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'TotalNumberOfContribution') ?>

    <?php //$form->field($model, 'BestAverageEarning') ?>

    <?php // $form->field($model, 'TotalContributions') ?>

    <?php // $form->field($model, 'ContributionAfterRetirement') ?>

    <?php // echo $form->field($model, 'Gratuity') ?>

    <?php // echo $form->field($model, 'MonthlyPension') ?>

    <?php // echo $form->field($model, 'Refund') ?>

    <?php // echo $form->field($model, 'ContBeforeRetirement') ?>

    <?php // echo $form->field($model, 'MONTHLYPENSIONCALCULATED') ?>

    <?php // echo $form->field($model, 'MPFormula') ?>

    <?php // echo $form->field($model, 'MPFormulawnumber') ?>

    <?php // echo $form->field($model, 'GTFormula') ?>

    <?php // echo $form->field($model, 'GTFormulawnumber') ?>

    <?php // echo $form->field($model, 'RFFormula') ?>

    <?php // echo $form->field($model, 'RFFormulawnumber') ?>

    <?php // echo $form->field($model, 'member_number') ?>
    <?php
    $user=\Yii::$app->user->identity->getId();
    $member_number=Members::find()->where(['uid'=>$user])->one();
    ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'type')->dropDownList(['1'=>Yii::t('yii','Old Age'),'2'=>Yii::t('yii','Invalidity'),'3'=>Yii::t('yii','Survivor')], ['prompt' => Yii::t('yii', '-- Select benefit type--')]) ?>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col"><?= Yii::t('yii','Full Name')?></th>
                    <th scope="col"><?= Yii::t('yii','Member Number')?></th>
                </tr>
                </thead>
                <tbody>
                <tr>

                    <td><?=$member_number['full_names']?></td>
                    <td><?=$member_number['membership_number']?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php // echo $form->field($model, 'latest_contribution') ?>

    <?php // echo $form->field($model, 'latest_updated') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('yii', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>