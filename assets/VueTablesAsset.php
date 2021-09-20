<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class VueTablesAsset extends AssetBundle
{
    public $basePath = '@webroot/js/vue-tables';
    public $baseUrl = '@web/js/vue-tables';
   
    public $js = [
        'vue-tables-2.min.js'
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
}