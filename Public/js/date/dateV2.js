var div = "<div class='popUp'></div>";
var ul = "<ul class='popUpUl'></ul>";

var year,month,day,hour,minute,second;
var mouseWheel = document.all?"mousewheel":"DOMMouseScroll";
var year_max = 100;//显示传入年份的前后一百年
var arr_month = new Array(1,2,3,4,5,6,7,8,9,10,11,12);

$(document).ready(function(){
    //load_css();
    $(document).bind('click',function(e){
        var event = e || window.event; //浏览器兼容性
        var elem = event.target || event.srcElement;
        while (elem) { //循环判断至跟节点，防止点击的是div子元素
            if (elem.className && elem.className=='date_select') {
                date_manage(event.target.className);
                return;
            }
            elem = elem.parentNode;
        }
        remove_popUp();
    });
});

function date_manage(elem){
    remove_popUp();
    get_time();//从页面中获取时间
    var arr = elem.split(" ");
    var pop_up_ul = load_div_ul(arr[1]);
    switch(arr[1]){
        case 'date_year':{
            //计算需要显示的年份
            var arr_year = new Array();
            for(var i=0;i<year_max;i++){
                arr_year[i] = year - year_max/2 + i;
                pop_up_ul.append(append_li_to_ul(arr_year[i]));
            }
            //alert($('#'+year)[0].scrollHeight);
            var height_li = $('#'+year)[0].scrollHeight;
            pop_up_ul.scrollTop((height_li + 4) * (year_max/2-3));
        }break;
        case 'date_month':{
            for(var i=0;i<12;i++){

            }
        }
    }

}


function load_div_ul(arr){
    $('.'+arr).after(div);
    $('.popUp').append(ul);
    return $('.popUpUl');
}

function append_li_to_ul(num){
    return "<li id='" + num + "'>" + num + "</li>";
}

//从页面中获得时间
function get_time(){
    year = $('.date_year').text();
    month = $('.date_month').text();
    day = $('.date_day').text();
    hour = $('.date_hour').text();
    minute = $('.date_minute').text();
    second = $('.date_second').text();
}
//移除控件
function remove_popUp(){
    $('.popUp').remove();
}
//加载css样式文件
function load_css(){
    //获取当前网址，如： http://localhost:8083/uimcardprj/share/meun.jsp
    var curWwwPath=window.document.location.href;
    //获取主机地址之后的目录，如： uimcardprj/share/meun.jsp
    var pathName=window.document.location.pathname;
    var pos=curWwwPath.indexOf(pathName);
    //获取主机地址，如： http://localhost:8083
    var localhostPaht=curWwwPath.substring(0,pos);
    //获取带"/"的项目名，如：/uimcardprj
    var projectName=pathName.substring(0,pathName.substr(1).indexOf('/')+1);

    $("<link>").attr({
        rel: "stylesheet",
        type: "text/css",
        href: localhostPaht + "/Public/css/date/dateV2.css"
    }).appendTo("head");
}