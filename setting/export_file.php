<?php
require_once ('../funs.php');
$con=getDatabaseConnect();
if($con==-1){
    echo "wrong";
    exit;
}
if(update_xml($con)==-1){echo "Error.";exit;}
$con->close();

$file="setting.xml";
$time    = date('Y_m_d_H_i_s', time());
$down_name="setting_".$time.".xml";
//判断给定的文件存在与否 
if(!file_exists($file)){
    die("文件无法生成"); 
} 
$fp = fopen($file,"r");
$file_size = filesize($file);
//下载文件需要用到的头 header("Content-type: application/octet-stream");
header("Accept-Ranges: bytes");
header("Accept-Length:".$file_size);
header("Content-Disposition: attachment; filename=".$down_name);
$buffer = 1024;
$file_count = 0;
//向浏览器返回数据 
while(!feof($fp) && $file_count < $file_size){
    $file_con = fread($fp,$buffer);
    $file_count += $buffer;
    echo $file_con;
} 
fclose($fp);


function update_xml($con){
$myfile = fopen("setting.xml", "w");
if(!$myfile){
    return -1;
} 
$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
fwrite($myfile, $xml);
fwrite($myfile, "<tasks>\n");
$sql="SELECT * FROM `tasks` ";
$result =$con->query($sql);
if($result){
    while($row = $result->fetch_array()){
        $cont=unescape_str($row['task_content']);
        
        fwrite($myfile, "<task>\n");

        fwrite($myfile, "<id>");
        fwrite($myfile, $row['task_id']);
        fwrite($myfile, "</id>\n");
        
        fwrite($myfile, "<content>");
        fwrite($myfile, $cont);
        fwrite($myfile, "</content>\n");
        
        fwrite($myfile, "<time>");
        fwrite($myfile, $row['task_add_time']);
        fwrite($myfile, "</time>\n");
        
        fwrite($myfile, "<done>");
        fwrite($myfile, $row['task_done']);
        fwrite($myfile, "</done>\n");
        
	    
	    fwrite($myfile, "</task>\n");
    }
}
else{
    return -1;
}
fwrite($myfile, "</tasks>");
fclose($myfile);
}
?>
