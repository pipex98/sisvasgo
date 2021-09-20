<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class VueHtmlToPaperAsset extends AssetBundle
{
    public $basePath = '@webroot/js/vue-html-to-paper';
    public $baseUrl = '@web/js/vue-html-to-paper';
   
    public $js = [
        'vue-html-to-paper.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}