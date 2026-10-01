<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('yii', 'Contact Us');
$this->params['breadcrumbs'][] = $this->title;

$data = \backend\models\CommonZssfSettings::findOne(['id' => 1]);
$hq_mobile_number = $data['hq_mobile_number'];
$head_office_fax_number = $data['head_office_fax_number'];
$pemba_fax_number = $data['pemba_fax_number'];
$pemba_mobile_number = $data['pemba_mobile_number'];
$contact_email = $data['contact_email'];
$youtube = $data['youtube_link'];
?>

<div class="row">

    <div class="col-md-4">
        <h4 class="mt-lg-0 mt-sm-4"><span class="connect"><?= Yii::t('yii', 'HEAD OFFICE') ?> </span></h4>
        <p>P.O BOX 2716, Kilimani, Mnara wa Mbao</p>
        <p class="mb-0"><i class="fa fa-phone mr-3"></i> <?= Yii::t('yii', 'Phone:') ?> <span class="connect"><?= $hq_mobile_number?> </span>
        </p>
        <p class="mb-0"><i class="fa fa-phone mr-3"></i><?= Yii::t('yii', 'Fax:') ?> <span
                    class="connect"><?= $head_office_fax_number?> </span></p>
        <p><i class="fa fa-envelope-o mr-3"></i><?= Yii::t('yii', 'Email:') ?> <span
                    class="connect"> <?=$contact_email ?> </span></p>
        <p><a href="https://zssf.or.tz/en/index.php" target="_blank"><i
                        class="fa fa-circle mr-3"></i><?= Yii::t('yii', 'Website:') ?> <span class="connect"> www.zssf.org </span></a>
        </p>
    </div>
    <div class="col-md-4">
        <!--Google map-->
        <div id="map-container-google-11" class="z-depth-1-half map-container-6" style="height: 50px;width: 500px">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3228.055447138144!2d39.202182901277055!3d-6.
                    179648602983759!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185cd0848851a343%3A0x53cbc97ce3454f02!2s
                    Zanzibar%20Social%20Security%20Fund!5e1!3m2!1sen!2stz!4v1587717563861!5m2!1sen!2stz"
                    frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
    <div class="col-md-4">
            <h4 class="mt-lg-0 mt-sm-4"><span class="connect"><?= Yii::t('yii', 'PEMBA BRANCH') ?>  </span></h4>
            <p class="mb-0"><i class="fa fa-phone mr-3"></i><?= Yii::t('yii', 'Phone:') ?> <span class="connect"><?= $pemba_mobile_number?> </span>
            </p>
            <p class="mb-0"><i class="fa fa-phone mr-3"></i><?= Yii::t('yii', 'Fax:') ?> <span class="connect"><?= $pemba_fax_number ?> </span>
            </p>

    </div>
</div>
<hr>
<?php if (Yii::$app->session->getFlash('success')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-info'],
        'body' => Yii::$app->session->getFlash('success'),
    ]);
}
?>
<?php if (!Yii::$app->user->isGuest) { ?>
    <div class="site-contact">
        <div class="row">
            <div class="col-lg-12">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'readOnly' => true]) ?>
                    </div>
                    <div class="col-lg-4">
                        <?= $form->field($model, 'email')->textInput(['readOnly' => true]) ?>
                    </div>
                    <div class="col-lg-4">
                        <?= $form->field($model, 'subject') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row">
                                     <div class="col-lg-8">{image}{input}
                                     </div>
                                    ',
                        ]) ?>
                    </div>

                    <div class="pull-right">
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('yii', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>

                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <hr>
<?php } else { ?>
    <div class="site-contact">
        <div class="row">
            <div class="col-lg-12">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="col-lg-4">
                        <?= $form->field($model, 'email') ?>
                    </div>
                    <div class="col-lg-4">
                        <?= $form->field($model, 'subject') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row">
                                     <div class="col-lg-8">{image}{input}
                                     </div>
                                    ',
                        ]) ?>
                    </div>

                    <div class="pull-right">
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('yii', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>

                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

<?php } ?>
