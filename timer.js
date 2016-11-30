
//var canvas_element_left = canvas_element.getBoundingClientRect().left + document.documentElement.scrollLeft;
//var top = self.getBoundingClientRect().top + document.documentElement.scrollTop;
//var canvas_element_top =canvas_element.getBoundingClientRect().top+document.documentElement.scrollTop;
//var cw=document.getElementById('timer_canvas').offsetWidth;
//var ch=document.getElementById('timer_canvas').offsetHeight;
var cx=400;
var cy=400;
var r=100;

var w=5;
var time=1*60;
var ctime=0;

function timer(){
var canvas_element = document.getElementById("timer_canvas");
//var canvas_element_left = getElementLeft(canvas_element);
//var canvas_element_top =getElementTop(canvas_element);
var cw=document.getElementById('timer_canvas').offsetWidth;
var ch=document.getElementById('timer_canvas').offsetHeight;
cx=cw/2;
cy=ch/2;
//alert(cx+","+cy);
r=cw>ch?ch:cw;
r=r*2/6;

//canvas_element.attr("width", cw);
//canvas_element.attr("height", ch);
canvas_element.setAttribute("width", cw);
canvas_element.setAttribute("height", ch);

draw22("timer_canvas");
ctime=ctime+1;
ctime%=time;
setTimeout("timer()", 1000);
}
//扇形
CanvasRenderingContext2D.prototype.sector = function (x, y, radius, sDeg, eDeg) {
// 初始保存
this.save();
// 位移到目标点
this.translate(x, y);
this.beginPath();
// 画出圆弧
this.arc(0,0,radius,sDeg, eDeg);
// 再次保存以备旋转
this.save();
// 旋转至起始角度
this.rotate(eDeg);
// 移动到终点，准备连接终点与圆心
this.moveTo(radius,0);
// 连接到圆心
this.lineTo(0,0);
// 还原
this.restore();
// 旋转至起点角度
this.rotate(sDeg);
// 从圆心连接到起点
this.lineTo(radius,0);
this.closePath();
// 还原到最初保存的状态
this.restore();
return this;
}
function draw22(id) {
    var canvas = document.getElementById(id)
    if (canvas == null)
                 return false;

             var context = canvas.getContext("2d");

             context.beginPath();
             context.arc(cx, cy, r, 0, Math.PI *2 , true);
             //不关闭路径路径会一直保留下去，当然也可以利用这个特点做出意想不到的效果
             context.closePath();
             context.fillStyle = 'rgba(255,255,255,1)';
             context.fill();
//alert(cx+","+cy+","+r+","+w);
//alert(time+","+ctime);
             context.fillStyle = 'rgba(50,50,50,1)';
             var x=ctime/time;
             context.sector(cx,cy,r+0.2,-Math.PI/2,-Math.PI/2+Math.PI*2*x).fill();

             context.beginPath();
             context.arc(cx, cy, r-w, 0, Math.PI *2 , true);
             //不关闭路径路径会一直保留下去，当然也可以利用这个特点做出意想不到的效果
             context.closePath();
             context.fillStyle = 'rgba(232,232,232,1)';
             context.fill();

             context.fillStyle = "#000";
             context.font = "40px sans-serif";
             context.textBaseline = 'top';
                var m=parseInt((time-ctime)/60);
                var s=(time-ctime)%60;

             //填充字符串
             var txt=m.toString()+":"+s.toString();
             var length=context.measureText(txt);
             context.fillText(txt, cx-length.width/2, cy-40/2);
         }
timer();
