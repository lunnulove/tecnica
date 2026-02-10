<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',

    'components' => [

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],

        'log' => [
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'categories' => ['audit'],
                    'logFile' => '@runtime/logs/audit.log',
                    'levels' => ['info'],
                ],
            ],
        ],

    ],
];
