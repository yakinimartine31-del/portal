<?php

use frontend\models\Members;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CommonZssfSettingsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <?php
    $user = \Yii::$app->user->identity->getId();
    $member_number = Members::find()->where(['uid' => $user])->one();
    ?>
    <?php $form = ActiveForm::begin([
        'action' => ['maternity-results'],
        'method' => 'get',
    ]); ?>

    <div class="col-md-4">
        <?= $form->field($model, 'id')->dropDownList(['1'=>Yii::t('yii','Maternity')])->label(false) ?>
    </div>
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col"><?= Yii::t('yii', 'Full Name') ?></th>
                <th scope="col"><?= Yii::t('yii', 'Member Number') ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?= $member_number['full_names'] ?></td>
                <td><?= $member_number['membership_number'] ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('yii', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
