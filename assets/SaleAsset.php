<?php

namespace app\assets;

use yii\web\AssetBundle;

class SaleAsset extends AssetBundle
{
    public $basePath = '@webroot/js/sale';
    public $baseUrl = '@web/js/sale';
   
    public $js = [
        'sale-mod.js'
    ];
    public $depends = [
        'app\assets\AppAsset',
        'app\assets\VueAsset',
        'app\assets\VuelidateAsset',
        'app\assets\VueHtmlToPaperAsset',
        'app\assets\Select2Asset',
        'app\assets\SweetAlertAsset',
        'app\assets\VueTablesAsset'
    ];
}
