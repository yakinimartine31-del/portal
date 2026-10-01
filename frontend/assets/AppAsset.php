<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//netdna.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css',
        'css/site.css',
    ];
    public $js = [
        '//netdna.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js',
        'js/site.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
