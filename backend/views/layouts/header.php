<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">ZSSF</span><span class="logo-lg">' . Yii::t('yii', 'ZSSF ADMIN PORTAL') . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <?php Html::a(Yii::t('yii', 'ZSSF ADMIN PORTAL'), ['site/home'], ['class' => 'navbar-brand', 'style' => 'color: #EFDC07']) ?>

        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->



                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/profile/images.png" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">
                           <?php
                           if (!Yii::$app->user->isGuest) {

                                   echo Yii::$app->user->identity->username;
                           }
                           ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="padding-left: 90px">
                            <img src="<?php

                            echo Yii::$app->request->baseUrl . '../../profile/images.png';

                            ?>"  class
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">

                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    Yii::t('yii','Sign out'),
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
<!--                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->

                </li>
            </ul>
        </div>
    </nav>
</header>
