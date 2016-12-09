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



function check_done(id){
    if(this.checked=="checked"){
        this.checked="";
    }else{
        this.checked="checked";
        done(id,'task');
    }
}
function task_done_handle(rt){
    if(rt=="success"){location.reload(true);}
    else{alert("失败");}
}
function submit(){
	var content=document.getElementById("new_task_input").value;
 	if(content==''){alert('不能为空');return;}
    //var reg=new RegExp("\\n","g");
    //var content_html=content.replace(reg,'<br>');
    var url="task/add_task.php";
	var args="content="+content;
	postajax("add",url,args,"");
}
function add_handle(rt){
    if(rt=="wrong"){alert("添加失败");}
    else{location.reload(true);}
}
