<?php
include 'funs.php';
$c=getDatabaseConnect($con);
if($c==-1){
echo "Error.Can't connect the database.";
exit;
}

echo_common_head();
echo<<<CSS
<style>
.setting_input{
background-color:#fff;
color:#444;
padding:10px 20px;
border:0;
margin:5px 10px;
}
.setting_table th{
text-align:right;
}
</style>
CSS;
echo <<<HTMLSTR
<table class="setting_table" border="0">

<tr>
<th>work_time:</th>
<td><input class="setting_input" type="text" name="wtime" id="work_time_input" required="required"></td>
</tr>

<tr>
<th>break_time:</th>
<td><input class="setting_input" type="text" name="btime" id="break_time_input" required="required"></td>
</tr>

<tr><td></td><td><button class="setting_input" type="button"  id="submit_btn" onclick="submit_setting()">保存更改</button></td></tr>

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
    document.getElementById(id).innerHTML=xmlhttp.responseText;
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
echo_common_foot();
?>
