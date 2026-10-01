<?php

/* @var $this \yii\web\View */

/* @var $content string */

use frontend\models\Members;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

$data = \backend\models\CommonZssfSettings::findOne(['id' => 1]);
$insta = $data['instagram_link'];
$twitter = $data['twitter_link'];
$facebook = $data['facebook_link'];
$youtube = $data['youtube_link'];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="dist/css/site.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic"
          rel="stylesheet" type="text/css">

    <?php if (Yii::$app->controller->action->id != 'signup') { ?>
        <script type="text/javascript" src="dist/js/site.min.js"></script>
    <?php } ?>



</head>
<body>
<?php $this->beginBody() ?>

<?php
if (Yii::$app->controller->action->id === 'login' || Yii::$app->controller->action->id === 'home'
|| Yii::$app->controller->action->id == 'logout') { ?>
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
            <?php if (Yii::$app->language == 'en') {
                echo Html::img('images/members2.png', ['alt' => 'logo', 'class' => 'profile-img', 'height' => '60px']);
            } else {
                echo Html::img('images/members1.png', ['alt' => 'logo', 'class' => 'profile-img', 'height' => '60px']);
            }

            ?>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="bs-content-row-navbar-collapse-5" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right"
                style=" font-weight: bold; font-family: Segoe UI, Helvetica, Arial, sans-serif">
                <li class="active"><?= Html::a(Yii::t('yii', 'HOME'), ['site/home'], ['style' => 'color:white']) ?></li>

                <li class="active"><a href="<?= Url::toRoute(['site/about']) ?>"
                                      style="color: white"> <?= Yii::t('yii', 'ABOUT ZSSF') ?></a></li>

                <li class="active"><a href="<?= Url::toRoute(['site/contact']) ?>"
                                      style="color: white"> <?= Yii::t('yii', 'CONTACT US') ?></a></li>


                <?php if (Yii::$app->user->isGuest) { ?>
                    <li class="active"><a href="<?= Url::toRoute(['site/signup']) ?>"
                                          style="color: white"> <?= Yii::t('yii', 'SIGN UP') ?></a></li>
                <?php } ?>
                <?php if (Yii::$app->user->isGuest) { ?>
                    <li class="active"><a href="<?= Url::toRoute(['site/login']) ?>"
                                          style="color: white"> <?= Yii::t('yii', 'SIGN IN') ?></a></li>
                <?php } ?>
                <!-- <li class="disabled"><a href="#">Link</a></li> -->
                <?php if (Yii::$app->user->isGuest == false) { ?>
                    <li class="active"><?= Html::a("( " . Yii::$app->user->identity->username . " ) ", ['user/profile'], ['data-method' => 'post', 'style' => 'padding-right:10px;color:white']) ?></li>
                    <li class="active"><?= Html::a("" . Yii::t('yii', 'LOGOUT ') . "<i class=\"fa fa-sign-out\"></i> ", ['site/logout'], ['data-method' => 'post', 'style' => 'padding-right:10px;color:white']) ?></li>
                <?php } ?>
                <li>
                    <?php
                    if (Yii::$app->language == 'ru') {


                        echo Html::a(Html::img('flags/en.png', ['alt' => 'flag', 'class' => 'flag',]), Url::current(['language' => 'en']), ['class' => (Yii::$app->request->cookies['language'] == 'en' ? 'active' : '')]);
                    } elseif (Yii::$app->language == 'en') {

                        echo Html::a(Html::img('flags/tz.png', ['alt' => 'flag', 'class' => 'flag',]), Url::current(['language' => 'ru']), ['class' => (Yii::$app->request->cookies['language'] == 'ru' ? 'active' : '')]);
                    } else {
                        echo Html::a(Html::img('flags/tz.png', ['alt' => 'flag', 'class' => 'flag',]), Url::current(['language' => 'ru']), ['class' => (Yii::$app->request->cookies['language'] == 'ru' ? 'active' : '')]);
                    }
                    ?>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid">
    <!--documents-->
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
            <ul class="list-group panel" style="font-size: 16px">
                <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>MENU</b></li>

                <?php if (!Yii::$app->user->isGuest) { ?>
                    <li style="list-style-type:none;">
                        <a href="<?= Url::toRoute(['user/profile']) ?>"
                           class="list-group-item glyphicon glyphicon-user"> <?= Yii::t('yii', 'My Profile') ?>
                            <span></span></a>
                    </li>

                    <li style="list-style-type:none;">
                        <a href="#demo1" class="list-group-item glyphicon glyphicon-book"
                           data-toggle="collapse"> <?= Yii::t('yii', 'Statements') ?> <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>
                    <li class="collapse" id="demo1">
                        <a href="<?= Url::toRoute(['contributions/view']) ?>"
                           class="list-group-item"><?= Yii::t('yii', 'Member Statements') ?></a>
                        <a href="<?= Url::toRoute(['contribution-trend/index']) ?>"
                           class="list-group-item"><?= Yii::t('yii', 'Contribution Statements') ?></a>

                    </li>
                    <li style="list-style-type:none">
                        <a href="#demo2" class="list-group-item glyphicon glyphicon-education"
                           data-toggle="collapse"> <?= Yii::t('yii', 'Benefits') ?> <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>
                    <li class="collapse" id="demo2">
                        <a href="<?= Url::toRoute(['buffer-results/index']) ?>"
                           class="list-group-item"> <?= Yii::t('yii', 'Test Benefits') ?></a>
                        <?php
                        $user = Members::find()->where(['uid' => Yii::$app->user->identity->getId()])->one();
                        $gender = $user['gender'];
                        if ($gender == 'Female') {
                            ?>
                            <a href="<?= Url::toRoute(['common-zssf-settings/maternity']) ?>"
                               class="list-group-item"> <?= Yii::t('yii', 'Maternity Benefits') ?></a>
                        <?php } ?>
                        <a href="<?= Url::toRoute(['buffer-results/projection']) ?>"
                           class="list-group-item"> <?= Yii::t('yii', 'Projection') ?></a>
                        <a href="<?= Url::toRoute(['benefit-type/benefit']) ?>"
                           class="list-group-item"> <?= Yii::t('yii', 'Benefits Types') ?></a>
                    </li>
                    <li style="list-style-type:none">
                        <a href="#demo3" class="list-group-item glyphicon glyphicon-stats"
                           data-toggle="collapse"><?= Yii::t('yii', ' Status Information') ?> <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>
                    <li class="collapse" id="demo3">
                        <a href="<?= Url::toRoute(['applications-statuses/index']) ?>"
                           class="list-group-item"><?= Yii::t('yii', 'Application Information') ?> </a>
                        <a href="<?= Url::toRoute(['members/card']) ?>"
                           class="list-group-item"><?= Yii::t('yii', 'ID Card Status') ?></a>

                    </li>

                <?php } ?>

                <li style="list-style-type:none">
                    <a href="#demo4" class="list-group-item glyphicon glyphicon-calendar"
                       data-toggle="collapse"> <?= Yii::t('yii', 'Calculator') ?> <span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                <li class="collapse" id="demo4">
                    <a href="<?= Url::toRoute(['calculator/contribution-calculator']); ?>"
                       class="list-group-item"><?= Yii::t('yii', 'Contribution Calculator') ?></a>
                    <a href="<?= Url::toRoute(['calculator/benefit-calculator']); ?>"
                       class="list-group-item"><?= Yii::t('yii', 'Benefits Calculator') ?></a>

                </li>

                <li style="list-style-type:none">
                    <a href="#demo7" class="list-group-item glyphicon glyphicon-envelope"
                       data-toggle="collapse"> <?= Yii::t('yii', 'SMS & Email') ?><span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                <li class="collapse" id="demo7">
                    <a href="<?= Url::toRoute(['statement/mail']); ?>"
                       class="list-group-item"><?= Yii::t('yii', 'Email Statement') ?></a>
                    <a href="<?= Url::toRoute(['statement/sms']); ?>"
                       class="list-group-item"><?= Yii::t('yii', 'SMS Statement') ?></a>

                </li>
                <li style="list-style-type:none">
                    <a href="<?= Url::toRoute(['complaints/complaints']) ?>"
                       class="list-group-item glyphicon glyphicon-question-sign"> <?= Yii::t('yii', 'Complaints') ?>
                        <span></span></a>
                </li>

                <?php if (!Yii::$app->user->isGuest) { ?>
                    <li style="list-style-type:none">
                        <a href="#demo6" class="list-group-item glyphicon glyphicon-cog"
                           data-toggle="collapse"> <?= Yii::t('yii', 'Setting') ?> <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>
                    <li class="collapse" id="demo6">
                        <a href="<?= Url::toRoute(['notifications-subscription/notify']) ?>"
                           class="list-group-item"> <?= Yii::t('yii', 'Subscription') ?> </a

                    </li>
                    <li style="list-style-type:none">
                        <a href="<?= Url::toRoute(['complaints/list']) ?>"
                           class="list-group-item glyphicon glyphicon-list"> <?= Yii::t('yii', 'Complaints List') ?>
                            <span></span></a>
                    </li>
                <?php } ?>

            </ul>
        </div>
        <div class="col-xs-12 col-sm-9 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a href="javascript:void(0);" class="toggle-sidebar">
                            <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel">

                            </span>
                        </a>
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>

                    </h3>
                </div>
                <div class="panel-body" style="padding-bottom: 80px">
                    <?php echo $content; ?>
                </div><!-- panel body -->
            </div>
        </div><!-- content -->
    </div>
</div>
<div class="site-footer" style="background-color: #033B6A">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-6">
                <ul>
                    <li>
                        <a style="color: white"><i class="icon" data-icon=""></i><?= Yii::t('yii', 'Social media') ?>
                        </a>&nbsp;&nbsp;&nbsp;
                        <a title="Twitter" href="<?= $twitter ?>" target="_blank" rel="external nofollow"><i
                                    class="fa fa-twitter" style="font-size: 2em;"></i></a>
                        <a title="Facebook" href="<?= $facebook ?>" target="_blank" rel="external nofollow"><i
                                    class="fa fa-facebook" style="font-size: 2em;"></i></a>
                        <a title="Instagram" href="<?= $insta ?>" target="_blank"
                           rel="external nofollow"><i class="fa fa-instagram" style="font-size: 2em;"></i></a>
                        <a title="Youtube" href="<?= $youtube ?>" target="_blank"
                           rel="external nofollow"><i class="fa fa-youtube" style="font-size: 2em;"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row" style="color: white">
            <div class="col-md-12">
                <p class="pull-left">Copyright
                    &copy; <?= Yii::t('yii', 'ZSSF Member Portal ') ?>
                    <?= date('Y') ?>

                    <?= Yii::t('yii', '. All Rights Reserved') ?></p>

                <p class="pull-right"><?php Yii::powered() ?></p>
            </div>
        </div>
    </div>
</div>
<?php
if (Yii::$app->session->getFlash('')) {
    echo \kartik\growl\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Notification!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : Yii::t('yii', 'Please sign up first and continue!'),
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
} elseif (Yii::$app->session->getFlash('complaints_success')) {
    echo \kartik\growl\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'success',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Notification!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : Yii::t('yii', Yii::t('yii', 'You have sent complaints successfully')),
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 5000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
} elseif (Yii::$app->session->getFlash('subscription_success')) {
    echo \kartik\growl\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'success',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Notification!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : Yii::t('yii', Yii::t('yii', 'Successfully')),
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 5000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
} elseif (Yii::$app->user->isGuest && Yii::$app->controller->action->id === 'home') {
    echo \kartik\growl\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'success',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : Yii::t('yii', 'Are you a new member ?'),
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-user',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : Html::a("" . Yii::t('yii', 'Click here to Register member Account  ') . "<i class=\"fa fa-sign-in\"></i> ", ['site/signup'], ['data-method' => 'post', 'style' => 'padding-right:10px;']),
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 9000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'center',
            ]
        ]
    ]);
}
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php } else { ?>
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
                <?php if (Yii::$app->language == 'en') {
                    echo Html::img('images/members2.png', ['alt' => 'logo', 'class' => 'profile-img', 'height' => '60px']);
                } else {
                    echo Html::img('images/members1.png', ['alt' => 'logo', 'class' => 'profile-img', 'height' => '60px']);
                }

                ?>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="bs-content-row-navbar-collapse-5" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right"
                    style=" font-weight: bold; font-family: Segoe UI, Helvetica, Arial, sans-serif">
                    <li class="active"><?= Html::a(Yii::t('yii', 'HOME'), ['site/home'], ['style' => 'color:white']) ?></li>

                    <li class="active"><a href="<?= Url::toRoute(['site/about']) ?>"
                                          style="color: white"> <?= Yii::t('yii', 'ABOUT ZSSF') ?></a></li>

                    <li class="active"><a href="<?= Url::toRoute(['site/contact']) ?>"
                                          style="color: white"> <?= Yii::t('yii', 'CONTACT US') ?></a></li>


                    <?php if (Yii::$app->user->isGuest) { ?>
                        <li class="active"><a href="<?= Url::toRoute(['site/signup']) ?>"
                                              style="color: white"> <?= Yii::t('yii', 'SIGN UP') ?></a></li>
                    <?php } ?>
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <li class="active"><a href="<?= Url::toRoute(['site/login']) ?>"
                                              style="color: white"> <?= Yii::t('yii', 'SIGN IN') ?></a></li>
                    <?php } ?>
                    <!-- <li class="disabled"><a href="#">Link</a></li> -->
                    <?php if (Yii::$app->user->isGuest == false) { ?>
                        <li class="active"><?= Html::a("( " . Yii::$app->user->identity->username . " ) ", ['user/profile'], ['data-method' => 'post', 'style' => 'padding-right:10px;color:white']) ?></li>
                        <li class="active"><?= Html::a("" . Yii::t('yii', 'LOGOUT ') . "<i class=\"fa fa-sign-out\"></i> ", ['site/logout'], ['data-method' => 'post', 'style' => 'padding-right:10px;color:white']) ?></li>
                    <?php } ?>
                    <li>
                        <?php
                        if (Yii::$app->language == 'ru') {


                            echo Html::a(Html::img('flags/en.png', ['alt' => 'flag', 'class' => 'flag',]), Url::current(['language' => 'en']), ['class' => (Yii::$app->request->cookies['language'] == 'en' ? 'active' : '')]);
                        } elseif (Yii::$app->language == 'en') {

                            echo Html::a(Html::img('flags/tz.png', ['alt' => 'flag', 'class' => 'flag',]), Url::current(['language' => 'ru']), ['class' => (Yii::$app->request->cookies['language'] == 'ru' ? 'active' : '')]);
                        } else {
                            echo Html::a(Html::img('flags/tz.png', ['alt' => 'flag', 'class' => 'flag',]), Url::current(['language' => 'ru']), ['class' => (Yii::$app->request->cookies['language'] == 'ru' ? 'active' : '')]);
                        }
                        ?>
                    </li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="container-fluid">
        <!--documents-->
        <div class="row row-offcanvas row-offcanvas-left">
            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
                <ul class="list-group panel" style="font-size: 16px">
                    <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>MENU</b></li>

                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <li style="list-style-type:none;">
                            <a href="<?= Url::toRoute(['user/profile']) ?>"
                               class="list-group-item glyphicon glyphicon-user"> <?= Yii::t('yii', 'My Profile') ?>
                                <span></span></a>
                        </li>

                        <li style="list-style-type:none;">
                            <a href="#demo1" class="list-group-item glyphicon glyphicon-book"
                               data-toggle="collapse"> <?= Yii::t('yii', 'Statements') ?> <span
                                        class="glyphicon glyphicon-chevron-right"></span></a>
                        <li class="collapse" id="demo1">
                            <a href="<?= Url::toRoute(['contributions/view']) ?>"
                               class="list-group-item"><?= Yii::t('yii', 'Member Statements') ?></a>
                            <a href="<?= Url::toRoute(['contribution-trend/index']) ?>"
                               class="list-group-item"><?= Yii::t('yii', 'Contribution Statements') ?></a>

                        </li>
                        <li style="list-style-type:none">
                            <a href="#demo2" class="list-group-item glyphicon glyphicon-education"
                               data-toggle="collapse"> <?= Yii::t('yii', 'Benefits') ?> <span
                                        class="glyphicon glyphicon-chevron-right"></span></a>
                        <li class="collapse" id="demo2">
                            <a href="<?= Url::toRoute(['buffer-results/index']) ?>"
                               class="list-group-item"> <?= Yii::t('yii', 'Test Benefits') ?></a>
                            <?php
                            $user = Members::find()->where(['uid' => Yii::$app->user->identity->getId()])->one();
                            $gender = $user['gender'];
                            if ($gender == 'Female') {
                                ?>
                                <a href="<?= Url::toRoute(['common-zssf-settings/maternity']) ?>"
                                   class="list-group-item"> <?= Yii::t('yii', 'Maternity Benefits') ?></a>
                            <?php } ?>
                            <a href="<?= Url::toRoute(['buffer-results/projection']) ?>"
                               class="list-group-item"> <?= Yii::t('yii', 'Projection') ?></a>
                            <a href="<?= Url::toRoute(['benefit-type/benefit']) ?>"
                               class="list-group-item"> <?= Yii::t('yii', 'Benefits Types') ?></a>
                        </li>
                        <li style="list-style-type:none">
                            <a href="#demo3" class="list-group-item glyphicon glyphicon-stats"
                               data-toggle="collapse"><?= Yii::t('yii', ' Status Information') ?> <span
                                        class="glyphicon glyphicon-chevron-right"></span></a>
                        <li class="collapse" id="demo3">
                            <a href="<?= Url::toRoute(['applications-statuses/index']) ?>"
                               class="list-group-item"><?= Yii::t('yii', 'Application Information') ?> </a>
                            <a href="<?= Url::toRoute(['members/card']) ?>"
                               class="list-group-item"><?= Yii::t('yii', 'ID Card Status') ?></a>

                        </li>

                    <?php } ?>

                    <li style="list-style-type:none">
                        <a href="#demo4" class="list-group-item glyphicon glyphicon-calendar"
                           data-toggle="collapse"> <?= Yii::t('yii', 'Calculator') ?> <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>
                    <li class="collapse" id="demo4">
                        <a href="<?= Url::toRoute(['calculator/contribution-calculator']); ?>"
                           class="list-group-item"><?= Yii::t('yii', 'Contribution Calculator') ?></a>
                        <a href="<?= Url::toRoute(['calculator/benefit-calculator']); ?>"
                           class="list-group-item"><?= Yii::t('yii', 'Benefits Calculator') ?></a>

                    </li>

                    <li style="list-style-type:none">
                        <a href="#demo7" class="list-group-item glyphicon glyphicon-envelope"
                           data-toggle="collapse"> <?= Yii::t('yii', 'SMS & Email') ?><span
                                    class="glyphicon glyphicon-chevron-right"></span></a>
                    <li class="collapse" id="demo7">
                        <a href="<?=  Url::toRoute(['statement/mail']); ?>"
                           class="list-group-item"><?= Yii::t('yii', 'Mail Statement') ?></a>
                        <a href="<?= Url::toRoute(['statement/sms']); ?>"
                           class="list-group-item"><?= Yii::t('yii', 'SMS Statement') ?></a>

                    </li>
                    <li style="list-style-type:none">
                        <a href="<?= Url::toRoute(['complaints/complaints']) ?>"
                           class="list-group-item glyphicon glyphicon-question-sign"> <?= Yii::t('yii', 'Complaints') ?>
                            <span></span></a>
                    </li>


                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <li style="list-style-type:none">
                            <a href="#demo6" class="list-group-item glyphicon glyphicon-cog"
                               data-toggle="collapse"> <?= Yii::t('yii', 'Setting') ?> <span
                                        class="glyphicon glyphicon-chevron-right"></span></a>
                        <li class="collapse" id="demo6">
                            <a href="<?= Url::toRoute(['notifications-subscription/notify']) ?>"
                               class="list-group-item"> <?= Yii::t('yii', 'Subscription') ?> </a

                        </li>

                        <li style="list-style-type:none">
                            <a href="<?= Url::toRoute(['complaints/list']) ?>"
                               class="list-group-item glyphicon glyphicon-list"> <?= Yii::t('yii', 'Complaints List') ?>
                                <span></span></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-9 content">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a href="javascript:void(0);" class="toggle-sidebar">
                            <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel">

                            </span>
                            </a>
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]) ?>

                        </h3>
                    </div>
                    <div class="panel-body" style="padding-bottom: 80px">

                        <?php echo $content; ?>
                    </div><!-- panel body -->
                </div>
            </div><!-- content -->
        </div>
    </div>
    <div class="site-footer" style="background-color: #033B6A">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-6">
                    <ul>
                        <li>
                            <a style="color: white"><i class="icon"
                                                       data-icon=""></i><?= Yii::t('yii', 'Social media') ?></a>&nbsp;&nbsp;&nbsp;
                            <a title="Twitter" href="<?= $twitter ?>" target="_blank" rel="external nofollow"><i
                                        class="fa fa-twitter" style="font-size: 2em;"></i></a>
                            <a title="Facebook" href="<?= $facebook ?>" target="_blank" rel="external nofollow"><i
                                        class="fa fa-facebook" style="font-size: 2em;"></i></a>
                            <a title="Instagram" href="<?= $insta ?>" target="_blank"
                               rel="external nofollow"><i class="fa fa-instagram" style="font-size: 2em;"></i></a>
                            <a title="Youtube" href="<?= $youtube ?>" target="_blank"
                               rel="external nofollow"><i class="fa fa-youtube" style="font-size: 2em;"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row" style="color: white">
                <div class="col-md-12">
                    <p class="pull-left">Copyright
                        &copy; <?= Yii::t('yii', 'ZSSF Member Portal ') ?>
                        <?= date('Y') ?>

                        <?= Yii::t('yii', '. All Rights Reserved') ?></p>

                    <p class="pull-right"><?php Yii::powered() ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (Yii::$app->session->getFlash('')) {
        echo \kartik\growl\Growl::widget([
            'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Notification!',
            'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
            'body' => (!empty($message['message'])) ? Html::encode($message['message']) : Yii::t('yii', 'Please sign up first and continue!'),
            'showSeparator' => true,
            'delay' => 1, //This delay is how long before the message shows
            'pluginOptions' => [
                'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
                'placement' => [
                    'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                    'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                ]
            ]
        ]);
    } elseif (Yii::$app->session->getFlash('complaints_success')) {
        echo \kartik\growl\Growl::widget([
            'type' => (!empty($message['type'])) ? $message['type'] : 'success',
            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Notification!',
            'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
            'body' => (!empty($message['message'])) ? Html::encode($message['message']) : Yii::t('yii', Yii::t('yii', 'You have sent complaints successfully')),
            'showSeparator' => true,
            'delay' => 1, //This delay is how long before the message shows
            'pluginOptions' => [
                'delay' => (!empty($message['duration'])) ? $message['duration'] : 5000, //This delay is how long the message shows for
                'placement' => [
                    'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                    'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                ]
            ]
        ]);
    } elseif (Yii::$app->session->getFlash('subscription_success')) {
        echo \kartik\growl\Growl::widget([
            'type' => (!empty($message['type'])) ? $message['type'] : 'success',
            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Notification!',
            'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
            'body' => (!empty($message['message'])) ? Html::encode($message['message']) : Yii::t('yii', Yii::t('yii', 'Successfully')),
            'showSeparator' => true,
            'delay' => 1, //This delay is how long before the message shows
            'pluginOptions' => [
                'delay' => (!empty($message['duration'])) ? $message['duration'] : 5000, //This delay is how long the message shows for
                'placement' => [
                    'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                    'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                ]
            ]
        ]);
    } elseif (Yii::$app->user->isGuest && Yii::$app->controller->action->id === 'home') {
        echo \kartik\growl\Growl::widget([
            'type' => (!empty($message['type'])) ? $message['type'] : 'success',
            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : Yii::t('yii', 'Are you a new member ?'),
            'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-user',
            'body' => (!empty($message['message'])) ? Html::encode($message['message']) : Html::a("" . Yii::t('yii', 'Click here to Register member Account  ') . "<i class=\"fa fa-sign-in\"></i> ", ['site/signup'], ['data-method' => 'post', 'style' => 'padding-right:10px;']),
            'showSeparator' => true,
            'delay' => 1, //This delay is how long before the message shows
            'pluginOptions' => [
                'delay' => (!empty($message['duration'])) ? $message['duration'] : 9000, //This delay is how long the message shows for
                'placement' => [
                    'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                    'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'center',
                ]
            ]
        ]);
    }
    ?>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>

<style>
    .site-footer {
        text-align: center;
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        font-size: 1em;
        height: 90px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
