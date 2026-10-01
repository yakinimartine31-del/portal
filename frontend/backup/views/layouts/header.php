<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<nav role="navigation" class="navbar navbar-custom" style="background-color: #033B6A">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button data-target="#bs-content-row-navbar-collapse-5" data-toggle="collapse" class="navbar-toggle"
                    type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php Html::a(Yii::t('yii', 'ZSSF MEMBERS WEB PORTAL'), ['site/home'], ['class' => 'navbar-brand', 'style' => 'color: #EFDC07']) ?>
            <?php if (Yii::$app->language == 'en'){
                echo   Html::img('images/members2.png', ['alt'=>'logo', 'class'=>'profile-img','height'=>'60px' ]);
            }
            else{
                echo   Html::img('images/members1.png', ['alt'=>'logo', 'class'=>'profile-img','height'=>'60px' ]);
            }

            ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="bs-content-row-navbar-collapse-5" class="collapse navbar-collapse" >
            <ul class="nav navbar-nav navbar-right" style=" font-weight: bold; font-family: Segoe UI, Helvetica, Arial, sans-serif" >
                <li class="active"><?= Html::a(Yii::t('yii', 'HOME'), ['site/home'],['style' => 'color:white']) ?></li>

                <li class="active"><a href="<?=Url::toRoute(['site/about']) ?>" style="color: white"> <?=Yii::t('yii', 'ABOUT ZSSF') ?></a></li>

                <li class="active"><a href="<?=Url::toRoute(['site/contact']) ?>" style="color: white"> <?=Yii::t('yii', 'CONTACT US') ?></a></li>


                <?php if (Yii::$app->user->isGuest) { ?>
                    <li class="active"><a href="<?=Url::toRoute(['site/signup']) ?>" style="color: white"> <?=Yii::t('yii', 'SIGN UP') ?></a></li>
                <?php } ?>
                <?php if (Yii::$app->user->isGuest) { ?>
                    <li class="active"><a href="<?=Url::toRoute(['site/login']) ?>" style="color: white"> <?=Yii::t('yii', 'SIGN IN') ?></a></li>
                <?php } ?>
                <!-- <li class="disabled"><a href="#">Link</a></li> -->
                <?php if (Yii::$app->user->isGuest == false) { ?>
                    <li class="active"><?= Html::a("( ".Yii::$app->user->identity->username." ) ", ['user/profile'], ['data-method' => 'post', 'style' => 'padding-right:10px;color:white']) ?></li>
                    <li class="active"><?= Html::a("".Yii::t('yii','LOGOUT ')."<i class=\"fa fa-sign-out\"></i> ", ['site/logout'], ['data-method' => 'post', 'style' => 'padding-right:10px;color:white']) ?></li>
                <?php } ?>
                <li>
                    <?php
                    if (Yii::$app->language == 'ru') {


                        echo Html::a(Html::img('flags/en.png', ['alt'=>'flag', 'class'=>'flag', ]), Url::current(['language' => 'en']), ['class' => (Yii::$app->request->cookies['language'] == 'en' ? 'active' : '')]);
                    }
                    elseif (Yii::$app->language == 'en') {

                        echo Html::a(Html::img('flags/tz.png', ['alt'=>'flag', 'class'=>'flag', ]), Url::current(['language' => 'ru']), ['class' => (Yii::$app->request->cookies['language'] == 'ru' ? 'active' : '')]);
                    }
                    else{
                        echo Html::a(Html::img('flags/tz.png', ['alt'=>'flag', 'class'=>'flag', ]), Url::current(['language' => 'ru']), ['class' => (Yii::$app->request->cookies['language'] == 'ru' ? 'active' : '')]);
                    }
                    ?>
                </li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!--header-->
<!--header-->
