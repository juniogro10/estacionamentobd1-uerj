<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=u866020361_uerj',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
//        'db' => [
//            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=mysql.hostinger.com.br;dbname=u866020361_uerj',
//            'username' => 'u866020361_uerj',
//            'password' => '2016.2',
//            'charset' => 'utf8',
//        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
        ],
        'formatter' => [
            'datetimeFormat' => 'dd/MM/yyyy HH:mm:ss',
            'dateFormat' => 'dd/MM/yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => 'R$',
        ],
        'assetManager' => [
            'bundles' => [
            ],
        ],
    ],
];
