<?php
require_once ('../funs.php');
$con=getDatabaseConnect();
if($con==-1){
    echo "wrong";
    exit;
}
$id = $_POST['id'];

$sql    = "update `tasks` set task_done='N' where task_id=$id";
$result = $con->query($sql);
if ($result) {
    echo 'success';
} else {
    echo 'wrong';
}

$con->close();
?>
