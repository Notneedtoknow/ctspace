/**
 * Created by kangxin on 16-9-2.
 */
var div = "<div class='date_select_div'></div>";
var div_head = "<div class='date_select_div_head'></div>"
var div_select_year = "<div class='date_select_div_head_year'></div>"
var div_body = "<div class='date_select_div_body'></div>"
var div_footer = "<div class='date_select_div_footer'></div>"
var li = "<li class='date_select_li'></li>";
var weekend_arr = new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
var month_arr = new Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
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
                open_new_select(event.target.className);
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
        month = time.getMonth();
        date = time.getDate();
        weekend = time.getDay();
        if(is_leap_year()){
            days_arr[1] = 29;
        }
        get_seven_days();

        $(this).after(div);//总体控件
        var date_select_div = $(".date_select_div");
        date_select_div.append(div_head);
        date_select_div.append(div_body);
        date_select_div.append(div_footer);
        //年月选择框
        var date_select_div_head = $(".date_select_div_head");
        date_select_div_head.append(return_head_str('left',year));
        date_select_div_head.append(return_head_str('right',month_arr[month]));
        //日期选择框
        for(var i=0;i<day_data.length;i++){
            $(".date_select_div_body").append(append_ul(i));
            if(i==0){
                li_to_ul($(".ul_"+i),weekend_arr,'');
            }else if(i==1){
                li_to_ul($(".ul_"+i),day_data[i],'head');
            }else if(i>=4){
                li_to_ul($(".ul_"+i),day_data[i],'footer');
            }else{
                li_to_ul($(".ul_"+i),day_data[i],'');
            }
        }

    });
});

function open_new_select(className){
    if(className=='date_select_div_head_left'){
        $('.date_select_div_head_left').after(div_select_year);
        var date_select_div_head_year = $('.date_select_div_head_year');
        for(var i=0;i<5;i++){
            var select_year = year + i - 2;
            date_select_div_head_year.append(
                "<div class='date_select_div_head_year_"+i+"' style='background-color: #996699;border: 1px white solid;height: 35px;'>"+select_year+"</div>"
            );
        }
    }
}

function date_manage(year,month,day){
    remove_div();
}

function get_seven_days(){
    var min_weekend = date%7;
    var last_days = days_arr[month-1];//上个月的天数
    var now_days = days_arr[month];//本月天数
    var first_day = last_days - (weekend + 1 - min_weekend) + 1;//日期控件显示的第一天
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



//---------head---------
function return_head_str(align,value){
    return "<div class='date_select_div_head_" +align + "'>" + value + "</div>"
}

//---------body---------
//向div中添加ul
function append_ul(a){
    return "<ul class='date_select_ul ul_" + a + "'></ul>";
}
//向ul中添加li
function li_to_ul(obj,array,flag){
    for ( var i in array){
        if((flag=='head'&&array[i]>20)||(flag=='footer'&&array[i]<10)){
            var li = "<li class='not_this_month'>" + array[i] + "</li>";
        }else{
            var li = "<li>" + array[i] + "</li>";
        }
        obj.append(li);
    }
}
//移除日期控件
function remove_div(){
    $(".date_select_div").remove();
}
//---------footer---------

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
