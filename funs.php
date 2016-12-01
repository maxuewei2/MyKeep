<?php
date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai' 亚洲/上海
function getDatabaseConnect(){
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
?>
