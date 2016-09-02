/**
 * Created by kangxin on 2016-08-03.
 */

function get_menu_son(menu_id,obj) {
    //改变点击背景色
    var menu = event.srcElement;
    var arr = document.getElementById("ul").getElementsByTagName("li");
    for (var i = 0; i < arr.length; i++) {
        var a = arr[i];
        a.style.background = "#9999cc";
    }
    obj.style.background = "#996699";

    var father = document.getElementById('menu_level_2');
    var all = father.childNodes;
    for(var i=0;i<all.length;i++){
        if(all[i].nodeName == "#text" && !/\s/.test(all.nodeValue)) {
            father.removeChild(all[i]);
        }else{
            all[i].style.display = 'none';
        }
    }
    var left = document.getElementById("father_menu_id_"+menu_id);
    left.style.display = '';
}

function get_menu_son_2(menu_id,obj){
    //改变点击背景色
    var arr = document.getElementById("menu_level_2").getElementsByTagName("li");
    for (var i = 0; i < arr.length; i++) {
        var a = arr[i];
        a.style.background = "#9999cc";
    }
    obj.style.background = "#996699";

    var left = document.getElementsByName("father_menu_id_"+menu_id);
    for(var i=0;i<left.length;i++)
    {
        if(left[i].style.display == ''){
            left[i].style.display = 'none';
        }else{
            left[i].style.display = '';
        }
    }
}

function get_menu_son_3(url,obj){
    //改变点击背景色
    var arr = document.getElementById("menu_level_2").getElementsByTagName("li");
    for (var i = 0; i < arr.length; i++) {
        var a = arr[i];
        a.style.background = "#9999cc";
    }
    obj.style.background = "#996699";

    get_tpl(url);
}

function get_tpl(url){
    window.frames['main_content'].location.href = url;
}

function get_tpl_inside(url){
    location.assign(url);
}

function level_on_changed(obj){
    var select = obj.value;
    var menu_c = document.getElementById('menu_c');
    var menu_a = document.getElementById('menu_a');
    if(select==1){
        menu_c.style.display = 'none';
        menu_a.style.display = 'none';
    }else if(select==2){
        menu_c.style.display = '';
        menu_a.style.display = 'none';
    }else{
        menu_c.style.display = '';
        menu_a.style.display = '';
    }
}

function level_on_load(level){
    var menu_c = document.getElementById('menu_c');
    var menu_a = document.getElementById('menu_a');
    if(level==1){
        menu_c.style.display = 'none';
        menu_a.style.display = 'none';
    }else if(level==2){
        menu_c.style.display = '';
        menu_a.style.display = 'none';
    }else{
        menu_c.style.display = '';
        menu_a.style.display = '';
    }
}

