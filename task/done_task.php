<?php
require_once ('../funs.php');
$con=getDatabaseConnect();
if($con==-1){
    echo "wrong";
    exit;
}
$id ='';
if (isset($_POST['id'])){ 
    $id = $_POST['id']; 
}

if (strlen($id)){
    if (!preg_match('/^[0-9]+$/',$id)|| strlen($id) > 10){
        echo "wrong";
        exit;
    }
}else{
    echo "wrong";
    exit;
}
$id = $con->real_escape_string($id);
$sql  = "update `tasks` set task_done='Y' where task_id=?";
if($stmt = $con->prepare($sql)){
    $stmt->bind_param('s', $id);
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
