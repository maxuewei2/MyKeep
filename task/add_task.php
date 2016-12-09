<?php
require_once ('../funs.php');
$con=getDatabaseConnect();
if($con==-1){
    echo "wrong";
    exit;
}
$content = $_POST['content'];
$time    = date('Y-m-d H:i:s', time());


if (!strlen($content)){
    echo "wrong";
    exit;
}
$content = escape($content);//$con->real_escape_string($content);
$sql    = "insert into `tasks` (task_content,task_add_time,task_done) values(?,'$time','N')";

if($stmt = $con->prepare($sql)){
    $stmt->bind_param('s', $content);
    $stmt->execute();
    if ($stmt->affected_rows) {
        echo 'success';
    } else {
        echo 'wrong';
    }
}
$stmt->free_result();
$stmt->close();
$con->close();
?>
