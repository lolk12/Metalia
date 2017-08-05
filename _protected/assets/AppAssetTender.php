<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 10.07.2017
 * Time: 2:42
 */

namespace app\assets;

use yii\web\AssetBundle;
use Yii;

class AppAssetTender extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'SBAdmin/dist/css/stileTender.css',
    ];
    public $js = [
        'SBAdmin/dist/js/tender.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}