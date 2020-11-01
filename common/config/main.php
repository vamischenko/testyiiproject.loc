<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManagerFrontend' => [
            'class' => \yii\web\UrlManager::class,
            'baseUrl' => '',
            'showScriptName' => false, //отключаем r=routes
            //запретить стандартные URL если не соответствует правилам класса
            'enableStrictParsing' => true,
            'hostInfo' => 'http://testyiiproject.loc/',
            'enablePrettyUrl' => true, //отключаем index.php
            'rules' => require(__DIR__ . '/../../frontend/config/routes.php')
        ],
        'i18n' => [ // компонент мультизязычности
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages', // ВАЖНО! этот путь к папке с переводами
                    'sourceLanguage' => 'en-US', // базовым языком путь будет инглиш
                    'fileMap' => [
                        'app' => 'app.php', // группа фраз и её файл-источник
                        'app/error' => 'error.php', // для ошибок (тоже какое-то подмножетсво переводимых фраз)
                    ],
                ],
            ],
        ],
    ],
];
