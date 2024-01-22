<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CanvasAsset extends AssetBundle
{
    public $basePath = '@webroot/canvas';
    public $baseUrl = '@web/canvas';
    public $css = [
        'https://use.typekit.net/aay8rzy.css',
        'style.css',
        'css/font-icons.css',
        'css/swiper.css',
        'demos/shop-2/shop-2.css',
        'css/custom.css'
    ];
    public $js = [
        'js/plugins.min.js',
        'js/functions.bundle.js'
    ];
    public $depends = [
    ];
}
