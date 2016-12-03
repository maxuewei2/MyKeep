function delete_task(id){
    if(confirm('确定删除?')){
        var url="delete_task.php";
	    var args="id="+id;
	    postajax("delete",url,args,"");
	}
}
function delete_handle(rt){
    if(rt=="wrong"){alert("删除失败");}
    else{location.reload(true);}
}
function back_done(id){
    var url="back_done_task.php";
	var args="id="+id;
	postajax("backdone",url,args,"");
}
function backdone_handle(rt){
    if(rt=="wrong"){alert("删除失败");}
    else{location.reload(true);}
}
function check_done_done(id){
    if(this.checked=="checked"){
        this.checked="";
    }else{
        this.checked="checked";
        back_done(id);
    }
}

