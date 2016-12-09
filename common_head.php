<?php
if(!defined('WEB_ROOT')){
    header("HTTP/1.1 404 Not Found");
    exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="favicon.ico" />
        <title>MyKeep</title>
        <link href="css/common.css" rel="stylesheet" type="text/css" />
        <?php
        if(!isset($act)){
        echo "fffff";
        }
        if($act=='tasks'){
            echo '<link href="css/task.css" rel="stylesheet" type="text/css" />';
        }
        if($act=='dones'){
            echo '<link href="css/done.css" rel="stylesheet" type="text/css" />';
        }
        if($act=='timer'){
            echo '<link href="css/timer.css" rel="stylesheet" type="text/css" />';
        }
        if($act=='setting'){
            echo '<link href="css/setting.css" rel="stylesheet" type="text/css" />';
        }
        ?>
    </head>
    <body>
        <a id="show_setting" class="show_setting" href="mykeep.php?action=setting">
            <img src="image/setting.png"/>
        </a>
        <div id="top_bottom">
            <a class="to_top" href="#top">Top</a>
            <!--
                <a class="to_bottom" href="#end">Bottom</a>
            -->
            <a class="to_bottom" href="#end_of_docu">Bottom</a>
        </div>
        <div id="nav">
            <a id="show_task" class="show_nav_a" href="mykeep.php?action=tasks" >Task</a>
            <a id="show_done" class="show_nav_a" href="mykeep.php?action=dones">Done</a>
            <a id="show_timer" class="show_nav_a" href="mykeep.php?action=timer">Timer</a>
        </div>
        <div id="content_body">
