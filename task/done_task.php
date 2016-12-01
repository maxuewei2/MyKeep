<?php
require_once ('../funs.php');
getDatabaseConnect($con);

$id = $_POST['id'];

$sql    = "update `tasks` set task_done='Y' where task_id=$id";
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
