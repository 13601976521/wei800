<?php
define('BETA_CONFIG_ROOT', dirname(__FILE__));
require(BETA_CONFIG_ROOT . DS . 'define.php');

try {
    $params = require(BETA_CONFIG_ROOT . DS . 'params.php');
    $defaultSetting = require(BETA_CONFIG_ROOT . DS . 'setting.php');
    $params = array_merge($defaultSetting, $params);
    $cachefile = $defaultSetting['dataPath'] . DS . 'setting.config.php';
    if (file_exists($cachefile) && is_readable($cachefile)) {
        $customSetting = require($cachefile);
        $params = array_merge($params, $customSetting);
    }
    
}
catch (Exception $e) {
    echo $e->getMessage();
    exit(0);
}

$dbfile = $params['dataPath'] . 'db.config.php';
if (file_exists($dbfile) && is_readable($dbfile))
    $dbconfig = @require($dbfile);
else {
    header('Content-Type: text/plain; charset=utf-8');
    echo 'db.config.php数据库配置文件不存在，请先安装程序或检查文件是否存在。';
    exit(0);
}


return array(
    'id' => $_SERVER['HTTP_HOST'],
    'name' => $params['site_name'],
    'basePath' => BETA_CONFIG_ROOT . DS . '..',
    'charset' => 'utf-8',
    'language' => 'zh_CN',
    'layout' => 'weixin',
    'timezone' => 'Asia/Shanghai',
    'theme' => $params['theme_name'],

    'import' => array(
		'application.models.*',
		'application.components.*',
        'application.extensions.*',
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
            'loginUrl' => array('/site/login'),
            'returnUrl' => array('/site/index')
        ),
        'db' => array(
            'class' => 'CDbConnection',
			'connectionString' => sprintf('mysql:host=%s; dbname=%s', $dbconfig['dbHost'], $dbconfig['dbName']),
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
        'cache' => YII_DEBUG || !$params['cache_enable'] ? null : array(
            'class' => 'CFileCache',
            'directoryLevel' => 2,
        ),
        'assetManager' => array(
            'basePath' => $params['assetsBasePath'],
            'baseUrl' => $params['assetsBaseUrl'],
        ),
        'themeManager' => array(
            'themeClass' => 'application.extensions.CDTheme',
            'basePath' => $params['themeResourceBasePath'],
            'baseUrl' => $params['themeResourceBaseUrl'],
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
        'urlManager' => array(
            'urlFormat' => in_array($params['url_format'], array('get', 'path')) ? $params['url_format'] : 'get',
		    'showScriptName' => false,
            'caseSensitive' => false,
            'cacheID' => 'cache',
            'rules' => array(
                '' => 'site/index',
                'p/<id:\d+>' => 'weixin/post',
                'gh/<id:\d+>' => 'site/gh',
                'weixin/<_a>' => 'weixin/<_a>',
                '<_a:(login|logout)>' => 'site/<_a>',
            ),
        ),
    ),

    'params' => $params,
);
