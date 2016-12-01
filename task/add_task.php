<?php
require_once ('../funs.php');
$con=getDatabaseConnect();




$content = $_POST['content'];
$time    = date('Y-m-d H:i:s', time());

$sql    = "insert into `tasks` (task_content,task_add_time,task_done) values('$content','$time','N')";
$result = $con->query($sql);
if ($result) {
    echo 'success';
    exit;
} else {
    echo 'wrong';
    exit;
}

$con->close();
?>
