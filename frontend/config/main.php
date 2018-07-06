<?php

$params = array_merge(
	require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
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
	'myaccounts' => [
	    'class' => 'frontend\modules\myaccounts\Module',
	],
	'social' => [
	    // the module class
	    'class' => 'kartik\social\Module',
	    // the global settings for the facebook widget
	    'facebook' => [
		'appId' => '423762694639244',
	    ],
	],
	'create_your_own' => [
	    'class' => 'frontend\modules\create_your_own\Module',
	],
    ],
    'components' => [
	'request' => [
	    'csrfParam' => '_csrf-frontend',
	],
	'user' => [
	    'identityClass' => 'common\models\User',
	    'enableAutoLogin' => true,
	    'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
	],
	'session' => [
	    // this is the name of the session cookie used for login on the frontend
	    'name' => 'advanced-frontend',
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
	    require(__DIR__ . '/url_rules.php'),
	],
	'assetManager' => [
	    'bundles' => [
		'dosamigos\google\maps\MapAsset' => [
		    'options' => [
			'key' => 'AIzaSyAn8gxT-1o2u1ouEKd1O-o9idyl62NS_Y0',
			'language' => 'id',
			'version' => '3.1.18'
		    ]
		],
                'yii\web\JqueryAsset' => [
                    'js' => []
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
	    ]
	],
    ],
    'params' => $params,
];
