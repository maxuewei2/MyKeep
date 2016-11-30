<?php
date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai' 亚洲/上海

function getDatabaseConnect(&$con){
    $db_host="localhost:3306";                                           //连接的服务器地址
    $db_user="keep";                                                  //连接数据库的用户名
    $db_psw="101320032";                                                  //连接数据库的密码
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
<link rel="shortcut icon" href="images/favicon.ico" >
<title>MyKeep</title>
<link href="common.css" rel="stylesheet" type="text/css" />
<link href="todo.css" rel="stylesheet" type="text/css" />
<link href="done.css" rel="stylesheet" type="text/css" />
<link href="timer.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="nav">
<a id="show_todo" class="show_nav_a" href="show_todos.php" >
Todo
</a>
<a id="show_done" class="show_nav_a" href="show_dones.php">
Done
</a>
</div>

<div id="content_body">
HEAD;

}


function echo_common_foot(){
echo<<<FOOT
</div> <!-- end of content_body div-->

<div id="top_bottom">
<a class="to_top" href="#top">Top</a>
<!--
<a class="to_bottom" href="#end">Bottom</a>
-->
<a class="to_bottom" href="javascript:void(0);" onclick="javascript:document.getElementsByTagName('BODY')[0].scrollTop=document.getElementsByTagName('BODY')[0].scrollHeight;">Bottom</a>
</div>
<script src="common.js" type="text/javascript"></script>
<script src="edit.js" type="text/javascript"></script>
<script src="todo.js" type="text/javascript"></script>
<script src="done.js" type="text/javascript"></script>
<script src="timer.js" type="text/javascript"></script>
</body>

</html>
FOOT;

}
?>
