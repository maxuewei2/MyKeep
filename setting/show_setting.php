<?php
if(!defined('WEB_ROOT')){
    header("HTTP/1.1 404 Not Found");
    exit;
}

$con=getDatabaseConnect();
if($con==-1){
    echo "Error.Can't connect the database.";
    exit;
}

$sql="SELECT setting_content FROM `setting` where setting_name='work_time' ";
$result =$con->query($sql);
if($result){
    $row = $result->fetch_array();
    $work_time=$row['setting_content'];
}
else{
    echo "Error.Can't get settings.";
    exit;
}

$sql="SELECT setting_content FROM `setting` where setting_name='break_time' ";
$result =$con->query($sql);
if($result){
    $row = $result->fetch_array();
    $break_time=$row['setting_content'];
}else{
    echo "Error.Can't get settings.";
    exit;
}


echo <<<HTMLSTR
<div class="setting_div">
<div class="setting_div_head">
时间设定
</div>
<div class="setting_div_content">
<table class="setting_table" border="0">
    <tr>
        <td class="setting_table_th">Work_time:</td>
        <td>
            <input class="setting_input" type="number" min="1" max="60" name="wtime" id="work_time_input" required="required" value=$work_time />
        </td>
        <td rowspan="2" ><button class="setting_input submit_setting_btn" type="button"  id="submit_btn" onclick="submit_setting()">保存更改</button></td>
    </tr>
    <tr>
        <td class="setting_table_th">Break_time:</td>
        <td>
            <input class="setting_input" type="number" min="1" max="60" name="btime" id="break_time_input" required="required" value=$break_time />
        </td>
    </tr>
</table>
</div>
</div>

<div class="setting_div">
<div class="setting_div_head">
导入导出
</div>
<div class="setting_div_content">
<table class="setting_table" border="0">
    <tr>
        <td>Import</td>
        <td>
            <form action="setting/upload_file.php" method="post" enctype="multipart/form-data">
                <input class="setting_input submit_setting_btn" type="file" name="file" id="file" /> 
                <input class="setting_input submit_setting_btn" type="submit" name="submit" value="Import" />
            </form>
        </td>
    </tr>
    <tr>
        <td>Export</td>
        <td>
            <a href="setting/export_file.php"  class="export_a setting_input">下载</a>
        </td>
    </tr>
</table>


</div>
</div>
HTMLSTR;
//<a href="setting/export_file.php" target="_self">下载</a>
$con->close();


?>
