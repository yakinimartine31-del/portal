<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$cookieDomain = getenv('COOKIE_DOMAIN') ?: null; // e.g. '.zssf.or.tz' (keep null for host-only cookies)
$trustedProxyCidrs = array_values(array_filter(array_map('trim', explode(',', getenv('TRUSTED_PROXY_CIDRS') ?: ''))));
$trustedHosts = [];
foreach ($trustedProxyCidrs as $cidr) {
    $trustedHosts[$cidr] = [
        'X-Forwarded-For',
        'X-Forwarded-Proto',
        'X-Forwarded-Host',
        'X-Forwarded-Port',
    ];
}

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '',
        ],
        'userCounter' => [
            'class' => 'frontend\components\UserCounter',

            // You can setup these options:
            'tableUsers' => 'pcounter_users',
            'tableSave' => 'pcounter_save',
            'autoInstallTables' => true,
            'onlineTime' => 3, // min
        ],
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
            'trustedHosts' => $trustedHosts,
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 9800,
            'identityCookie' => [
                'name' => '_identity-frontend',
                'httpOnly' => true,
                'secure' => !YII_DEBUG,
                'sameSite' => \yii\web\Cookie::SAME_SITE_LAX,
                'domain' => $cookieDomain,
            ],
        ],
        'session' => [
            'name' => 'advanced-frontend',
            'cookieParams' => [
                'lifetime' => 0,
                'path' => '/',
                'domain' => '',
                'secure' => false,
                'httponly' => true,
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'basePath' => '@frontend/web/assets',
            'baseUrl' => '@web/assets',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'modules' => [
        'dynagrid' => [
            'class' => '\kartik\dynagrid\Module',
            // other module settings
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
        'debug' => [
            'class' => 'yii\debug\Module',
            'panels' => [
                'user' => false,
            ],
        ],
    ],
    'timeZone'=>"Africa/Dar_es_Salaam",
    'params' => $params,
];
