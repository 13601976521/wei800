<?php
$checkResult = (int)$_SESSION['check_result'];
if ($checkResult == REQUIREMENT_ERROR) {
    header('Location:./index.php');
    exit(0);
}