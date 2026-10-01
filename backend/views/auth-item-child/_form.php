<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItemChild */
/* @var $form yii\widgets\ActiveForm */
?>
<section class="container clearfix main_section">
    <div id="main_content_outer" class="clearfix">
        <div id="main_content">
            <div class="row">
                <div class="col-sm-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">SUPER ROLE ASSIGNMENT</h4>
                        </div>
                        <div class="panel-body">
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class="col-sm-11">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <?php // $form->field($model, 'parent')->textInput(['maxlength' => true]) ?>
                                                <?= $form->field($model, 'parent')->dropDownList(\backend\models\AuthItem::getAll(), ['prompt' => '-- Select Parent Role --']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <?php // $form->field($model, 'child')->textInput(['maxlength' => true]) ?>
                                                <?= $form->field($model, 'child')->dropDownList(\backend\models\AuthItem::getAll(), ['prompt' => '-- Select Child Role --']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>

                                    <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-warning']) ?>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

