<?php
if(!isset($_FILES["file"])){
    echo "error<br/>";
    echo '5秒后跳转回设置页.';
    header("Refresh:5;url=../mykeep.php?action=setting");
    exit;
}
//echo $_FILES["file"]["type"];
if (($_FILES["file"]["type"] == "text/xml")&& ($_FILES["file"]["size"] < 20000000)){
    if ($_FILES["file"]["error"] > 0){
        echo "Error: " . $_FILES["file"]["error"] . "<br />";
        echo '<br/>5秒后跳转回设置页.';
        header("Refresh:5;url=../mykeep.php?action=setting");
        exit;
    }
    /*else{
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        echo "Stored in: " . $_FILES["file"]["tmp_name"];
    }*/
}
else{
    echo "Invalid file<br/>";
    echo '<br/>5秒后跳转回设置页.';
    header("Refresh:5;url=../mykeep.php?action=setting");
    exit;
}
require_once ('../funs.php');

//创建一个DOMDocument对象
$doc=new DOMDocument();
//加载XML文件
//获取所有的book标签
$doc->load($_FILES["file"]["tmp_name"]);
$taskDom=$doc->getElementsByTagName("task");

$con=getDatabaseConnect();
if($con==-1){
    echo "wrong<br/>";
    echo '<br/>5秒后跳转回设置页.';
    header("Refresh:5;url=../mykeep.php?action=setting");
    exit;
}
$sql="select task_id from tasks";
$result =$con->query($sql);
$ids=array();
while($row = $result->fetch_array()){
    array_push($ids,$row['task_id']);
}


$con->autocommit(false); // 开始事务
$is_error=0;
$id_updates=array();
$id_inserts=array();
foreach($taskDom as $task){
    $id = $task->getElementsByTagName("id")->item(0)->nodeValue;
    $content = $task->getElementsByTagName("content")->item(0)->nodeValue;
    $time = $task->getElementsByTagName("time")->item(0)->nodeValue;
    $done = $task->getElementsByTagName("done")->item(0)->nodeValue;
    /*echo "id：".$id."<br>";
    echo "content：".$content."<br>";
    echo "time：".$time."<br>";
    echo "done：".$done ."<br>";
    */
    if(!in_array($id,$ids)){
        $sql="insert into tasks (task_id,task_content,task_add_time,task_done) values ('$id','$content','$time','$done')";
        array_push($id_inserts,$id);
    }
    else{
        $sql="update tasks set task_content='$content',task_add_time='$time',task_done='$done' where task_id = '$id' ";
        array_push($id_updates,$id);
    }
    $result =$con->query($sql);
    $is_error+=$result?0:1;
}
if (!$is_error) {//!$mysqli->errno
    $con->commit();
    echo '成功<br/>';
    $arrlength=count($id_inserts);
    echo '新增数据'.$arrlength.'条<br/>';
    $arrlength=count($id_updates);
    echo '更新数据'.$arrlength.'条<br/>';
} else {
    echo 'error';
    $con->rollback();
}

$con->autocommit(true);
$con->close();
echo '<br/>5秒后跳转回设置页.';
header("Refresh:5;url=../mykeep.php?action=setting");

?>
