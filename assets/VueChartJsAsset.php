<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class VueChartJsAsset extends AssetBundle
{
    public $basePath = '@webroot/js/vue-chartjs';
    public $baseUrl = '@web/js/vue-chartjs';
   
    public $js = [
        'Chart.min.js',
        'vue-chartjs.min.js',
        'chart-component.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}