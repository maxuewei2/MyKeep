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


$sql="SELECT * FROM `tasks` where task_done='Y' or task_done='y' order by task_id desc";
$result =$con->query($sql);
if($result){
	while($row = $result->fetch_array()){
        $done="<input onclick=\"check_done_done($row[task_id])\" type=\"checkbox\" checked=\"checked\">";
        $rows=get_lines_count($row['task_content']);
echo <<<STR1
<div class="task_div">
    <div class="task_up_div">
        <div class="task_done_div">
            $done
        </div>
        <!--
            <div class="task_id_div">
            $row[task_id]
            </div>
        -->
        <div class="task_content_div" id="task_content_div$row[task_id]">
            <textarea class="edit_area" id="edit_area$row[task_id]" rows="$rows" disabled="disabled">$row[task_content]</textarea>
        </div>
        <div class="task_btn_div">
            <button class="task_delete_btn" onclick="delete_task($row[task_id])">X</button>
        </div>
    </div>
    <!--
        <div class="task_down_div">
            <div class="task_time_div">
                $row[task_add_time]
            </div>
        </div>
    -->
</div>
STR1;
}
}

$con->close();

?>
