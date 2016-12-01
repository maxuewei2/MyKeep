function delete_task(id){
    if(confirm('确定删除?')){
        var url="delete_task.php";
	    var args="id="+id;
	    postajax("",url,args);
	}
}
function back_done(id){
    var url="back_done_task.php";
	var args="id="+id;
	postajax_done("",url,args);
}
function check_done_done(id){
    if(this.checked=="checked"){
        this.checked="";
    }else{
        this.checked="checked";
        back_done(id);
    }
}
function postajax_done(id,url,args){
    var xmlhttp;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState==4 && xmlhttp.status==200){
            var rt=xmlhttp.responseText;
            if (rt=="wrong"){
                alert("删除失败");
                return;
            }
            else{
                location.reload(true);
            }
        }
    }
    xmlhttp.open("POST",url,true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(args);
}

