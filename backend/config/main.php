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
                'project/create' => 'project/create',
                'GET project/<id:\d+>' => 'project/update',
                'PUT project/<id:\d+>' => 'project/update',
                'DELETE project/<id:\d+>' => 'project/delete',
                'DELETE project/delete-image/<id:\d+>' => 'project/delete-image',

                'GET contact' => 'contact/index',
                'contact/create' => 'contact/create',
                'GET contact/<id:\d+>' => 'contact/update',
                'PUT contact/<id:\d+>' => 'contact/update',
                'DELETE contact/<id:\d+>' => 'contact/delete',

                'GET advantage' => 'advantage/index',
                'advantage/create' => 'advantage/create',
                'GET advantage/<id:\d+>' => 'advantage/update',
                'PUT advantage/<id:\d+>' => 'advantage/update',
                'DELETE advantage/<id:\d+>' => 'advantage/delete',
                'GET work' => 'work/index',
                'GET work/<id:\d+>' => 'work/update',
                'PUT work/<id:\d+>' => 'work/update',
                'DELETE work/delete-image/<id:\d+>' => 'work/delete-image',
                'GET service' => 'service/index',
                'service/create' => 'service/create',
                'GET service/<id:\d+>' => 'service/update',
                'PUT service/<id:\d+>' => 'service/update',
                'DELETE service/<id:\d+>' => 'service/delete',
                'DELETE service/delete-image/<id:\d+>' => 'service/delete-image',
                'GET service-point' => 'service-point/index',
                'service-point/create' => 'service-point/create',
                'GET service-point/<id:\d+>' => 'service-point/update',
                'PUT service-point/<id:\d+>' => 'service-point/update',
                'DELETE service-point/<id:\d+>' => 'service-point/delete',

                'GET about' => 'about/index',
                'about/create' => 'about/create',
                'GET about/<id:\d+>' => 'about/update',
                'PUT about/<id:\d+>' => 'about/update',
                'DELETE about/<id:\d+>' => 'about/delete',

                'GET question' => 'question/index',
                'question/create' => 'question/create',
                'GET question/<id:\d+>' => 'question/update',
                'PUT question/<id:\d+>' => 'question/update',
                'DELETE question/<id:\d+>' => 'question/delete',
                'GET state-category' => 'state-category/index',
                'state-category/create' => 'state-category/create',
                'GET state-category/<id:\d+>' => 'state-category/update',
                'PUT state-category/<id:\d+>' => 'state-category/update',
                'DELETE state-category/<id:\d+>' => 'state-category/delete',
                'GET state' => 'state/index',
                'state/create' => 'state/create',
                'GET state/<id:\d+>' => 'state/update',
                'PUT state/<id:\d+>' => 'state/update',
                'DELETE state/<id:\d+>' => 'state/delete',

                'GET filter' => 'filter/index',
                'filter/create' => 'filter/create',
                'GET filter/<id:\d+>' => 'filter/update',
                'PUT filter/<id:\d+>' => 'filter/update',
                'DELETE filter/<id:\d+>' => 'filter/delete',

                'GET material' => 'material/index',
                'material/create' => 'material/create',
                'GET material/<id:\d+>' => 'material/update',
                'PUT material/<id:\d+>' => 'material/update',
                'DELETE material/<id:\d+>' => 'material/delete',

                'GET client' => 'client/index',
                'GET client/new' => 'client/client',
                'client/create' => 'client/create',
                'GET client/<id:\d+>' => 'client/update',
                'PUT client/<id:\d+>' => 'client/update',
                'DELETE client/<id:\d+>' => 'client/delete',
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