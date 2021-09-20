<?php

namespace app\assets;

use yii\web\AssetBundle;

class SalesDateClientAsset extends AssetBundle
{
    public $basePath = '@webroot/js/sales-date-client';
    public $baseUrl = '@web/js/sales-date-client';
   
    public $js = [
        'sales-date-client-mod.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
        'app\assets\VueAsset',
        'app\assets\VueTablesAsset',
        'app\assets\MomentAsset',
        'app\assets\Select2Asset',
    ];
}
