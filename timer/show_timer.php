<?php
require_once ('../funs.php');
$con=getDatabaseConnect();
if($con==-1){
    echo "Error.Can't connect the database.";
    exit;
}

require_once ('../common_head.html');

$sql="SELECT setting_content FROM `setting` where setting_name='work_time' ";
$result =$con->query($sql);
if($result){
    $row = $result->fetch_array();
    $work_time=$row['setting_content'];
}else{
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

echo<<<TIME
<div class="time_setting_div">
    <input id="work_time_setting_input" value=$work_time>$work_time</input>
    <input id="break_time_setting_input" value=$break_time>$break_time</input>
</div>
TIME;
$sql="SELECT * FROM `tasks` where task_done='N' or task_done='N' order by task_id desc";
$result =$con->query($sql);
if($result){
echo <<<STR1
<div class="select_div">
    <select id="task_select" class="task_select" onmouseover="show_select_content()" onmouseout="out_select()">
STR1;

	while($row = $result->fetch_array()){
    	$i=strpos($row['task_content'],"\n");
    	if(!$i){
    	    $i=strlen($row['task_content']);
    	}
            $select_content=substr($row['task_content'],0,$i);
echo <<<STR1
        <option value=$row[task_id] id="option$row[task_id]">$select_content</option>
STR1;
    }
echo <<<STR1
    </select>
    <div id="select_content_div"  ">
        <textarea id="select_content_area" rows="10" cols="50" onmouseover="on_area()" onmouseout="hide_select_content_1()"></textarea>
    </div>
    <!--
        <input id="select_content_input" value=-1 />
    -->
</div>
STR1;
}

$con->close();
echo<<<STR
<div id="canvas_div">
    <!--
        <canvas id="timer_canvas">你的浏览器不支持canvas标签，请使用Chrome浏览器或者FireFox浏览器.</canvas>
        <canvas id="myCanvas" width="200" height="100"></canvas>
    -->
    <canvas id="timer_canvas" width="100" height="100"></canvas>
</div>
<div class="btn_div">
    <table class="btn_table">
        <tr>
            <td>
                <button id="timer_done_btn" class="timer_btn" onclick="on_done_btn()">Done</button>
            </td>
            <td>
                <button id="timer_skip_btn" class="timer_btn" onclick="on_skip_btn()">Skip</button>
            </td>
            <td>
                <button id="timer_start_btn" class="timer_btn" onclick="on_start_pause_btn()">Start</button>
            </td>
            <td>
                <button id="timer_stop_btn" class="timer_btn" onclick="on_stop_btn()">Stop</button>
            </td>
        </tr>
    </table>
</div>
STR;
require_once ('../common_foot.html');

?>

