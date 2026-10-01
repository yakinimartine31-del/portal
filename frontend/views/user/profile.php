<?php

use kartik\dialog\Dialog;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\DetailView;

?>

<div class="content-row">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-info" data-collapsed="0">
                <div class="header">
                    <h5><?= Yii::t('yii', 'USER PROFILE INFORMATION') ?></h5>
                </div>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        [
                            'attribute' => 'id',
                            'label' => Yii::t('yii', 'Member Number'),
                            'value' => $model->member0->membership_number,
                        ],

                        [
                            'attribute' => 'id',
                            'label' => Yii::t('yii', 'Date of joining'),
                            // 'value' =>$model->member0->date_of_joining,
                            'value' => function ($model) {
                                if ($model->member0->date_of_joining != '') {
                                    $date = $model->member0->date_of_joining;
                                    return Yii::$app->formatter->asDate($date, 'Y-M-d');
                                } else {
                                    return '';
                                }
                            }
                        ],
                        [
                            'attribute' => 'id',
                            'label' => Yii::t('yii', 'Gender'),
                            'value' => $model->member0->gender,
                        ],
                        [
                            'attribute' => 'id',
                            'label' => Yii::t('yii', 'Marital Status'),
                            'value' => $model->member0->marital_status,
                        ],
                        'email:email',
                        [
                            'attribute' => 'id',
                            'label' => Yii::t('yii', 'Phone Number'),
                            'value' => $model->member0->mobile_number,
                        ],

                        [
                            'attribute' => 'id',
                            'label' => Yii::t('yii', 'Previous Phone Number'),
                            'value' => $model->member0->previous_mobile_numbers,
                        ],
                        [
                            'attribute' => 'id',
                            'label' => Yii::t('yii', 'Date of Birth'),
                            'value' => $model->member0->date_of_birth,
                        ],
                        [
                            'attribute' => 'id',
                            'label' => Yii::t('yii', 'Address'),
                            'value' => $model->member0->address,
                        ],
                        [
                            'attribute' => 'id',
                            'label' => Yii::t('yii', 'Zanzibar ID'),
                            'value' => $model->member0->national_id,
                        ],
                    ],
                ]) ?>

            </div>
        </div>
        <div class="col-md-3  text-left">
            <img src="<?php

            if ($model->member0->photo != '') {
                echo Yii::$app->request->baseUrl . '/../../api/' . $model->member0->photo;
            } else {
                echo Yii::$app->request->baseUrl . '/images/members1.png';

            }
            ?>" width='150px' height='150px' align='center' style='vertical-align: middle'>
            <br/><br/>
            <p><b><?= Yii::t('yii', 'Full Name:') ?></b> <?= $model->name ?></p>
            <p><b><?= Yii::t('yii', 'Member ID:') ?></b> <?= $model->member0->membership_number ?></p>
            <p><b><?= Yii::t('yii', 'Username:') ?></b> <?= $model->username ?></p>
            <hr>
            <p>
                <?php Html::a(Yii::t('yii', 'Update Profile'), ['update', 'id' => $model->id], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => Yii::t('yii', 'Are you sure you want to update your profile?'),
                        'method' => 'post',
                    ],
                ]) ?>
                <?php echo '<button type="button" id="btn-custom-2" class="btn btn-primary">' . Yii::t('yii', 'Update Profile') . '</button>'; ?>

                <?php
                $id=Yii::$app->user->identity->getId();
                echo Dialog::widget([
                    'libName' => 'krajeeDialogCust2', // a custom lib name
                    'options' => [  // customized BootstrapDialog options
                        'size' => Dialog::SIZE_WIDE, // large dialog text
                        'type' => Dialog::TYPE_INFO, // bootstrap contextual color
                        'title' => Yii::t('yii', 'Information Management'),
                        'message1' => '',
                        'nl2br' => false,
                        'buttons' => [
                            [
                                'id' => 'cust-submit-btn',
                                'label' => Yii::t('yii', 'Change Password'),
                                'cssClass' => 'btn-success pull-left',
                                'hotkey' => 'S',
                                'action' => new JsExpression("function(dialog) {
                    if (typeof dialog.getData('callback') === 'function' && dialog.getData('callback').call(this, true) === false) {
                        return false;
                    }
 
                     window.location.href = \"/portal/user/other/$id\";
                }")
                            ],
                            [
                                'id' => 'cust-cancel-btn',
                                'label' => Yii::t('yii', 'Other Information'),
                                'cssClass' => 'btn-primary pull-right',
                                'hotkey' => 'C',
                                'action' => new JsExpression("function(dialog) {
                    if (typeof dialog.getData('callback') === 'function' && dialog.getData('callback').call(this, false) === false) {
                        return false;
                    }
                     window.location.href = \"/portal/user/other/$id\";
                    return dialog.close();
                }")
                            ],
                        ]
                    ]
                ]);

                // button markups for launching the custom krajee dialog box


                // javascript for triggering the dialogs
                $js = <<< JS
$("#btn-custom-2").on("click", function() {
    krajeeDialogCust2.dialog("",
        function(result) {
            // do something
        }
    );
});

$("#btn-custom-1").on("click", function() {
    krajeeDialogCust2.dialog(
        $('#kv-test-msg').val(), // markup stored in a hidden textarea
        function(result) {
            // do something
        }
    );
});
JS;

                // register your javascript
                $this->registerJs($js);
                ?>
            </p>
        </div>
        <div class="col-lg-9">
            <div>
                <?php
                $searchModel = new \frontend\models\Employments();
                $member = \frontend\models\Members::find()->where(['uid' => Yii::$app->user->identity->getId()])->one();
                $dataProvider = $searchModel->searchMember($member['membership_number']);
                ?>
                <?php
                $member = \frontend\models\Members::find()->where(['uid' => Yii::$app->user->identity->getId()])->one();
                $user = \frontend\models\Employments::find()
                    ->where(['member_code' => $member['membership_number']])
                    //->groupBy(['employer_name'])
                    ->one();

                if ($user != '') {
                    ?>
                    <div class="header">
                        <h5><?= Yii::t('yii', 'EMPLOYMENT HISTORY') ?></h5>
                    </div>

                    <?= \yii\grid\GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        'summary' => '',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            [
                                'attribute' => 'employer_name',
                            ],
                            [
                                'attribute' => 'employment_appointment',
                                'format' => ['DateTime', 'php:d-M-Y']
                            ],

                        ],
                    ]);
                    ?>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-9">
            <div>
                <?php
                $searchModel = new \frontend\models\Members34Repeat();
                $member = \frontend\models\Members::find()->where(['uid' => Yii::$app->user->identity->getId()])->one();
                $dataProvider = $searchModel->searchDependant($member['id']);
                ?>
                <?php
                $member = \frontend\models\Members::find()->where(['uid' => Yii::$app->user->identity->getId()])->one();
                $user = \frontend\models\Members34Repeat::find()->where(['parent_id' => $member['id']])->one();
                //  if ($user != ''){
                ?>
                <div class="header">
                    <h5><?= Yii::t('yii', 'DEPENDANT') ?></h5>
                </div>

                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'summary' => '',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        [
                            'attribute' => 'dependent_names',
                        ],
                        [
                            'attribute' => 'relationship',
                        ],

                    ],
                ]);
                ?>

            </div>
        </div>
    </div>
</div>
