<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class VuelidateAsset extends AssetBundle
{
    public $basePath = '@webroot/js/vuelidate';
    public $baseUrl = '@web/js/vuelidate';
   
    public $js = [
        'vuelidate.min.js',
        'validators.min.js'
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
}