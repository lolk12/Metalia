<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Nenad Zivkovic <nenad@freetuts.org>
 * 
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'SBAdmin/vendor/bootstrap/css/bootstrap.min.css',
        'SBAdmin/dist/css/sb-admin-2.css',
        'site/fonts/icons/font-awesome/css/font-awesome.min.css',
        'site/css/lib/slidebars.css',
        'site/css/public/style.css',


    ];
    public $js = [
        'SBAdmin/vendor/jquery/jquery.js',
        'SBAdmin/vendor/bootstrap/js/bootstrap.min.js',
        'SBAdmin/vendor/metisMenu/metisMenu.min.js',
        'SBAdmin/vendor/raphael/raphael.min.js',
        'SBAdmin/dist/js/sb-admin-2.js',
        'site/js/lib/slidebars.js',
        'site/js/public/main.js',
        //'frontendAlex/js/lib/page-scroll-to-id/jquery.malihu.PageScroll2id.min.js',
        'site/js/public/scroll.js',

    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
