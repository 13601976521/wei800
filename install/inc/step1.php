<?php
$requirements=array(
    array(
            'PHP版本',
            true,
            version_compare(PHP_VERSION, "5.2.1",">="),
            'PHP 5.2.1或更高版本是必须的。'),
    array(
            '$_SERVER变量',
            true,
            ($message=checkServerVar()) === '',
            $message),
    array(
            'Reflection扩展模块',
            true,
            class_exists('Reflection',false),
            ''),
    array(
            'PCRE扩展模块',
            true,
            extension_loaded("pcre"),
            ''),
    array(
            'SPL扩展模块',
            true,
            extension_loaded("SPL"),
            ''),
    array(
            'DOM扩展模块',
            false,
            class_exists("DOMDocument",false),
            ''),
    array(
            'CURL扩展模块',
            false,
            function_exists("curl_init"),
            '抓取远程文件时会用到此扩展'),
    array(
            'PDO扩展模块',
            false,
            extension_loaded('pdo'),
            '要使用数据库，此模块是必须'),
    /*array(
           'PDO SQLite扩展模块',
            false,
            extension_loaded('pdo_sqlite'),
            '如果使用SQLite数据库，这是必须的。'),*/
    array(
            'PDO MySQL扩展模块',
            false,
            extension_loaded('pdo_mysql'),
            '如果使用MySQL数据库，这是必须的。'),
    /*array(
            'PDO PostgreSQL扩展模块',
            false,
            extension_loaded('pdo_pgsql'),
            '如果使用PostgreSQL数据库，这是必须的。'),
            */
    array(
            'Memcache扩展模块',
            false,
            extension_loaded("memcache") || extension_loaded("memcached"),
            '如果要使用memcached缓存服务器，需要此模块'),
    
    /*array(
            'APC扩展模块',
            false,
            extension_loaded("apc"),
            ''),*/
    array(
            'Mcrypt扩展模块',
            false,
            extension_loaded("mcrypt"),
            '如果用到加密解密功能，会需要此模块'),
    /*array(
            'SOAP扩展模块',
            false,
            extension_loaded("soap"),
            ''),*/
    array(
            'GD extension with<br />FreeType support',
            false,
            ($message=checkGD()) === '',
            $message === '' ? '验证码及图表功能会用到GD模块' : $message),
    array(
            'Ctype extension',
            false,
            extension_loaded("ctype"),
            ''
    ),
    array(
            'zip 扩展',
            false,
            extension_loaded("zip"),
            '自动下载安装模板包时解压模板包会用到此模块'
    ),
    array(
            'protected/runtime<br />临时目录权限',
            true,
            checkRuntimeAccess(),
            'protected/runtime必须为php脚本执行用户可写目录，建议设置为777权限'
    ),
    array(
            'protected/data<br/>数据缓存目录权限',
            true,
            checkDataAccess(),
            'protected/data必须为php脚本执行用户可写目录，建议设置为777权限'
    ),
    array(
            'protected/data/db.config.php<br/>数据库配置文件权限',
            true,
            checkDbConfigAccess(),
            'db.config.php不存在将会创建新文件，如果已经存在必须设置为php脚本执行用户可写目录，建议设置为777权限'
    ),
    array(
            'uploads<br />附件存放目录权限',
            true,
            checkUploadAccess(),
            'uploads 附件上传保存目录必须为php脚本执行用户可写目录，建议设置为777权限'
    ),
    array(
            'assets<br />静态资源发布目录权限',
            true,
            checkAssetsAccess(),
            'assets 静态资源发布必须为php脚本执行用户可写目录，建议设置为777权限'
    ),
);

function checkServerVar()
{
    $vars=array('HTTP_HOST','SERVER_NAME','SERVER_PORT','SCRIPT_NAME','SCRIPT_FILENAME','PHP_SELF','HTTP_ACCEPT','HTTP_USER_AGENT');
    $missing = array();
    foreach($vars as $var)
        if(!isset($_SERVER[$var])) $missing[] = $var;
    
    if (!empty($missing))
        return '$_SERVER does not have .' . array('{vars}'=>implode(', ',$missing));

//     if(realpath($_SERVER["SCRIPT_FILENAME"]) !== realpath(__FILE__))
//         return '$_SERVER["SCRIPT_FILENAME"] must be the same as the entry script file path.';

    if(!isset($_SERVER["REQUEST_URI"]) && isset($_SERVER["QUERY_STRING"]))
        return 'Either $_SERVER["REQUEST_URI"] or $_SERVER["QUERY_STRING"] must exist.';

    if(!isset($_SERVER["PATH_INFO"]) && strpos($_SERVER["PHP_SELF"],$_SERVER["SCRIPT_NAME"]) !== 0)
        return 'Unable to determine URL path info. Please make sure $_SERVER["PATH_INFO"] (or $_SERVER["PHP_SELF"] and $_SERVER["SCRIPT_NAME"]) contains proper value.';

    return '';
}

function checkGD()
{
    if(extension_loaded('gd')) {
        $gdinfo = gd_info();
        if ($gdinfo['FreeType Support'])
            return '';
        return 'GD 已经安装<br />FreeType support 未安装';
    }
    return 'GD扩展库没有安装';
}

function getPreferredLanguage()
{
    if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && ($n=preg_match_all('/([\w\-]+)\s*(;\s*q\s*=\s*(\d*\.\d*))?/',$_SERVER['HTTP_ACCEPT_LANGUAGE'],$matches)) > 0) {
        $languages = array();
        for($i=0; $i < $n; ++$i)
            $languages[$matches[1][$i]]=empty($matches[3][$i]) ? 1.0 : floatval($matches[3][$i]);
        arsort($languages);
        foreach ($languages as $language => $pref)
            return strtolower(str_replace('-', '_', $language));
    }
    return false;
}

$result = REQUIREMENT_PASSED;  // 1: all pass, 0: fail, -1: pass with warnings

foreach($requirements as $i=>$requirement)
{
    if ($requirement[1] && !$requirement[2])
        $result = REQUIREMENT_ERROR;
    else if ($result > 0 && !$requirement[1] && !$requirement[2])
        $result = REQUIREMENT_WARNING;
    if ($requirement[4] === '')
        $requirements[$i][4]='&nbsp;';
}

$_SESSION['check_result'] = $result;





