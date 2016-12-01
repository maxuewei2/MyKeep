<?php
require_once ('../funs.php');
$c=getDatabaseConnect($con);
if($c==-1){
echo "Error.Can't connect the database.";
exit;
}
require_once ('../common_head.html');

echo <<<ADD_TABLE
<div class="add_div">
<div class="add_up_div">
<textarea name="new_task_input" id="new_task_input" rows="5" autofocus></textarea>
</div>
<div class="add_down_div">
<button type="button"  class="submit_btn" id="submit_btn" onmouseout="out_btn_bc('submit_btn')" onmouseover="over_btn_bc('submit_btn')" onclick="submit()">Add</button>
<div id="info_out"></div>
</div>
</div>
ADD_TABLE;

$sql="SELECT * FROM `tasks` where task_done='N' or task_done='n' order by task_id desc";
$result =$con->query($sql);
if($result){
	while($row = $result->fetch_array()){
	    $done="<input onclick=\"check_done($row[task_id])\" type=\"checkbox\">";
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
        <button class="edit_btn" id="edit_btn$row[task_id]" onclick="begin_edit($row[task_id])">Edit</button>
        <button class="edit_ok" id="edit_ok$row[task_id]" onclick="edit_done($row[task_id])">OK</button>
        <button class="edit_cancle" id="edit_cancle$row[task_id]" onclick="edit_cancle($row[task_id])">Cancle</button>
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
require_once ('../common_foot.html');

?>
