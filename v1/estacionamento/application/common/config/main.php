<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    //'bootstrap' => ['monetdb'],
    'language' => 'pt_BR',
    'timeZone' => 'America/Sao_Paulo',
    'components' => [
        'session' => [
            'class' => 'yii\web\DbSession',
            // Set the following if you want to use DB component other than
            // default 'db'.
//             'db' => 'dwn',
            // To override default session table, set the following
            // 'sessionTable' => 'my_session',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                ['class' => 'common\components\PageUrlRule'],

                'app/obterdados' => 'app/default/obterdados',
                'app/dataset/<dataset_id:\d+>' => 'app/default/dataset',
                'app/<action:\w+>' => 'app/default/<action>',
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
