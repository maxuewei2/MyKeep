<?php
require_once ('../funs.php');
$con=getDatabaseConnect();
if($con==-1){
    echo "0";
    exit;
}
$wtime = $_POST['wtime'];
$btime = $_POST['btime'];

$result1 = $con->query("UPDATE `setting` SET setting_content='$wtime' WHERE setting_name='work_time' ");
$result2 = $con->query("UPDATE `setting` SET setting_content='$btime' WHERE setting_name='break_time' ");
$e=0;
if ($result1) {
    $e+=1;
}
else{
}
if ($result2) {
      $e+=2;
} else {
}
echo $e;
$con->close();
?>
