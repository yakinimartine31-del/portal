<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Complaints */
/* @var $form yii\widgets\ActiveForm */
?>
<?php if (Yii::$app->session->getFlash('success')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-info'],
        'body' => Yii::$app->session->getFlash('success'),
    ]);

}


?>
<?php if (Yii::$app->user->isGuest) { ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="panel panel-heading" style="text-align: center;"><?= Yii::t('yii','WRITE YOUR COMPLAINTS')?></div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3 pr-1">
                            <div class="form-group">
                                <?= $form->field($model, 'zssf_number')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class="col-md-3 pl-1">
                            <div class="form-group">
                                <?= $form->field($model, 'category')->dropDownList(\frontend\models\ComplaintsCategories::getAll(), ['prompt' => Yii::t('yii', '-- Select Type --')]) ?>
                            </div>
                        </div>
                        <div class="col-md-3 pl-1">
                            <div class="form-group">
                                <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 pl-1">
                            <div class="form-group">
                                <?= $form->field($model, 'subject')->textInput(['required'=>true]) ?>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <?= $form->field($model, 'message')->textarea(['maxlength' => true,'rows'=>6]) ?>
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <?= $form->field($model, 'file')->fileInput() ?>
                            </div>
                        </div>

                    </div>
                    <div class="form-group pull-right">
                        <?= Html::submitButton(Yii::t('yii', 'Submit'), ['class' => 'btn btn-success']) ?>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php
}
else { ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="panel panel-heading" style="text-align: center;"><?= Yii::t('yii','WRITE YOUR COMPLAINTS')?></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 pr-1">
                            <div class="form-group">
                                <?= $form->field($model, 'zssf_number')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <?= $form->field($model, 'email_address')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
                            </div>
                        </div>
                        <div class="col-md-3 pl-1">
                            <div class="form-group">
                                <?= $form->field($model, 'category')->dropDownList(\frontend\models\ComplaintsCategories::getAll(), ['prompt' => Yii::t('yii', '-- Select Type --')]) ?>
                            </div>
                        </div>
                        <div class="col-md-3 pl-1">
                            <div class="form-group">
                                <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 pl-1">
                            <div class="form-group">
                                <?= $form->field($model, 'subject')->textInput(['required'=>true]) ?>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <?= $form->field($model, 'message')->textarea(['maxlength' => true,'rows'=>6]) ?>
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <?= $form->field($model, 'file')->fileInput() ?>
                            </div>
                        </div>

                    </div>
                    <div class="form-group pull-right">
                        <?= Html::submitButton(Yii::t('yii', 'Submit'), ['class' => 'btn btn-success']) ?>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php
}
?>

