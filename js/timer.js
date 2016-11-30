//var canvas_element_left = canvas_element.getBoundingClientRect().left + document.documentElement.scrollLeft;
//var top = self.getBoundingClientRect().top + document.documentElement.scrollTop;
//var canvas_element_top =canvas_element.getBoundingClientRect().top+document.documentElement.scrollTop;
//var cw=document.getElementById('timer_canvas').offsetWidth;
//var ch=document.getElementById('timer_canvas').offsetHeight;
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
    //var canvas_element_left = getElementLeft(canvas_element);
    //var canvas_element_top =getElementTop(canvas_element);
    var cw = document.getElementById('timer_canvas').offsetWidth;
    var ch = document.getElementById('timer_canvas').offsetHeight;
    cx = cw / 2;
    cy = ch / 2;
    //alert(cx+","+cy);
    r = cw > ch ? ch: cw;
    r = r * 2 / 6;

    //canvas_element.attr("width", cw);
    //canvas_element.attr("height", ch);
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
    //alert(cx+","+cy+","+r+","+w);
    //alert(time+","+ctime);
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
