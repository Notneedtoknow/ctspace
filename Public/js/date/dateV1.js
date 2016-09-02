/**
 * Created by kangxin on 16-9-2.
 */
var div = "<div class='date_select_div'></div>";
var li = "<li class='date_select_li'></li>";
var weekend_arr = new Array('日','一','二','三','四','五','六');
var days_arr = new Array('31','28','31','30','31','30','31','31','30','31','30','31');
var time;
var year,month,date,weekend;//年月日周
var day_data = new Array();//当月显示的所有日子

$(document).ready(function(){
    $(document).bind('click',function(e){
        var event = e || window.event; //浏览器兼容性
        var elem = event.target || event.srcElement;
        while (elem) { //循环判断至跟节点，防止点击的是div子元素
            if (elem.className && elem.className=='date_select_div') {
                return;
            }
            if(elem.className == 'date'){
                return;
            }
            elem = elem.parentNode;
        }
        remove_div(); //点击的不是div或其子元素
    });

    $('.date').bind('click',function(){
        remove_div();
        load_css();

        time = new Date($(this).data('default') * 1000);
        year = time.getFullYear();
        month = time.getMonth() + 1;
        date = time.getDate();
        weekend = time.getDay();
        if(is_leap_year()){
            days_arr[1] = 29;
        }
        get_seven_days();

        $(this).after(div);
        for(var i=0;i<day_data.length;i++){
            $(".date_select_div").append(append_ul(i));
            if(i==0){
                li_to_ul($(".ul_"+i),weekend_arr);
            }else{
                li_to_ul($(".ul_"+i),day_data[i]);
            }
        }

    });


});

function get_seven_days(){
    var min_weekend = date%7;
    var last_days = days_arr[month - 2];//上个月的天数
    var now_days = days_arr[month - 1];//本月天数
    var first_day = last_days - (weekend + 1 - min_weekend) + 1;//日期控件现实的第一天
    var i, j, flag = 0;
    for(i=1;;i++){
        day_data[i] = new Array();
        for(j=0;j<7;j++){
            if(i==1&&j==0){
                day_data[i][j] = first_day;
            }else if(i==1&&day_data[i][j-1]==last_days){
                day_data[i][j] = 1;
            }else if(i>=4&&day_data[i][j-1]==now_days){
                day_data[i][j] = 1;
                flag = 1;
            }else if(j==0){
                day_data[i][j] = day_data[i-1][6] + 1;
            }else{
                day_data[i][j] = day_data[i][j-1] + 1;
            }
        }
        if(flag == 1){
            break;
        }
    }
}

//判断今年是否为闰年
function is_leap_year(){
    if(((year%4==0)&&(year%100!=0))||(year%400==0)){
        return true;
    }else{
        return false;
    }
}




//向div中添加ul
function append_ul(a){
    return "<ul class='date_select_ul ul_" + a + "'></ul>";
}
//向ul中添加li
function li_to_ul(obj,array){
    for ( var i in array){
        var li = "<li>" + array[i] + "</li>";
        obj.append(li);
    }
}
//移除日期控件
function remove_div(){
    $(".date_select_div").remove();
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
        href: localhostPaht + "/Public/css/date/dateV1.css"
    }).appendTo("head");
}
