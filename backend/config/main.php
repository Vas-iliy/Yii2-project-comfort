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
    'aliases' => [
        '@staticRoot' => $params['staticPath'],
        '@static' => $params['staticHostInfo'],
    ],
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => [
        'log',
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'formatters' => [
                'json' => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    /*'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,*/
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'core\entities\user\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => 'login'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'signup' => 'auth/auth/signup',
                'login' => 'auth/auth/login',
                'GET project' => 'project/index',
            ],
        ],

    ],
    /*'as authenticator' => [
        'class' => '\yii\filters\auth\CompositeAuth',
        'except' => ['auth/auth/signup', 'auth/auth/login'],
        'authMethods' => [
            ['class' => 'yii\filters\auth\HttpBearerAuth'],
        ]
    ],
    'as access' => [
        'class' => 'yii\filters\AccessControl',
        'except' => ['auth/auth/signup', 'auth/auth/login'],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],*/
    'params' => $params,
];