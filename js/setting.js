function submit_setting(){
 	var wtime=document.getElementById("work_time_input").value;
 	var btime=document.getElementById("break_time_input").value;
	if(wtime==""){
	    document.getElementById("infoout").innerHTML="work_time不能为空。";
	    return;
	}
    if(!(/^\d+$/.test(wtime))){
        document.getElementById("infoout").innerHTML="work_time请填入数字。";
        return;
    }
 	if(btime==""){
 	    document.getElementById("infoout").innerHTML="break_time不能为空。";
 	    return;
 	}
    if(!(/^\d+$/.test(btime))){
        document.getElementById("infoout").innerHTML="break_time请填入数字。";
        return;
    }
    var url="update_setting.php";
	var args="wtime="+wtime+"&btime="+btime;
	postajax("setting",url,args,"");
}
function setting_handle(rr){
    if(rr=="3"){
        alert("更新成功");
    }
    if(rr=="2"){
        alert("仅Break_time更新成功,Work_time更新失败.");
    }
    if(rr=="1"){
        alert("仅Work_time更新成功,Break_time更新失败.");
    }
    if(rr=="0"){
        alert("更新失败");
    }
}
