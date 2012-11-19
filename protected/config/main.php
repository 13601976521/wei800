<?php
define('BETA_CONFIG_ROOT', dirname(__FILE__));
require(BETA_CONFIG_ROOT . DS . 'define.php');

try {
    $params = require(BETA_CONFIG_ROOT . DS . 'params.php');
    $defaultSetting = require(BETA_CONFIG_ROOT . DS . 'setting.php');
    $params = array_merge($defaultSetting, $params);
    $cachefile = $defaultSetting['dataPath'] . DS . 'setting.config.php';
    if (file_exists($cachefile)) {
        $customSetting = require($cachefile);
        $params = array_merge($params, $customSetting);
    }
    
}
catch (Exception $e) {
    echo $e->getMessage();
    exit(0);
}

$dbconfig = require($params['dataPath'] . DS . 'db.config.php');

return array(
    'id' => 'weixin800.com',
    'name' => '微800',
    'basePath' => BETA_CONFIG_ROOT . DS . '..',
    'charset' => 'utf-8',
    'language' => 'zh_CN',
    'layout' => 'main',
    'timezone' => 'Asia/Shanghai',

    'import' => array(
		'application.models.*',
		'application.components.*',
        'application.extensions.*',
        'application.widgets.*',
        'application.libs.*',
	),
        
    'modules' => array(
        'admin' => array(
            'layout' => 'main',
        ),
    ),
    'preload' => array('log'),
    'components' => array(
        'log' => array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'categories'=>'system.db.*',
                ),
                /* array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'trace,info,error,notic',
                    'categories'=>'system.db.*',
                ), */
            ),
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'user' => array(
            'allowAutoLogin' => true,
            'loginUrl' => array('site/login'),
            'returnUrl' => array('site/index')
        ),
        'db' => array(
            'class' => 'CDbConnection',
			'connectionString' => sprintf('mysql:host=%s; port=%s; dbname=%s', $dbconfig['dbHost'], $dbconfig['dbPort'], $dbconfig['dbName']),
			'username' => $dbconfig['dbUser'],
		    'password' => $dbconfig['dbPassword'],
		    'charset' => 'utf8',
		    'persistent' => false,
            'attributes' => array(
                PDO::ATTR_EMULATE_PREPARES => true,
            ),
		    'tablePrefix' => $dbconfig['tablePrefix'],
//             'enableParamLogging' => true,
//             'enableProfiling' => true,
// 		    'schemaCacheID' => 'cache',
// 		    'schemaCachingDuration' => 3600 * 24,    // metadata 缓存超时时间(s)
// 		    'queryCacheID' => 'cache',
// 		    'queryCachingDuration' => 60,
        ),
        'cache' => array(
            'class' => 'CFileCache',
            'directoryLevel' => 2,
        ),
        'assetManager' => array(
            'basePath' => $params['resourceBasePath'] . 'assets',
            'baseUrl' => $params['resourceBaseUrl'] . 'assets',
        ),
        'session' => array(
            'autoStart' => true,
            'cookieParams' => array(
                'lifetime' => $params['autoLoginDuration'],
            ),
        ),
        'widgetFactory'=>array(
            'enableSkin'=>true,
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'assignmentTable' => '{{auth_assignment}}',
            'itemChildTable' => '{{auth_itemchild}}',
            'itemTable' => '{{auth_item}}',
            'defaultRoles' => array('member'),
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
		    'showScriptName' => false,
            'caseSensitive' => false,
            'cacheID' => 'cache',
            'rules' => array(
                '' => 'site/index',
                'p/<id:\d+>' => 'post/show',
                'wx/<id:\d+>' => 'weixin/index',
                '<_a:(login|signup|logout)>' => 'site/<_a>',
                'tag/<name:[\w\s\%\-\+\.]+>' => 'tag/posts',
            ),
        ),
    ),

    'params' => $params,
);
