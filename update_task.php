<?php
include 'funs.php';
getDatabaseConnect($con);

$id      = $_POST['id'];
$content = $_POST['content'];

$sql    = "update `tasks` set task_content='$content' where task_id='$id'";
$result = $con->query($sql);
if ($result) {
    echo 'success';
    echo $id;
    echo $content;
    exit;
} else {
    echo 'wrong';
    exit;
}

$con->close();
?>
