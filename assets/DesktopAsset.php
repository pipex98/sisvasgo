<?php

namespace app\assets;

use yii\web\AssetBundle;

class DesktopAsset extends AssetBundle
{
    public $basePath = '@webroot/js/desktop';
    public $baseUrl = '@web/js/desktop';
   
    public $js = [
        'desktop-mod.js'
    ];
    public $depends = [
        'app\assets\AppAsset',
        'app\assets\VueAsset',
        'app\assets\VueChartJsAsset'
    ];
}
