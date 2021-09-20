<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class SweetAlertAsset extends AssetBundle
{
    public $basePath = '@webroot/js/sweetalert';
    public $baseUrl = '@web/js/sweetalert';
   
    public $js = [
        'sweetalert.min.js'
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
}