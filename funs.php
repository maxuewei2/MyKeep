<?php
date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai' 亚洲/上海

function getDatabaseConnect(&$con){
    $db_host="localhost:3306";                                           //连接的服务器地址
    $db_user="keep";                                                  //连接数据库的用户名
    $db_psw="mykeep";                                                  //连接数据库的密码
    $db_name="keep";                                           //连接的数据库名称
    $con=new mysqli($db_host,$db_user,$db_psw,$db_name);
    if (!$con){
         die('Could not connect: ' . mysql_error());
         return -1;
    }
    return $con;
}
function get_lines_count($content){
//$c=strspn($content,"\\r\\n");
$order=array("\r\n","\n","\r");
$replace='<br/>';
$newstr=str_replace($order,$replace,$content);
$c=substr_count($newstr,"<br/>");
    return $c+1;
}
function echo_common_head(){

echo <<<HEAD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico" />
<title>MyKeep</title>
<link href="../css/common.css" rel="stylesheet" type="text/css" />
<link href="../css/task.css" rel="stylesheet" type="text/css" />
<link href="../css/done.css" rel="stylesheet" type="text/css" />
<link href="../css/timer.css" rel="stylesheet" type="text/css" />
<link href="../css/setting.css" rel="stylesheet" type="text/css" />
</head>

<body>

<a id="show_setting" class="show_setting" href="../setting/show_setting.php">
<img src="../image/setting.png"/>
</a>

<div id="top_bottom">
<a class="to_top" href="#top">Top</a>
<!--
<a class="to_bottom" href="#end">Bottom</a>
-->
<a class="to_bottom" href="#end_of_docu">Bottom</a>
</div>


<div id="nav">
<a id="show_task" class="show_nav_a" href="../task/show_tasks.php" >
Task
</a>
<a id="show_done" class="show_nav_a" href="../done/show_dones.php">
Done
</a>
<a id="show_timer" class="show_nav_a" href="../timer/show_timer.php">
Timer
</a>
</div>

<div id="content_body">
HEAD;

}


function echo_common_foot(){
echo<<<FOOT
</div> <!-- end of content_body div-->

<script src="../js/common.js" type="text/javascript"></script>
<script src="../js/edit.js" type="text/javascript"></script>
<script src="../js/task.js" type="text/javascript"></script>
<script src="../js/done.js" type="text/javascript"></script>
<script src="../js/timer.js" type="text/javascript"></script>
</body>
<a name="end_of_docu"></a>
</html>
FOOT;

}
?>
