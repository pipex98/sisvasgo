<?php

namespace app\assets;

use yii\web\AssetBundle;

class DepositAsset extends AssetBundle
{
    public $basePath = '@webroot/js/deposit';
    public $baseUrl = '@web/js/deposit';
   
    public $js = [
        'deposit-mod.js'
    ];
    public $depends = [
        'app\assets\AppAsset',
        'app\assets\VueAsset',
        'app\assets\VuelidateAsset',
        'app\assets\Select2Asset',
        'app\assets\SweetAlertAsset',
        'app\assets\VueTablesAsset'
    ];
}
