<?php
if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    unset($_SESSION['db_install_success']);
    $validRequest = true;
    
    $db = $_POST['db'];
    $dbSeverStatus = false;
    $createTableResult = false;
    $conn = @mysql_connect($db['host'], $db['user'], $db['passwd']);
    if ($conn !== false) {
        $result = @mysql_select_db($db['name'], $conn);
    }
    
    if ($conn && $result) {
        $dbSeverStatus = true;
        
        $sqls = fetchsql();
        $query = null;
        foreach ($sqls as $sql) {
            $query = mysql_query($sql, $conn);
            if (!$query) break;
        }
        
        if ($query === false) {
            $dberror = mysql_error();
        }
        else {
            $createTableResult = true;
            $_SESSION['db_install_success'] = 1;
            createInstallLockFile();
            saveDbConfig($db);
            header('Location: ./index.php?step=4');
        }
    }
    else
        $dberror = mysql_error();
}
else
    $validRequest = true;