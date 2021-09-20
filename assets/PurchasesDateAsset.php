<?php

namespace app\assets;

use yii\web\AssetBundle;

class PurchasesDateAsset extends AssetBundle
{
    public $basePath = '@webroot/js/purchases-date';
    public $baseUrl = '@web/js/purchases-date';
   
    public $js = [
        'purchases-date-mod.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
        'app\assets\VueAsset',
        'app\assets\VueTablesAsset',
        'app\assets\MomentAsset'
    ];
}
