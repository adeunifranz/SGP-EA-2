<?php 

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/login.css',
        'css/css/font-awesome.css',
        'https://fonts.googleapis.com/css?family=Quicksand',
    ];
    public $js = [
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
        // 'rmrevin\yii\fontawesome\AssetBundle',
    ];
}
