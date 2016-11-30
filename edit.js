function change_area_rows(id) {
    var eid = "edit_area" + id;
    var e = document.getElementById(eid);
    var c = e.value;
    var line_c = get_lines_count(c);
    e.setAttribute("rows", line_c);
}
function set_btns(id, i) {
    var eid = "edit_area" + id;
    var e = document.getElementById(eid);
    if (i == 1) {
        change_area_rows(id);
        e.disabled = "disabled";
    } else {
        e.disabled = "";
        e.onkeyup = function s() {
            change_area_rows(id);
        }
    }

    var bid = "edit_btn" + id;
    var b = document.getElementById(bid);
    if (i == 1) {
        b.style.display = "block";
    } else {
        b.style.display = "none";
    }

    var bokid = "edit_ok" + id;
    var bok = document.getElementById(bokid);
    if (i == 1) {
        bok.style.display = "none";
    } else {
        bok.style.display = "block";
    }

    var bcid = "edit_cancle" + id;
    var bc = document.getElementById(bcid);
    if (i == 1) {
        bc.style.display = "none";
    } else {
        bc.style.display = "block";
    }
}
function add_backup_area(id) {
    var did = "todo_content_div" + id;
    var d = document.getElementById(did);
    var eb = document.createElement("textarea");
    var eid = "edit_area" + id;
    var e = document.getElementById(eid);
    eb.setAttribute("id", "edit_area_backup" + id);
    eb.setAttribute("class", "edit_area_backup");
    eb.value = e.value;
    d.appendChild(eb);
}

function remove_backup_area(id) {
    var did = "todo_content_div" + id;
    var d = document.getElementById(did);
    var ebid = "edit_area_backup" + id;
    var eb = document.getElementById(ebid);
    d.removeChild(eb);
}

function begin_edit(id) {
    add_backup_area(id);
    set_btns(id, 2);
}
function edit_cancle(id) {
    var ebid = "edit_area_backup" + id;
    var eb = document.getElementById(ebid);
    var eid = "edit_area" + id;
    var e = document.getElementById(eid);
    e.value = eb.value;
    remove_backup_area(id);
    set_btns(id, 1);
}

function edit_success(id) {
    remove_backup_area(id);
    set_btns(id, 1);
}

function update(id, content) {
    var url = "update_todo.php";
    var args = "id=" + id + "&content=" + content;
    postajax(id, url, args);
}

function edit_done(id) {
    var eid = "edit_area" + id;
    var e = document.getElementById(eid);
    var content = e.value;
    update(id, content);
}
