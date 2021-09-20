<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class Select2Asset extends AssetBundle
{
    public $basePath = '@webroot/js/select2';
    public $baseUrl = '@web/js/select2';
   
    public $js = [
        'select2.min.js',
        'select2-component.js'
    ];

    public $css = [
        'select2.min.css'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}