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
if (Yii::$app->controller->action->id === 'login') {

    echo $this->render(
        'main-login',
        ['content' => $content]
    );

} else {


    echo $this->render('header.php');
    echo $this->render('left.php');
    echo $content;
    echo $this->render('footer.php');
}
?>

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
