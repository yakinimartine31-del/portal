<?php

/* @var $this yii\web\View */

use backend\assets\AppAsset;

$this->title = Yii::t('yii', 'Dashboard');
AppAsset::register($this);
?>

<div class="hk-row">

    <div class="col-sm-3">
        <div class="card card-sm bg-gradient-dusk border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5">
                    <div>
                        <span class="d-block font-10 text-white font-weight-200">Online Members</span>
                    </div>
                    <div>
                        <span class="text-white font-14 font-weight-500">&nbsp;</span>
                    </div>
                </div>
                <div>
                    <span class="d-block display-4 text-white mb-5">&nbsp;</span>
                    <small class="d-block text-white"><?php echo Yii::$app->userCounter->getOnline(); ?></small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="card card-sm bg-gradient-ashes border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5">
                    <div>
                        <span class="d-block font-15 text-white font-weight-500">Today Visitors</span>
                    </div>
                    <div>
                        <span class="text-white font-14 font-weight-500">&nbsp;</span>
                    </div>
                </div>
                <div>
                    <span class="d-block display-4 text-white mb-5">&nbsp;</span>
                    <small class="d-block text-white"><?php echo Yii::$app->userCounter->getToday(); ?></small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card card-sm bg-gradient-pony border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5">
                    <div>
                        <span class="d-block font-15 text-white font-weight-500">Yesterday Visitors</span>
                    </div>
                    <div>
                        <span class="text-white font-14 font-weight-500">&nbsp;</span>
                    </div>
                </div>
                <div>
                    <span class="d-block display-4 text-white mb-5">&nbsp;</span>
                    <small class="d-block text-white"><?php echo Yii::$app->userCounter->getYesterday(); ?></small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card card-sm bg-gradient-warbler border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5">
                    <div>
                        <span class="d-block font-15 text-white font-weight-500">Total Visitors</span>
                    </div>
                    <div>
                        <span class="text-white font-14 font-weight-500">&nbsp;</span>
                    </div>
                </div>
                <div>
                    <span class="d-block display-4 text-white mb-5">&nbsp;</span>
                    <small class="d-block text-white"><?php echo Yii::$app->userCounter->getTotal(); ?></small>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="hk-row">

    <div class="col-sm-3">
        <div class="card card-sm bg-gradient-info border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5">
                    <div>
                        <span class="d-block font-10 text-white font-weight-200">Today Complaints</span>
                    </div>
                    <div>
                        <span class="text-white font-14 font-weight-500">&nbsp;</span>
                    </div>
                </div>
                <div>
                    <span class="d-block display-4 text-white mb-5"><?=  \backend\models\Complaints::todayComplaints() ?></span>
                    <small class="d-block text-white">&nbsp;</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="card card-sm bg-gradient-success border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5">
                    <div>
                        <span class="d-block font-15 text-white font-weight-500">Today Contacted Us</span>
                    </div>
                    <div>
                        <span class="text-white font-14 font-weight-500">&nbsp;</span>
                    </div>
                </div>
                <div>
                    <span class="d-block display-4 text-white mb-5">&nbsp;</span>
                    <small class="d-block text-white"><?=  \backend\models\UserFeedback::TodayFeedback() ?></small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card card-sm bg-gradient-paradise border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5">
                    <div>
                        <span class="d-block font-15 text-white font-weight-500">Total Activated Accounts</span>
                    </div>
                    <div>
                        <span class="text-white font-14 font-weight-500">&nbsp;</span>
                    </div>
                </div>
                <div>
                    <span class="d-block display-4 text-white mb-5">&nbsp;</span>
                    <small class="d-block text-white"><?= \backend\models\Users::TotalActiveAccounts() ?></small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card card-sm bg-gradient-danger border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5">
                    <div>
                        <span class="d-block font-15 text-white font-weight-500">Setups</span>
                    </div>
                    <div>
                        <span class="text-white font-14 font-weight-500">+10%</span>
                    </div>
                </div>
                <div>
                    <span class="d-block display-4 text-white mb-5">19M</span>
                    <small class="d-block text-white">172,458 Target Users</small>
                </div>
            </div>
        </div>
    </div>
</div>

 <?php  Yii::$app->userCounter->getMaximal(); ?>
 <?php  date('d.m.Y', Yii::$app->userCounter->getMaximalTime()); ?>
<style>
    .hk-row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -7px;
        margin-left: -7px;
    }

    .hk-row > .col,
    .hk-row > [class*="col-"] {
        padding-right: 7px;
        padding-left: 7px;
    }
    .card.card-sm .card-header,
    .card.card-sm .card-footer {
        padding: .75rem 1rem;
    }

    .card.card-sm .card-body {
        padding: 1rem;
    }
    .bg-gradient-primary {
        background: #88c241;
        background: linear-gradient(45deg, #88c241, #6640b2) !important;
        background: -webkit-bg-linear-gradient(45deg, #88c241, #6640b2) !important;
    }

    .bg-gradient-info {
        background: #1ebccd;
        background: linear-gradient(45deg, #1ebccd, #3a55b1) !important;
        background: -webkit-bg-linear-gradient(45deg, #1ebccd, #3a55b1) !important;
    }

    .bg-gradient-success {
        background: #22af47;
        background: linear-gradient(45deg, #22af47, #d0d962) !important;
        background: -webkit-bg-linear-gradient(45deg, #22af47, #d0d962) !important;
    }

    .bg-gradient-warning {
        background: #ffbf36;
        background: linear-gradient(45deg, #ffbf36, #ff6028) !important;
        background: -webkit-bg-linear-gradient(45deg, #ffbf36, #ff6028) !important;
    }

    .bg-gradient-danger {
        background: #f83f37;
        background: linear-gradient(45deg, #f83f37, #ab26aa) !important;
        background: -webkit-bg-linear-gradient(45deg, #f83f37, #ab26aa) !important;
    }

    .bg-gradient-secondary {
        background: #9e9e9e;
        background: linear-gradient(45deg, #9e9e9e, #5e7d8a) !important;
        background: -webkit-bg-linear-gradient(45deg, #9e9e9e, #5e7d8a) !important;
    }

    .bg-gradient-light {
        background: #f5f5f6;
        background: linear-gradient(45deg, #f5f5f6, #9e9e9e) !important;
        background: -webkit-bg-linear-gradient(45deg, #f5f5f6, #9e9e9e) !important;
    }

    .bg-gradient-dark {
        background: #324148;
        background: linear-gradient(45deg, #324148, #7a5449) !important;
        background: -webkit-bg-linear-gradient(45deg, #324148, #7a5449) !important;
    }

    .bg-gradient-pony {
        background: #ed1b60;
        background: linear-gradient(45deg, #ed1b60, #1ebccd) !important;
        background: -webkit-bg-linear-gradient(45deg, #ed1b60, #1ebccd) !important;
    }

    .bg-gradient-space {
        background: #ab26aa;
        background: linear-gradient(45deg, #ab26aa, #fde335) !important;
        background: -webkit-bg-linear-gradient(45deg, #ab26aa, #fde335) !important;
    }

    .bg-gradient-streaks {
        background: #6640b2;
        background: linear-gradient(45deg, #6640b2, #009b84) !important;
        background: -webkit-bg-linear-gradient(45deg, #6640b2, #009b84) !important;
    }

    .bg-gradient-bunting {
        background: #3a55b1;
        background: linear-gradient(45deg, #3a55b1, #7a5449) !important;
        background: -webkit-bg-linear-gradient(45deg, #3a55b1, #7a5449) !important;
    }

    .bg-gradient-paradise {
        background: #0092ee;
        background: linear-gradient(45deg, #0092ee, #88c241) !important;
        background: -webkit-bg-linear-gradient(45deg, #0092ee, #88c241) !important;
    }

    .bg-gradient-heaven {
        background: #88c241;
        background: linear-gradient(45deg, #88c241, #00acf0) !important;
        background: -webkit-bg-linear-gradient(45deg, #88c241, #00acf0) !important;
    }

    .bg-gradient-honey {
        background: #d0d962;
        background: linear-gradient(45deg, #d0d962, #ff9528) !important;
        background: -webkit-bg-linear-gradient(45deg, #d0d962, #ff9528) !important;
    }

    .bg-gradient-warbler {
        background: #fde335;
        background: linear-gradient(45deg, #fde335, #9e9e9e) !important;
        background: -webkit-bg-linear-gradient(45deg, #fde335, #9e9e9e) !important;
    }

    .bg-gradient-dusk {
        background: #ff9528;
        background: linear-gradient(45deg, #ff9528, #6640b2) !important;
        background: -webkit-bg-linear-gradient(45deg, #ff9528, #6640b2) !important;
    }

    .bg-gradient-citrine {
        background: #ff6028;
        background: linear-gradient(45deg, #ff6028, #7a5449) !important;
        background: -webkit-bg-linear-gradient(45deg, #ff6028, #7a5449) !important;
    }

    .bg-gradient-royston {
        background: #7a5449;
        background: linear-gradient(45deg, #7a5449, #009b84) !important;
        background: -webkit-bg-linear-gradient(45deg, #7a5449, #009b84) !important;
    }

    .bg-gradient-ashes {
        background: #5e7d8a;
        background: linear-gradient(45deg, #5e7d8a, #324148) !important;
        background: -webkit-bg-linear-gradient(45deg, #5e7d8a, #324148) !important;
    }

    .bg-gradient-metal {
        background: #c1993f;
        background: linear-gradient(45deg, #c1993f, #9e9e9e) !important;
        background: -webkit-bg-linear-gradient(45deg, #c1993f, #9e9e9e) !important;
    }

    .bg-gradient-sunset {
        background: #009b84;
        background: linear-gradient(45deg, #009b84, #ff6028) !important;
        background: -webkit-bg-linear-gradient(45deg, #009b84, #ff6028) !important;
    }

    /*Card*/
    .card {
        margin-bottom: 14px;
        border-radius: .6rem;
    }
    .btn.btn-wth-icon .icon-label {
        background: rgba(0, 0, 0, 0.08) none repeat scroll 0 0;
        position: absolute;
        border-radius: .25rem;
        top: -2px;
        left: -2px;
        bottom: -2px;
        width: 40px;
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        justify-content: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
    }

    .text-neon {
        color: #88c241 !important;
    }

    .text-lime {
        color: #d0d962 !important;
    }

    .text-sun {
        color: #fde335 !important;
    }

    .text-orange {
        color: #ff9528 !important;
    }

    .text-pumpkin {
        color: #ff6028 !important;
    }

    .text-brown {
        color: #7a5449 !important;
    }

    .text-gold {
        color: #c1993f !important;
    }

    .text-smoke,
    .text-muted {
        color: #5e7d8a !important;
    }

    .text-grey,
    .text-secondary {
        color: #9e9e9e !important;
    }

    .text-dark {
        color: #324148 !important;
    }

    .text-light {
        color: #848d91 !important;
    }

    .text-white {
        color: #fff !important;
    }

</style>

