<?php

define('REQUIREMENT_PASSED', 1);
define('REQUIREMENT_ERROR', 0);
define('REQUIREMENT_WARNING', -1);

define('DS', DIRECTORY_SEPARATOR);

/**
 * Returns a localized message according to user preferred language.
 * @param string message category
 * @param string message to be translated
 * @param array parameters to be applied to the translated message
 * @return string translated message
 */
function t($category, $message, $params=array())
{
    static $messages;

    if ($messages === null) {
        $messages = array();
        if(($lang=getPreferredLanguage()) !== false) {
            $file = dirname(__FILE__)."/messages/$lang/yii.php";
            if (is_file($file))
                $messages = include($file);
        }
    }

    if (empty($message)) return $message;

    if (isset($messages[$message]) && $messages[$message] !== '')
        $message = $messages[$message];

    return $params !== array() ? strtr($message, $params) : $message;
}

function renderFile($_file, $_params=array())
{
    extract($_params);
    require($_file);
}

function checkRuntimeAccess()
{
    $path = PATH_ROOT . DS . '..' . DS . 'protected' . DS . 'runtime';
    return file_exists($path) && is_writable($path);
}

function checkDataAccess()
{
    $path = PATH_ROOT . DS . '..' . DS . 'protected' . DS . 'data';
    return file_exists($path) && is_writable($path);
}

function checkDbConfigAccess()
{
    $path = PATH_ROOT . DS . '..' . DS . 'protected' . DS . 'data' . DS . 'db.config.php';
    return !file_exists($path) || is_writable($path);
}

function checkUploadAccess()
{
    $path = PATH_ROOT . DS . '..' . DS . 'uploads';
    return file_exists($path) && is_writable($path);
}

function checkAssetsAccess()
{
    $path = PATH_ROOT . DS . '..' . DS . 'assets';
    return file_exists($path) && is_writable($path);
}

function createInstallLockFile()
{
    $filename = PATH_ROOT . DS . '..' . DS . 'protected' . DS . 'data' . DS . 'install.lock';
    $result = file_put_contents($filename, '1');
    return $result;
}

function installLockFileExist()
{
    $filename = PATH_ROOT . DS . '..' . DS . 'protected' . DS . 'data' . DS . 'install.lock';
    return file_exists($filename);
}

function fetchsql()
{
    $filename = dirname(__FILE__) . DS . 'wei800.sql';
    if (file_exists($filename) && is_readable($filename)) {
        $sqls = file($filename, FILE_IGNORE_NEW_LINES);
        if ($sqls ===  false) {
            echo "读取sql文件{$filename}失败。";
            exit(0);
        }
        else {
            $sqls = array_map('trim', $sqls);
            $sqls = array_filter($sqls);
            return $sqls;
        }
    }
    else {
        echo $filename . '不存在或不可读';
        exit(0);
    }
}

function saveDbConfig($config)
{
    $cfg = array(
        'dbHost' => $config['host'],
        'dbName' => $config['name'],
        'dbUser' => $config['user'],
        'dbPassword' => $config['passwd'],
        'tablePrefix' => 'cd_',
    );
    $data = "<?php\nreturn " . var_export($cfg, true) . ';';
    $filename = PATH_ROOT . DS . '..' . DS . 'protected' . DS . 'data' . DS . 'db.config.php';
    $result = file_put_contents($filename, $data);
    return $result;
}


