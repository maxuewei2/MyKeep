<?php
require_once ('../funs.php');
$con=getDatabaseConnect();

$id = $_POST['id'];

$sql    = "delete from`tasks` where task_id=$id";
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
