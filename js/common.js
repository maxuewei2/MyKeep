function get_lines_count(c){
    return c.split("\n").length;
}


function getElementLeft(element){
　　　　var actualLeft = element.offsetLeft;
　　　　var current = element.offsetParent;
　　　　while (current !== null){
        actualLeft += current.offsetLeft;
        current = current.offsetParent;
    }
　　　　return actualLeft;
}
function getElementTop(element){
　　　　var actualTop = element.offsetTop;
　　　　var current = element.offsetParent;
　　　　while (current !== null){
        actualTop += current.offsetTop;
　　　　　　  current = current.offsetParent;
    }
　　　　return actualTop;
}
function done(id,source){
    var url="task/done_task.php";
	var args="id="+id;
	postajax(source+'done',url,args,id);
}
function postajax(id,url,args,other){
    var xmlhttp;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            var rt=xmlhttp.responseText;
            handle(id,rt,other);
        }
    }
    xmlhttp.open("POST",url,true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(args);
}

function handle(id,rt,other){
    if(id=='select_content'){
        select_content_handle(rt);
    }
    if(id=='update'){
        update_handle(rt,other);
    }
    if(id=='taskdone'){
        task_done_handle(rt);
    }
    if(id=='timerdone'){
        timer_done_handle(rt,other);
    }
    if(id=='delete'){
        delete_handle(rt);
    }
    if(id=='backdone'){
        backdone_handle();
    }
    if(id=='add'){
        add_handle(rt);
    }
    if(id=='setting'){
        setting_handle(rt);
    }
}

