<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    // set target language to be Spanish
    'language' => 'es-ES',    
    // set source language to be English
    'sourceLanguage' => 'en-US',
    'name' => $params['app']['name'],
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableRegistration' => false,
            'enableConfirmation' => false,
            'enablePasswordRecovery' => true,
            'modelMap' => [
                'User' => 'app\models\User',
            ],
            'admins' => ['admin']
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
        'admin' => [
            'class' => 'mdm\admin\Module',
        ],
        'gridview' => [
            'class' => 'kartik\grid\Module',
            // other module settings
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '2W9uBUL7DF_riI7SamPv4Y9xeBbwlJ3k',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // 'user' => [
        //     'identityClass' => 'app\models\User',
        //     'enableAutoLogin' => true,
        // ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages'
                ],
            ],
        ],
        'db' => $db,
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
        ],
        'assetManager' => [
            /**
             * This enables cache busting
             * So when css or js assets files are modified this forces 
             * browsers to reload those files appending v=<timestamp>
             */
            'appendTimestamp' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/error', // Always allow this action
            'user/security/login', // Any user can login
            'user/security/logout', // Any user can logout
            'user/recovery/request', # Enables /user/forgot path for request password recovery
            'user/recovery/reset',
            'site/about', // Disable in production
            'debug/*',
            'gii/*'
        ]
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
