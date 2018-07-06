<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'SetValues' => [
            'class' => 'common\components\SetValues',
        ],
        'UploadFile' => [
            'class' => 'common\components\UploadFile',
        ],
	'EncryptDecrypt' => [
	    'class' => 'common\components\EncryptDecrypt'
	],
        'thumbnail' => [
            'class' => 'sadovojav\image\Thumbnail',
        ],
        'errorHandler' => [
            'maxSourceLines' => 20,
            'errorAction' => 'site/error',
        ],
        'NumToWord' => [
            'class' => 'common\components\NumToWord'
        ],
    ],
];
