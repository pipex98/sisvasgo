<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class MomentAsset extends AssetBundle
{
    public $basePath = '@webroot/js/moment';
    public $baseUrl = '@web/js/moment';
   
    public $js = [
        'moment.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}