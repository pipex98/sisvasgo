<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class ChartComponentAsset extends AssetBundle
{
    public $basePath = '@webroot/js/chart';
    public $baseUrl = '@web/js/chart';
   
    public $js = [
        'chart-component.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}