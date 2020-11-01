<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
            'showScriptName' => false, //отключаем r=routes
            //запретить стандартные URL если не соответствует правилам класса
            'enableStrictParsing' => true,
            'enablePrettyUrl' => true, //отключаем index.php
            'rules' => [
                '/' => 'site/index',
                'site/login' => 'site/login',
                'spreadsheet/download' => 'spreadsheet/download',
                '<controller>/index' => '<controller>/index',
                '<controller>/view/<id:\d+>' => '<controller>/view',
                '<controller>/update/<id:\d+>' => '<controller>/update',
                '<controller>/delete/<id:\d+>' => '<controller>/delete',
                '<controller>/create' => '<controller>/create',
                '<controller>/copy/<id:\d+>' => '<controller>/copy',
                '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
