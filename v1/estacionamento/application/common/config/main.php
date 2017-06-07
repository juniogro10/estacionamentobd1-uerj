<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    //'bootstrap' => ['monetdb'],
    'language' => 'pt_BR',
    'timeZone' => 'America/Sao_Paulo',
    'components' => [

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                ['class' => 'common\components\PageUrlRule'],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'info','warning'],
                    'categories' => ['pagSeguroTransacaoPagamento'],
                    'logFile' => '@app/runtime/logs/pagSeguroTransacaoPagamento.log',
                    'maxFileSize' => 1024 * 2,
                    'maxLogFiles' => 50,
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'info','warning'],
                    'categories' => ['pagSeguroAssinatura'],
                    'logFile' => '@app/runtime/logs/pagSeguroAssinatura.log',
                    'maxFileSize' => 1024 * 2,
                    'maxLogFiles' => 50,
                ],
            ],
        ],
    ],
];
