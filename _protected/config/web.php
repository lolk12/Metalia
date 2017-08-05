<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'BASIC',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'app\components\Aliases'],
    'modules' => [
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
            // other module settings, refer detailed documentation
        ],
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',

            //'enableRegistration' => true,

            // Add regexp validation to passwords. Default pattern does not restrict user and can enter any set of characters.
            // The example below allows user to enter :
            // any set of characters
            // (?=\S{8,}): of at least length 8
            // (?=\S*[a-z]): containing at least one lowercase letter
            // (?=\S*[A-Z]): and at least one uppercase letter
            // (?=\S*[\d]): and at least one number
            // $: anchored to the end of the string

            //'passwordRegexp' => '^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$',


            // Here you can set your handler to change layout for any controller or action
            // Tip: you can use this event in any module
            'on beforeAction'=>function(yii\base\ActionEvent $event) {
                if ( !$event->action->uniqueId == 'user-management/auth/login' )
                {
                    $event->action->controller->layout = '@app/views/layouts/admin';
                };

            },
        ],

    ],
    'components' => [

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '0hB9B24DNG6RQrrXarSdmqH6ifJZWdXr',
        ],
        // you can set your theme here - template comes with: 'light' and 'dark'
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@webroot/themes/light/views'],
                'baseUrl' => '@web/themes/light',
            ],
        ],
        'assetManager' => [
            'bundles' => [
                // we will use bootstrap css from our theme
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [], // do not use yii default one
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<alias:\w+>' => 'site/<alias>',
                '<controller>/<action>' => '<controller>/<action>',
            ],
        ],
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',

            // Comment this if you don't want to record user logins
            'on afterLogin' => function($event) {
                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
            }
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'savePath' => '@app/runtime/session'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'robots.1gb.ru',
                'username' => 'u472523',
                'password' => '9bed36bagh',
                'port' => '25',
                //'encryption' => 'ssl', // у яндекса SSL
            ],

            'useFileTransport' => false, // будем отправлять реальные сообщения, а не в файл
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
        'i18n' => [
            'translations'=>[
                // app* - это шаблон, который определяет, какие категории
                // обрабатываются источником. В нашем случае, мы обрабатываем все, что начинается с app
                'app*'=>[
                    'class'=>yii\i18n\PhpMessageSource::className(),
                    //
                    'basePath'=>'@app/messages',
                    // исходный язык
                    'sourceLanguage'=>'ru-RU',
                    // определяет, какой файл будет подключаться для определённой категории
                    'fileMap'=>[
                        'app'=>'app.php',
                        'app/error'=>'error.php',
                    ]
                ],
            ]
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],


    
    'params' => $params,
];

Yii::setAlias('@upload', 'uploads/img');    

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = ['class' => 'yii\debug\Module'];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = ['class' => 'yii\gii\Module'];
}

return $config;
