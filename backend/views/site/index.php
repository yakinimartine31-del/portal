<?php

/* @var $this yii\web\View */

use backend\assets\AppAsset;
use backend\models\UserCounters;
use yii\helpers\Html;

$this->title = Yii::t('yii', 'Dashboard');
AppAsset::register($this);

?>
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-certificate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Online Members</span>
                    <span class="info-box-number">
                        <?php  Yii::$app->userCounter->getOnline(); ?>
                        <?php
                        UserCounters::Online()
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-certificate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">
                   Today Visitors

                    </span>
                    <span class="info-box-number">
                        <?php  Yii::$app->userCounter->getToday(); ?>
                        <?php
                        UserCounters::TodayVisitors()
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-certificate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">
                        <?= Html::a(Yii::t('yii', "Today </br>Contacted Us"), ['user-feedback/today-contact']); ?>
                    </span>
                    <span class="info-box-number"><?= \backend\models\UserFeedback::TodayFeedback() ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

<!--        <div class="col-md-3 col-sm-6 col-xs-12">-->
<!--            <div class="info-box">-->
<!--                <span class="info-box-icon bg-green"><i class="fa fa-certificate"></i></span>-->
<!---->
<!--                <div class="info-box-content">-->
<!--                    <span class="info-box-text">Yesterday Visitors</span>-->
<!--                    <span class="info-box-number">-->
<!--                        --><?php //echo Yii::$app->userCounter->getYesterday(); ?>
<!--                    </span>-->
<!--                </div>-->
                <!-- /.info-box-content -->
<!--            </div>-->
            <!-- /.info-box -->
<!--        </div>-->
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-certificate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Total Visitors</span>
                    <span class="info-box-number">
                        <?php  Yii::$app->userCounter->getTotal(); ?>
                        <?php
                        UserCounters::AllVisitors()
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-certificate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">

                 <?= Html::a(Yii::t('yii', "Today </br>Complaints"), ['complaints/today-complaints']); ?>

                    </span>
                    <span class="info-box-number"><?= \backend\models\Complaints::todayComplaints() ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-certificate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">

                           <?= Html::a(Yii::t('yii', "Sorted </br>Complaints"), ['complaints/sorted']); ?>
                    </span>
                    <span class="info-box-number"><?= \backend\models\Complaints::SortedComplaints() ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>






        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-certificate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">

                         <?= Html::a(Yii::t('yii', "Activated<br> Accounts"), ['users/activated']); ?>

                    </span>
                    <span class="info-box-number"><?= \backend\models\Users::TotalActiveAccounts() ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-certificate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">

                                <?= Html::a(Yii::t('yii', "All Members"), ['zssf-members/']); ?>
                    </span>
                    <span class="info-box-number"><?= \backend\models\Users::TotalAllMembers() ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-certificate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">

                           <?= Html::a(Yii::t('yii', "Pending </br>Complaints"), ['complaints/pending']); ?>
                    </span>
                    <span class="info-box-number"><?= \backend\models\Complaints::PendingComplaints() ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-certificate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Web Portal <br>Login counts</span>
                    <span class="info-box-number"><?= \backend\models\AuditTrial::TotalWebLogins() ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-certificate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">  Mobile<br> Login Counts</span>
                    <span class="info-box-number"><?= \backend\models\AuditTrial::TotalAppLogins() ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-certificate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">

                          <?= Html::a(Yii::t('yii', "All Employers"), ['zssf-members/employers']); ?>
                    </span>
                    <span class="info-box-number"><?= \backend\models\Employers::AllEmployers() ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
    </div>

    <!-- /.row -->

</section>

<script>


function myFunction() {
    
    event.preventDefault();
    


</script>

