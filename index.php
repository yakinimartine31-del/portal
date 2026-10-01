<?php

use yii\helpers\ArrayHelper;
use yii\web\Application;


defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'dev');

// Frontend application
require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
require(__DIR__ . '/common/config/bootstrap.php');

if ($uri === '/staff' || strpos($uri, '/staff/') === 0) {
    // Backend application
    require(__DIR__ . '/backend/config/bootstrap.php');
    $config = yii\helpers\ArrayHelper::merge(
        require(__DIR__ . '/common/config/main.php'),
        require(__DIR__ . '/common/config/main-local.php'),
        require(__DIR__ . '/backend/config/main.php'),
        require(__DIR__ . '/backend/config/main-local.php')
    );
} else {
    // Frontend application
    require(__DIR__ . '/frontend/config/bootstrap.php');
    $config = yii\helpers\ArrayHelper::merge(
        require(__DIR__ . '/common/config/main.php'),
        require(__DIR__ . '/common/config/main-local.php'),
        require(__DIR__ . '/frontend/config/main.php'),
        require(__DIR__ . '/frontend/config/main-local.php')
    );
}

(new yii\web\Application($config))->run();
