<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name'=>'Fenomenom',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'app\components\Bootstrap',
    ],
    'as access' =>[
        'class' => '\hscstudio\mimin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'debug/*',
            'mimin/*',
        ],
    ],
    'modules'=>[
        'mimin'=> [
            'class' => '\hscstudio\mimin\Module',
        ],
        'gridview'=>[
            'class' =>'\kartik\grid\Module',
            'downloadAction' => 'gridview/export/download',
        ]
    ],
    'components' => [
            'authManager'=> [
                'class'=>'yii\rbac\DbManager'
            ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'simeulue',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
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
//		'view' => [
//         'theme' => [
//             'pathMap' => [
//                '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
//					],
//			],
//		],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
//                    'skin' => 'skin-green sidebar-mini',
//                    'sidebar'=>'sidebar-mini',
//                    skin-blue,
//                    skin-black,
//                    skin-red,
//                    skin-yellow,
//                    skin-purple,
//                    skin-green,
//                    skin-blue-light,
//                    skin-black-light,
//                    kin-red-light,
//                    skin-yellow-light,
//                    skin-purple-light,
//                    skin-green-light
                ],

            ],
        ],
        'db' => require(__DIR__ . '/db.php'),

//        'urlManager' => [
//            'rules' => [
//
//                ['class' => 'common\helpers\UrlRule', 'connectionID' => 'db', ],
//            ],
//        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
//            'rules' => [
//                ['class' => 'app\components\UrlRule', 'connectionID' => 'db', ],
//            ],

        ],

    ],
    'params' => [
        'uploadPath'=> Yii::$app
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
