var work_time_str=document.getElementById("work_time_setting_input").value;
var break_time_str=document.getElementById("break_time_setting_input").value;
var work_time=parseInt(work_time_str);
var break_time=parseInt(break_time_str);
var cx = 400;
var cy = 400;
var r = 100;
var w = 5;
var time = work_time * 60;
var ctime = 0;
var us_count = 0;
var state="stop";
var is_break=false;

function fresh() {
    var canvas_element = document.getElementById("timer_canvas");
    var cw = document.getElementById('timer_canvas').offsetWidth;
    var ch = document.getElementById('timer_canvas').offsetHeight;
    cx = cw / 2;
    cy = ch / 2;
    r = cw > ch ? ch: cw;
    r = r * 2 / 6;
    canvas_element.setAttribute("width", cw);
    canvas_element.setAttribute("height", ch);
    draw22("timer_canvas");
    if(state=="pause" ||state=="stop"){
        return ;
    }
    us_count++;
    if(us_count>=20){
        us_count=0;
        ctime = ctime + 1;
        if(ctime >= time){
            check_break();
        }
    }
}
//扇形
CanvasRenderingContext2D.prototype.sector = function(x, y, radius, sDeg, eDeg) {
    // 初始保存
    this.save();
    // 位移到目标点
    this.translate(x, y);
    this.beginPath();
    // 画出圆弧
    this.arc(0, 0, radius, sDeg, eDeg);
    // 再次保存以备旋转
    this.save();
    // 旋转至起始角度
    this.rotate(eDeg);
    // 移动到终点，准备连接终点与圆心
    this.moveTo(radius, 0);
    // 连接到圆心
    this.lineTo(0, 0);
    // 还原
    this.restore();
    // 旋转至起点角度
    this.rotate(sDeg);
    // 从圆心连接到起点
    this.lineTo(radius, 0);
    this.closePath();
    // 还原到最初保存的状态
    this.restore();
    return this;
}
function draw22(id) {
    var canvas = document.getElementById(id);
    if (canvas == null) return false;
    var context = canvas.getContext("2d");
    context.beginPath();
    context.arc(cx, cy, r, 0, Math.PI * 2, true);
    //不关闭路径路径会一直保留下去，当然也可以利用这个特点做出意想不到的效果
    context.closePath();
    context.fillStyle = 'rgba(255,255,255,1)';
    context.fill();
    context.fillStyle = 'rgba(50,50,50,1)';
    var x = ctime / time;
    context.sector(cx, cy, r + 0.2, -Math.PI / 2, -Math.PI / 2 + Math.PI * 2 * x).fill();
    context.beginPath();
    context.arc(cx, cy, r - w, 0, Math.PI * 2, true);
    //不关闭路径路径会一直保留下去，当然也可以利用这个特点做出意想不到的效果
    context.closePath();
    context.fillStyle = 'rgba(232,232,232,1)';
    context.fill();
    context.fillStyle = "#000";
    context.font = "40px sans-serif";
    context.textBaseline = 'top';
    var m = parseInt((time - ctime) / 60);
    var s = (time - ctime) % 60;
    //填充字符串
    var txt = m.toString() + ":" + s.toString();
    var length = context.measureText(txt);
    context.fillText(txt, cx - length.width / 2, cy - 40 / 2);
}
function start_timer(){
    var t1 = window.setInterval("fresh()",50);
}
function stop_timer(){
    window.clearInterval(t1);
}
function stop(st){
    state=st;
    if(st=="stop"){
        var s=document.getElementById("task_select");
        s.disabled="";
        ctime=0;
        time=work_time*60;
        is_break=false;
    }
    var b=document.getElementById("timer_start_btn");
    b.innerHTML="Start";
}
function on_done_btn(){
    stop("stop");
    var s=document.getElementById("task_select");
    var id=s.value;
    done(id);
    var o=document.getElementById("option"+id);
    s.removeChild(o);
}
function start_doing() {
    state="doing";
    var s=document.getElementById("task_select");
    s.disabled="disabled";
    var b=document.getElementById("timer_start_btn");
    b.innerHTML="Pause";
}
function on_start_pause_btn() {
    if(state=="stop"||state=="pause"){
        start_doing();
    }
    else if(state=="doing"){
        stop("pause");
    }
}
function check_break(){
    if(state=="doing"){
        if(is_break){
            is_break=false;
            ctime=0;
            time=work_time*60;
        }else{
            is_break=true;
            ctime=0;
            time=break_time*60;
        }
    }
}
function on_skip_btn() {
    check_break();
}
function on_stop_btn() {
    stop("stop");
}
start_timer();


var select_id=-1;
var show_div=0;
function show_select_content(){
    var s=document.getElementById("task_select");
    s.style.backgroundColor="#fafafa";
    var id=s.value;
    //var v=document.getElementById("select_content_input");
    if(id!=select_id){
        select_id=id;
        var url="get_content.php";
	    var args="id="+id;
        postajax_timer("",url,args);
        var d=document.getElementById("select_content_div");
    }else{

    }
    show_select_content_1();
    setTimeout(hide_select_content,"500");
}
function show_select_content_1(){
    var s=document.getElementById("task_select");
    var sl=getElementLeft(s)+s.offsetLeft;
    var st=getElementTop(s)+s.offsetTop/2;
    var dd=document.getElementById("select_content_div");
    dd.style.position="absolute";
    dd.style.left=sl+"px";
    dd.style.top=st+"px";
    dd.style.display="block";
}
function out_select(){
    var s=document.getElementById("task_select");
    s.style.backgroundColor="#e8e8e8";
}
function on_area(){
    show_div=2;
}
function hide_select_content(){
    if(show_div>0)return;
    hide_select_content_1();
}
function hide_select_content_1(){
    show_div=0;
    document.getElementById("select_content_div").style.display="none";
}
function postajax_timer(id,url,args){
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
    var a=document.getElementById("select_content_area");
    a.value=rt;
    var line_c = get_lines_count(rt);
    if(line_c>10)line_c=10;
    a.setAttribute("rows", line_c);
//    var d=document.getElementById("select_content_div");
//    var reg=new RegExp('\\n',"g");
//    var cont=rt.replace(reg,'<br/>');
//    d.innerHTML=cont;
    }
  }
xmlhttp.open("POST",url,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(args);
 }
