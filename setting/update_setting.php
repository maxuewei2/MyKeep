<?php
include '../funs.php';
getDatabaseConnect($con);
$wtime = $_POST['wtime'];
$btime = $_POST['btime'];

$result1 = $con->query("UPDATE `setting` SET setting_content='$wtime' WHERE setting_name='work_time' ");
$result2 = $con->query("UPDATE `setting` SET setting_content='$btime' WHERE setting_name='break_time' ");
$e=0;
if ($result1) {
    //print 'Work_time更新成功<br/>';
    $e+=1;
} else {
//    print 'Work_time更新失败<br/>';
}
if ($result2) {
  //  print 'Break_time更新成功<br/>';
      $e+=2;
} else {
//    print 'Break_time更新失败<br/>';
}
echo $e;
$con->close();
?>
