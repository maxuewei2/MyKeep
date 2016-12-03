<?php
require_once ('../funs.php');
$con=getDatabaseConnect();
if($con==-1){
    echo "Error.Can't connect the database.";
    exit;
}

$id      = $_POST['id'];

$sql    = "select task_content from `tasks` where task_id='$id'";
$result = $con->query($sql);
if ($result) {
    $row = $result->fetch_array();
    echo "$row[task_content]";
} else {
    echo 'Something is wrong.';
}

$con->close();
?>
