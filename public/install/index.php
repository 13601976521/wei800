<?php
define('DS', DIRECTORY_SEPARATOR);
define('PATH_ROOT', dirname(__FILE__) . DS);
session_start();
require PATH_ROOT . 'inc' . DS . 'common.inc.php';

$step = (int)$_GET['step'];
if (installLockFileExist() && $step < 4) {
    echo 'install.lock文件已经存在，请先删除此文件。';
    exit(0);
}

if ($step >= 1 && $step <= 4)
    $file = 'step' . $step . '.php';
else
    $file = 'index.php';

$viewFile =  PATH_ROOT . 'views' . DS . $file;
$data = array('step' => $step);

switch ($step)
{
    case 1:
        require PATH_ROOT . 'inc' . DS . 'step1.php';
        $data['result'] = $result;
        $data['requirements'] = $requirements;
        break;
    case 2:
        require PATH_ROOT . 'inc' . DS . 'step2.php';
        break;
    case 3:
        require PATH_ROOT . 'inc' . DS . 'step3.php';
        $data['dbSeverStatus'] = $dbSeverStatus;
        $data['createTableResult'] = $createTableResult;
        $data['validRequest'] = $validRequest;
        break;
    case 4:
        require PATH_ROOT . 'inc' . DS . 'step4.php';
        break;
    default:
        break;
}

renderFile($viewFile, $data);