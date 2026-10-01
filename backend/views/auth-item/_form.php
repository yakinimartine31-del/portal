<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="col-xs-12 col-lg-12" style="padding-top:5px">
    <div class="box-success box view-item col-xs-12 col-lg-12">

        <h2 class="page-header">
            <i class="fa fa-list"></i> <?php echo Yii::t('app', 'Permission'); ?>
        </h2>
        <div class="table-responsive">
            <?php $form = ActiveForm::begin(); ?>

            <fieldset>
                <div class="col-sm-11">
                    <div class="control-group">
                        <div class="controls">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-11">
                    <div class="control-group">
                        <div class="controls">
                            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-lg-4 no-padding">
                    <div class="col-xs-3 col-xs-12">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-block btn-success' : 'btn btn-block btn-info']) ?>
                    </div>
                </div>
            </fieldset>
            <div style="padding-top: 30px">

            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
