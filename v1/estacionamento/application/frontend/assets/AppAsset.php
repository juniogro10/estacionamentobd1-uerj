<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/sites.css',
        'css/default.css',
        'css/font.css',
        'css/login.css',
        'css/planos.css',
        'css/sobre.css',
        'css/contato.css',
        'css/signup.css',

    ];
    public $js = [
//        'js/jquery-2.1.4.min.js',
        'js/jquery.app.js',
        'js/jquery.easing.1.3.min.js',
        'js/jquery.sticky.js',

       // 'js/ButtonComponentMorph/uiMorphingButton_inflow.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
