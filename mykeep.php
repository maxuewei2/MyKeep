<?php
$act = $_GET['action'];
if (strlen($act)){
    if (!preg_match('/^[a-zA-Z]+$/',$act)|| strlen($act) > 7){
        header("HTTP/1.1 404 Not Found");
        exit;
    }
}else{
    header("HTTP/1.1 404 Not Found");
    exit;
}
switch($act){
    case "tasks":
        act_handle($act);
        require_once ('task/show_tasks.php');
        require_once ('common_foot.php');
        break;
    case "dones":
        act_handle($act);
        require_once ('done/show_dones.php');
        require_once ('common_foot.php');
        break;
    case "timer":
        act_handle($act);
        require_once ('timer/show_timer.php');
        require_once ('common_foot.php');
        break;
    case "setting":
        act_handle($act);
        require_once ('setting/show_setting.php');
        require_once ('common_foot.php');
        break;
    default:
        header("HTTP/1.1 404 Not Found");
}

exit;

function act_handle($act){
    define("WEB_ROOT", "MyKeep");
    require_once ('funs.php');
    require_once ('common_head.php');
}

?>
