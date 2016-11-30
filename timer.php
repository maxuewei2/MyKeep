<?php
include 'funs.php';
$c=getDatabaseConnect($con);
if($c==-1){
echo "Error.Can't connect the database.";
exit;
}

echo_common_head();

$sql="SELECT * FROM `tasks` where task_done='N' or task_done='N' order by task_id desc";
$result =$con->query($sql);
if($result){
echo <<<STR1
<div class="select_div">
<select class="task_select">
STR1;

	while($row = $result->fetch_array()){
	$i=strpos($row['task_content'],"\n");
	if(!$i){$i=strlen($row['task_content']);}
$select_content=substr($row['task_content'],0,$i);

echo <<<STR1
  <option  onclick="select_task($row[task_id])">$select_content</option>
STR1;
}
echo <<<STR1
</select>
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
STR;
echo_common_foot();

?>





