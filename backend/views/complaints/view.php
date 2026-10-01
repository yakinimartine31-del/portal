<?php

use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Complaints */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Complaints'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// ✅ UPDATED LOGIC: Forwarded complaints should remain Pending
$pendingStatusValues = [1, '1', 'Pending', null, ''];
$sortedStatusValues = [0, '0', 'Sorted'];

// ✅ FIXED: Updated logic to handle forwarded complaints correctly
$isAutoSorted = function ($model) {
    // Check if complaint has been PROPERLY responded to (not just forwarded)
    // 1. Has actual response_message (not empty)
    if (!empty($model->response_message) && trim($model->response_message) !== '') {
        return true;
    }
    
    // 2. Status_type is explicitly set to Sorted values
    if (in_array($model->status_type, [0, '0', 'Sorted'])) {
        return true;
    }
    
    // 3. If only respond_date or response_by is set (from forwarding), don't auto-sort
    return false;
};

$formatStatus = function ($model) use ($pendingStatusValues, $sortedStatusValues, $isAutoSorted) {
    $status = $model->status_type;
    
    // 1. If status_type is already 'Sorted' values
    if (in_array($status, $sortedStatusValues, true)) {
        return 'Sorted';
    }
    
    // 2. If has actual response_message (not empty)
    if (!empty($model->response_message) && trim($model->response_message) !== '') {
        return 'Sorted';
    }
    
    // 3. If status_type is 'Pending' values
    if (in_array($status, $pendingStatusValues, true)) {
        return 'Pending';
    }
    
    // 4. Default to Pending
    return 'Pending';
};

// ✅ FIXED: Show pending actions for complaints that are still pending (including forwarded ones)
$showPendingActions = function ($model) use ($pendingStatusValues, $sortedStatusValues) {
    $status = $model->status_type;
    
    // If status_type is explicitly 'Sorted'
    if (in_array($status, $sortedStatusValues, true)) {
        return false;
    }
    
    // If has actual response_message (not empty) - then it's properly responded
    if (!empty($model->response_message) && trim($model->response_message) !== '') {
        return false;
    }
    
    // If status_type is 'Pending' or empty/null
    if (in_array($status, $pendingStatusValues, true) || empty($status)) {
        return true;
    }
    
    return false;
};

// ✅ NEW: Check if complaint is Sorted
$isSorted = function ($model) use ($sortedStatusValues) {
    $status = $model->status_type;
    
    // If status_type is explicitly 'Sorted'
    if (in_array($status, $sortedStatusValues, true)) {
        return true;
    }
    
    // If has response_by (even if no message - for "Sort without comment")
    if (!empty($model->response_by)) {
        return true;
    }
    
    // If has actual response_message (not empty)
    if (!empty($model->response_message) && trim($model->response_message) !== '') {
        return true;
    }
    
    return false;
};

// Check if we should show pending actions
$shouldShowPendingActions = $showPendingActions($model);
// Check if complaint is sorted
$isComplaintSorted = $isSorted($model);
?>
<?php if (Yii::$app->session->getFlash('form_success')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-info'],
        'body' => Yii::$app->session->getFlash('form_success'),
    ]);
} elseif (Yii::$app->session->getFlash('form_fail')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-danger'],
        'body' => Yii::$app->session->getFlash('form_fail'),
    ]);
} elseif (Yii::$app->session->getFlash('otp_success')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-info'],
        'body' => Yii::$app->session->getFlash('otp_success'),
    ]);
} elseif (Yii::$app->session->getFlash('otp_fail')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-danger'],
        'body' => Yii::$app->session->getFlash('otp_fail'),
    ]);
} elseif (Yii::$app->session->getFlash('details_success')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-info'],
        'body' => Yii::$app->session->getFlash('details_success'),
    ]);
} elseif (Yii::$app->session->getFlash('details_fail')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-danger'],
        'body' => Yii::$app->session->getFlash('details_fail'),
    ]);
}
?>
<div class="complaints-view">
    <hr>
    <p>
        <?= Html::a(Yii::t('yii', 'Back Home'), ['back'], ['class' => 'btn btn-info']) ?>
        
        <?php if ($shouldShowPendingActions): ?>
            <!-- ✅ PENDING COMPLAINTS: Show all buttons -->
            <?= Html::a(Yii::t('yii', 'Sort with no comment'), ['sort', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => Yii::t('yii', 'Are you sure you want to mark this complaints as sorted ?'),
                    'method' => 'post',
                ],
            ]) ?>
            
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                Forward Complaint
            </button>
            
        <?php endif; ?>
        
        <!-- ✅ RESPOND WITH MESSAGE: Show for BOTH Pending AND Sorted complaints -->
        <?php Modal::begin([
            'header' => '<h4 class="text text-primary">' . Yii::t('yii', 'RESPOND TO MEMBER COMPLAINTS FORM') . ' </h4>',
            'toggleButton' => ['label' => ' <i class="fa fa-times-circle"></i>' . Yii::t('yii', 'Respond With Message'), 'class' => 'btn btn-success',],
            'size' => Modal::SIZE_DEFAULT,
            'options' => ['class' => 'slide', 'id' => 'modal-2'],
        ]); ?>
        
        <div class="product-form" style="margin-left: 10px">
            <?php $form = ActiveForm::begin(['action' => ['respond', 'id' => $model->id]]); ?>

            <?= $form->field($model, 'method')->dropDownList(['email' => Yii::t('yii', 'Through Email'), 'sms' => Yii::t('yii', 'Through SMS')],
                ['prompt' => Yii::t('yii', '--- Select Response Method ---'), 'multiple' => 'multiple']) ?>

            <?= $form->field($model, 'response')->textarea(['maxlength' => true, 'rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('yii', 'Submit'), ['class' => $model->isNewRecord ? 'btn b btn-success' : 'btn btn-success']) ?>
                <?= Html::a(Yii::t('yii', 'Cancel'), ['index'], ['class' => 'btn btn-warning']) ?>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
        
        <?php Modal::end(); ?>
    </p>

    <!-- Modal for Forwarding (only for pending complaints) -->
    <?php if ($shouldShowPendingActions): ?>
    <div class="container">
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Forward Complaints Form</h4>
                    </div>
                    <div class="modal-body">
                        <div class="complaints-form">
                            <?php $form = ActiveForm::begin(['action' => ['forward', 'id' => $model->id]]); ?>

                            <?= $form->field($model, 'category')
                                ->dropDownList(\frontend\models\ComplaintsCategories::getAll(),
                                    ['prompt' => Yii::t('yii', '-- Select Type --')])->label(false) ?>

                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('yii', 'Forward'), ['class' => 'btn btn-success']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Detail View WITH Response By (shows for ALL sorted complaints - with or without comment) -->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date_time',
            'zssf_number',
            'subject',
            [
                'attribute' => 'category',
                'value' => $model->category0 ? $model->category0->category_name : ''
            ],
            'message:ntext',
            [
                'attribute' => 'photo_file',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->photo_file == null) {
                        return '';
                    } elseif ($model->photo_file != null) {
                        $previewUrl = \yii\helpers\Url::to(['preview-image', 'id' => $model->id]);
                        return Html::a('<i class="fa fa-file text-green"></i> View Photo', $previewUrl, ['target' => '_blank', 'data-pjax' => "0"]);
                    }
                }
            ],
            'email_address:email',
            'phone_number',
            [
                'attribute' => 'status_type',
                'value' => function ($model) use ($formatStatus) {
                    return $formatStatus($model);
                }
            ],
            [
                'attribute' => 'response_message',
                'format' => 'ntext',
                'value' => function ($model) {
                    // ✅ Show empty string if response_message is empty
                    return !empty($model->response_message) ? $model->response_message : '';
                }
            ],
            [
                'attribute' => 'response_by',
                'value' => function ($model) {
                    // ✅ FIXED: Shows if response_by is set (even for "Sort without comment")
                    // ✅ Condition 1: If response_by exists (not null/empty)
                    if (!empty($model->response_by) && is_numeric($model->response_by)) {
                        // ✅ Condition 2: Check if user exists in database
                        $user = \frontend\models\User::findOne($model->response_by);
                        if ($user) {
                            return $user->username;
                        } else {
                            return 'User ID: ' . $model->response_by;
                        }
                    }
                    // ✅ Condition 3: Return empty string if no response_by
                    return '';
                },
                'visible' => function ($model) {
                    // ✅ Show this field only if response_by exists
                    return !empty($model->response_by);
                }
            ],
            [
                'attribute' => 'respond_date',
                'format' => ['datetime', 'php:Y-m-d H:i:s'],
                'visible' => function ($model) {
                    // ✅ Show this field only if respond_date exists
                    return !empty($model->respond_date);
                }
            ],
        ],
    ]) ?>

</div>