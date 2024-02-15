<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CanvasCartAsset extends AssetBundle
{
    public $basePath = '@webroot/canvas';
    public $baseUrl = '@web/canvas';
    public $css = [
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital@0;1&display=swap',
        'style.css',
        'css/font-icons.css',
        'css/custom.css'
    ];
    public $js = [
        'js/plugins.min.js',
        'js/functions.bundle.js',
        'js/app.js'
    ];
    public $depends = [
    ];
}
