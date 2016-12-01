<?php
require_once ('../funs.php');
$c=getDatabaseConnect($con);
if($c==-1){
echo "Error.Can't connect the database.";
exit;
}

$sql="SELECT setting_content FROM `setting` where setting_name='work_time' ";
$result =$con->query($sql);
if($result){
$row = $result->fetch_array();
$work_time=$row['setting_content'];
}else{
echo "Error.Can't get settings.";
exit;
}

$sql="SELECT setting_content FROM `setting` where setting_name='break_time' ";
$result =$con->query($sql);
if($result){
$row = $result->fetch_array();
$break_time=$row['setting_content'];
}else{
echo "Error.Can't get settings.";
exit;
}

require_once ('../common_head.html');

echo <<<HTMLSTR
<table class="setting_table" border="0">

<tr>
<th>Work_time:</th>
<td>
<input class="setting_input" type="number" min="1" max="60" name="wtime" id="work_time_input" required="required" value=$work_time />
</td>
<td rowspan="2" ><button class="setting_input submit_setting_btn" type="button"  id="submit_btn" onclick="submit_setting()">保存更改</button></td>
</tr>

<tr>
<th>Break_time:</th>
<td>
<input class="setting_input" type="number" min="1" max="60" name="btime" id="break_time_input" required="required" value=$break_time />
</td>
</tr>

</table>


<div id="infoout"></div>

<script language="JavaScript">
 function submit_setting(){
 	var wtime=document.getElementById("work_time_input").value;
 	var btime=document.getElementById("break_time_input").value;
	if(wtime==""){document.getElementById("infoout").innerHTML="work_time不能为空。";return;}
    if(!(/^\d+$/.test(wtime))){
        document.getElementById("infoout").innerHTML="work_time请填入数字。";
        return;
    }
 	if(btime==""){document.getElementById("infoout").innerHTML="break_time不能为空。";return;}
    if(!(/^\d+$/.test(btime))){
        document.getElementById("infoout").innerHTML="break_time请填入数字。";
        return;
    }

  var url="update_setting.php";
	var args="wtime="+wtime+"&btime="+btime;
	//alert(url);
	postajax_setting("infoout",url,args);
 }
</script>
HTMLSTR;
echo<<<OSTR
<script language="JavaScript">
 function postajax_setting(id,url,args){
 var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
//    document.getElementById(id).innerHTML=xmlhttp.responseText;
var rr=xmlhttp.responseText;
if(rr=="3"){alert("更新成功");}
if(rr=="2"){alert("仅Break_time更新成功,Work_time更新失败.");}
if(rr=="1"){alert("仅Work_time更新成功,Break_time更新失败.");}
if(rr=="0"){alert("更新失败");}
    window.parent.SetCwinHeight();
    }
  }
xmlhttp.open("POST",url,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(args);
 }
</script>
OSTR;
$con->close();
require_once ('../common_foot.html');
?>
