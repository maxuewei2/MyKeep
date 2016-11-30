<?php
include 'funs.php';
getDatabaseConnect($con);
$wtime = $_POST['wtime'];
$btime = $_POST['btime'];

$result1 = $con->query("UPDATE `setting` SET setting_content='$wtime' WHERE setting_name='work_time' ");
$result2 = $con->query("UPDATE `setting` SET setting_content='$btime' WHERE setting_name='break_time' ");
if ($result1) {
    print 'work_time更新成功<br/>';
} else {
    print 'work_time更新失败<br/>';
}
if ($result2) {
    print 'break_time更新成功<br/>';
} else {
    print 'break_time更新失败<br/>';
}

$con->close();
?>
