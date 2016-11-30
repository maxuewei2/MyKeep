
    //基本函数*2
    var addHandler = window.addEventListener?
    function(elem,event,handler){elem.addEventListener(event,handler);}:
    function(elem,event,handler){elem.attachEvent("on"+event,handler);};

    var $ = function(id){return document.getElementById(id);}


    function autoTextArea(elemid){
        //新建一个textarea用户计算高度
        if(!$("_textareacopy")){
            var t = document.createElement("textarea");
            t.id="_textareacopy";
            t.cols="50";
            t.rows="5";
            t.style.position="absolute";
            t.style.left="-9999px";
            document.body.appendChild(t);
        }
        function change(){
            $("_textareacopy").value= $(elemid).value;
            $(elemid).style.height= $("_textareacopy").scrollHeight+$("_textareacopy").style.height+"px";
        }
        addHandler($("new_task_input"),"propertychange",change);//for IE
        addHandler($("new_task_input"),"input",change);// for !IE
        $(elemid).style.overflow="hidden";//一处隐藏，必须的。
        $(elemid).style.resize="none";//去掉textarea能拖拽放大/缩小高度/宽度功能
    }

    addHandler(window,"load",function(){
        autoTextArea("new_task_input");
    });




function done(id){
    var url="../task/done_task.php";
	var args="id="+id;
	postajax("infoout",url,args);
}
function check_done(id){
    if(this.checked=="checked"){
        this.checked="";
    }else{
        this.checked="checked";
        done(id);
    }
}



function error_handle(id){
if(/^\d+$/.test(id)){
alert("更新失败"+id);
}
else{
    document.getElementById(id).innerHTML="失败";
}
}

function success_handle(id){
if(/^\d+$/.test(id)){
edit_success(id);
}
else{
location.reload(true);
}
}


function postajax(id,url,args){
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
    var rt=xmlhttp.responseText;
    if (rt=="wrong"){

error_handle(id);
    }
    else{

success_handle(id);
    }
    }
  }
xmlhttp.open("POST",url,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(args);
 }

 function submit(){

	var content=document.getElementById("new_task_input").value;
 	if(content==''){document.getElementById("info_out").innerHTML="不能为空。";return;}
// 	var reg=new RegExp("\\n","g");
//    var content_html=content.replace(reg,'<br>');
    var url="add_task.php";
	var args="content="+content;

	postajax("info_out",url,args);

 }
