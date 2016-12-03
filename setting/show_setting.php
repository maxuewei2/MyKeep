<?php
require_once ('../funs.php');
$c=$con=getDatabaseConnect();
if($c==-1){
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

require_once ('../common_head.php');

echo <<<HTMLSTR
<table class="setting_table" border="0">
    <tr>
        <th>Work_time:</th>
        <td>
            <input class="setting_input" type="number" min="1" max="60" name="wtime" id="work_time_input" required="required" value=$work_time />
        </td>
        <td rowspan="2" ><button class="setting_input submit_setting_btn" type="button"  id="submit_btn" onclick="submit_setting()">保存更改</button></td>
    </tr>
    <tr>
        <th>Break_time:</th>
        <td>
            <input class="setting_input" type="number" min="1" max="60" name="btime" id="break_time_input" required="required" value=$break_time />
        </td>
    </tr>
</table>
HTMLSTR;

$con->close();
require_once ('../common_foot.php');
?>
