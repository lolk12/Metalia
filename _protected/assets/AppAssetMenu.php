<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 19.07.2017
 * Time: 15:58
 */

namespace app\assets;

use yii\web\AssetBundle;
use Yii;

class AppAssetMenu extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'menu/css/menu.css'
    ];
    public $js = [
        'menu/js/menu.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

}