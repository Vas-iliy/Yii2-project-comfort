<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.min.css',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap',
    ];
    public $js = [
        'https://unpkg.com/swiper/swiper-bundle.min.js',
        'js/jquery.mask.js',
        'js/index.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
