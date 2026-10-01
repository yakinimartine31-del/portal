<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/common/config/bootstrap.php';
require __DIR__ . '/backend/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/common/config/main.php',
    require __DIR__ . '/common/config/main-local.php',
    require __DIR__ . '/backend/config/main.php',
    require __DIR__ . '/backend/config/main-local.php'
);

$app = new yii\web\Application($config);

// Mock what router.php does
$_SERVER['REQUEST_URI'] = '/staff';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/backend/web/index.php';
$_SERVER['SCRIPT_NAME'] = '/backend/web/index.php';

$request = $app->getRequest();
echo "Base URL: " . $request->getBaseUrl() . "\n";
echo "Path Info: " . $request->getPathInfo() . "\n";
try {
    $route = $app->getUrlManager()->parseRequest($request);
    echo "Resolved Route: " . print_r($route, true) . "\n";
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
