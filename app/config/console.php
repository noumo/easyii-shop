<?php
$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$basePath =  dirname(__DIR__);
$webroot = dirname($basePath);

return [
    'id' => 'app-console',
    'basePath' => $basePath,
    'runtimePath' => $webroot . '/runtime',
    'vendorPath' => $webroot . '/vendor',
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];