<?php
$params = require(__DIR__ . '/params.php');
$components = require(__DIR__ . '/components.php');
$modules = require(__DIR__ . '/modules.php');

$config = [
    'id' => 'basic',
    'name' => 'Sistema de Prestamos',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'es',
    'sourceLanguage' => 'en',
    'charset' => 'UTF-8',
    'timeZone' => 'America/Manaus',
    'name'  => 'SGP-UEA',
    'modules' => $modules,
    'components' => $components,
    'params' => $params,
    'as access' => [
                'class' => 'mdm\admin\components\AccessControl',
                        'allowActions' => [
                                        //'devolucion/*'
                                        // 'rbac/*',
                                        // 'site/*',
                                        // 'admin/*',
                                        // 'gii/*',
                                        // '*/*',
                                        // 'debug/*',
                                        // 'piso/*',
                                        // 'articulo/*',
                                        // 'foto/*',
                                        // 'persona/*',
                                        // 'computadora/*',
                                        // 'prestamo/*',
                        ],
    ]
];

if (YII_ENV_DEV) {
//     // configuration adjustments for 'dev' environment
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


if (!YII_ENV_DEV) {    
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
    $config['components']['assetManager']/*['forceCopy'] = true*/;
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',      
        'allowedIPs' => ['127.0.0.1', '::1'],  
        'generators' => [ //here
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'adminlte' => '@vendor/dmstr/yii2-adminlte-asset/gii/templates/crud/simple',
                ]
            ]
        ],
    ];
}
return $config;
