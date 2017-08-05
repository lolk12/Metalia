<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 04.05.2017
 * Time: 20:57
 */

namespace app\assets;

use yii\web\AssetBundle;
use Yii;

class AppAssetAdmin extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'SBAdmin/vendor/metisMenu/metisMenu.min.css',
        'SBAdmin/vendor/bootstrap/css/bootstrap.min.css',
        'SBAdmin/dist/css/sb-admin-2.css',
        'SBAdmin/dist/css/style.css',
        'SBAdmin/vendor/font-awesome/css/font-awesome.min.css',
    ];
    public $js = [
        'SBAdmin/vendor/bootstrap/js/bootstrap.min.js',
        'SBAdmin/vendor/metisMenu/metisMenu.min.js',
        'SBAdmin/vendor/raphael/raphael.min.js',
        'SBAdmin/dist/js/sb-admin-2.js',
        'SBAdmin/vendor/jquery.malihu.PageScroll2id.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}