<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class VueAsset extends AssetBundle
{
    public $basePath = '@webroot/js/vue';
    public $baseUrl = '@web/js/vue';
   
    public $js = [
        'vue.js',
        'axios.min.js',
        'qs.min.js'
    ];

    public $jsOptions = [
        'position' => View::POS_END,
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
}