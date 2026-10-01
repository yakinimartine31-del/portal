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
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log',
        'userCounter',
        [
            'class' => 'common\components\LanguageSelector',
            'supportedLanguages' => ['en', 'sw','ru'],
        ]
    ],
    'modules' => [
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],
        'roundSwitch' => [
            'class' => 'nickdenry\grid\toggle\Module',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ]
    ],

    'components' => [
        'request' => [
            'baseUrl' => '/staff',
            'csrfParam' => '_csrf-backend',
            'trustedHosts' => $trustedHosts,
        ],
        'assetManager' => [
            'baseUrl' => '/staff/assets',
            'basePath' => dirname(__DIR__, 2) . '/staff/assets',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'userCounter' => [
            'class' => 'frontend\components\UserCounter',

            // You can setup these options:
            'tableUsers' => 'pcounter_users',
            'tableSave' => 'pcounter_save',
            'autoInstallTables' => true,
            'onlineTime' => 5, // min
        ],
//        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
//        ],
//        'session' => [
//            // this is the name of the session cookie used for login on the backend
//            'name' => 'advanced-backend',
//        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => true,
            'authTimeout' => 1200, //20 minutes
            'identityCookie' => [
                'name' => '_identity-backend',
                'httpOnly' => true,
                'secure' => !YII_DEBUG,
                'sameSite' => \yii\web\Cookie::SAME_SITE_LAX,
                'domain' => $cookieDomain,
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'class' => 'yii\web\Session',
            'name' => 'advanced-backend',
            'timeout' => 1200,
            'cookieParams' => [
                'lifetime' => 0,
                'path' => '/',
                'domain' => $cookieDomain,
                'secure' => !YII_DEBUG,
                'httponly' => true,
                'sameSite' => \yii\web\Cookie::SAME_SITE_LAX,
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

//        'view' => [
//            'theme' => [
//                'pathMap' => [
//                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
//                ],
//            ],
//        ],
    ],
    'params' => $params,
];
