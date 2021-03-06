<?php
// Define o TimeZone para o do Brasil.
date_default_timezone_set("Brazil/East");

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'prod');

require(__DIR__ . '/application/vendor/autoload.php');
require(__DIR__ . '/application/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/application/common/config/bootstrap.php');
require(__DIR__ . '/application/frontend/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/application/common/config/main.php'),
    require(__DIR__ . '/application/common/config/main-local.php'),
    require(__DIR__ . '/application/frontend/config/main.php'),
    require(__DIR__ . '/application/frontend/config/main-local.php')
);

$application = new yii\web\Application($config);
$application->run();
