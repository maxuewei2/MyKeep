<?php
include 'funs.php';
$c=getDatabaseConnect($con);
if($c==-1){
echo "Error.Can't connect the database.";
exit;
}

echo_common_head();

$sql="SELECT * FROM `tasks` where task_done='Y' or task_done='y' order by task_id desc";
$result =$con->query($sql);
if($result){
	while($row = $result->fetch_array()){
        $done="<input onclick=\"check_done_done($row[task_id])\" type=\"checkbox\" checked=\"checked\">";
        $rows=get_lines_count($row['task_content']);
echo <<<STR1
<div class="todo_div">
<div class="todo_up_div">
<div class="todo_done_div">
$done
</div>
<!--
<div class="todo_id_div">
$row[task_id]
</div>
-->
    <div class="todo_content_div" id="todo_content_div$row[task_id]">
<textarea class="edit_area" id="edit_area$row[task_id]" rows="$rows" disabled="disabled">$row[task_content]</textarea>
</div>

<div class="todo_btn_div">
<button class="todo_delete_btn" onclick="delete_todo($row[task_id])">X</button>
</div>

</div>
<!--
<div class="todo_down_div">
<div class="todo_time_div">
$row[task_add_time]
</div>
</div>
-->
</div>

STR1;
}
}

$con->close();
echo_common_foot();

?>
