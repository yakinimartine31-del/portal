<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContactDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'alias') ?>

    <?= $form->field($model, 'con_position') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'suburb') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'postcode') ?>

    <?php // echo $form->field($model, 'telephone') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'misc') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'email_to') ?>

    <?php // echo $form->field($model, 'default_con') ?>

    <?php // echo $form->field($model, 'published') ?>

    <?php // echo $form->field($model, 'checked_out') ?>

    <?php // echo $form->field($model, 'checked_out_time') ?>

    <?php // echo $form->field($model, 'ordering') ?>

    <?php // echo $form->field($model, 'params') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'catid') ?>

    <?php // echo $form->field($model, 'access') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'webpage') ?>

    <?php // echo $form->field($model, 'sortname1') ?>

    <?php // echo $form->field($model, 'sortname2') ?>

    <?php // echo $form->field($model, 'sortname3') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_by_alias') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'modified_by') ?>

    <?php // echo $form->field($model, 'metakey') ?>

    <?php // echo $form->field($model, 'metadesc') ?>

    <?php // echo $form->field($model, 'metadata') ?>

    <?php // echo $form->field($model, 'featured') ?>

    <?php // echo $form->field($model, 'xreference') ?>

    <?php // echo $form->field($model, 'publish_up') ?>

    <?php // echo $form->field($model, 'publish_down') ?>

    <?php // echo $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'hits') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('yii', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
