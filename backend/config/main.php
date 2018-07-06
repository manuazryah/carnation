<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'], // adjust this to your needs
            'generators' => [//here
                'crud' => [// generator name
                    'class' => 'yii\gii\generators\crud\Generator', // generator class
                    'templates' => [//setting for out templates
                        'custom' => '@common/myTemplates/crud/custom', // template name => path to template
                    ]
                ]
            ],
        ],
        'admin' => [
            'class' => 'backend\modules\admin\Module',
        ],
        'product' => [
            'class' => 'backend\modules\product\Module',
        ],
        'user' => [
            'class' => 'backend\modules\user\Module',
        ],
        'create_your_own' => [
            'class' => 'backend\modules\create_your_own\Module',
        ],
        'cms' => [
            'class' => 'backend\modules\cms\Module',
        ],
        'contacts' => [
            'class' => 'backend\modules\contacts\Module',
        ],
        'order' => [
            'class' => 'backend\modules\order\Module',
        ],
        'notifications' => [
            'class' => 'backend\modules\notifications\Module',
        ],
        'promotions' => [
            'class' => 'backend\modules\promotions\Module',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\AdminUsers',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/index'],
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
// this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' =>
            require(__DIR__ . '/url_rules.php')
        ,
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => []],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
        ],
    ],
    'params' => $params,
];
