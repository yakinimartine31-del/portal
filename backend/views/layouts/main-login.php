<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="bimg login-page">

<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">Copyright
            &copy; <?= Yii::t('yii', 'ZSSF Member Portal ') ?>
            <?= date('Y') ?>

            <?= Yii::t('yii', '. All Rights Reserved') ?></p>

        <p class="pull-right"><?php Yii::powered() ?></p>
    </div>
</footer>
<style>
.footer{

    position: absolute;
    bottom: 0;
    width: 100%;
    height: 30px;

}
    .bimg {

        background: url("/images/admin5.png") no-repeat;
        margin: 0px;
        opacity:0.9;
        filter: alpha(opacity=40);
        position: absolute;
        z-index: -1;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-size: cover;

    }

</style>