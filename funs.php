<?php

date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai' 亚洲/上海
function getDatabaseConnect(){
    $db_host="localhost:3306";                                           //连接的服务器地址
    $db_user="keep";                                                  //连接数据库的用户名
    $db_psw="mykeep";                                                  //连接数据库的密码
    $db_name="keep";                                           //连接的数据库名称
    $con=new mysqli($db_host,$db_user,$db_psw,$db_name);
    $con->set_charset("utf8");
    if (mysqli_connect_errno()) {
         print(mysqli_connect_error());
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
function php_self(){
    $php_self=substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
    return $php_self;
}
function escape($string, $in_encoding = 'UTF-8',$out_encoding = 'UCS-2') { 
    return $string; 
}
function unescape_str($str) 
{ 
    return $str; 
}
?>
