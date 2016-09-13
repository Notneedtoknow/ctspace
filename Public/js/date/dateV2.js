var div = "<div class='popUp'></div>";
var ul = "<ul class='popUpUl'></ul>";

var year,month,day,hour,minute,second;
var year_max = 100;//显示传入年份的前后一百年
var arr_month = new Array('31','28','31','30','31','30','31','31','30','31','30','31');

$(document).ready(function(){
    //load_css();
    $(document).bind('click',function(e){
        var event = e || window.event; //浏览器兼容性
        var elem = event.target || event.srcElement;
        while (elem) { //循环判断至跟节点，防止点击的是div子元素
            if (elem.className && elem.className=='popUp'){
                date_select(event.target.id);
                return;
            }
            if (elem.className && elem.className=='date_select') {
                return;
            }
            elem = elem.parentNode;
        }
        remove_popUp();
    });
    $('.data').click(function(){
        remove_popUp();
        $(this).parent().addClass('selected');
        get_time();//从页面中获取时间
        $(this).after(div);
        $('.popUp').append(ul);
        var arr = $(this).attr('class');
        arr = arr.split(" ")[1];
        date_manage(arr);
    });
});

function date_manage(arr){
    var pop_up_ul = $('.popUpUl');
    var height_li;
    switch(arr){
        case 'date_year':{
            //计算需要显示的年份
            var arr_year = 0;
            for(var i=0;i<year_max;i++){
                arr_year = year - year_max/2 + i;
                pop_up_ul.append(append_li_to_ul(arr_year));
            }
            height_li = $('#'+year)[0].scrollHeight;
            pop_up_ul.scrollTop((height_li + 4) * (year_max/2-3));
        }break;
        case 'date_month':{
            $('.popUp').css('left','90px');
            for(var i=0;i<12;i++){
                pop_up_ul.append(append_li_to_ul(i+1));
            }
            height_li = $('#'+month)[0].scrollHeight;
            pop_up_ul.scrollTop((height_li + 4) * (month-4));
        }break;
        case 'date_day':{
            $('.popUp').css('left','180px');
            for(var i=1;i<=arr_month[month-1];i++){
                pop_up_ul.append(append_li_to_ul(i));
            }
            height_li = $('#'+day)[0].scrollHeight;
            pop_up_ul.scrollTop((height_li + 4) * (day-4));
        }break;
        case 'date_hour':{
            $('.popUp').css('left','270px');
            for(var i=0;i<24;i++){
                pop_up_ul.append(append_li_to_ul(i));
            }
            height_li = $('#'+hour)[0].scrollHeight;
            pop_up_ul.scrollTop((height_li + 4) * (hour-3));
        }break;
        case 'date_minute':{
            $('.popUp').css('left','360px');
            for(var i=0;i<60;i++){
                pop_up_ul.append(append_li_to_ul(i));
            }
            height_li = $('#'+minute)[0].scrollHeight;
            pop_up_ul.scrollTop((height_li + 4) * (minute-3));
        }break;
        case 'date_second':{
            $('.popUp').css('left','450px');
            for(var i=0;i<60;i++){
                pop_up_ul.append(append_li_to_ul(i));
            }
            height_li = $('#'+second)[0].scrollHeight;
            pop_up_ul.scrollTop((height_li + 4) * (second-3));
        }break;
    }
}

function date_select(elem){
    var prev_elem = $('.selected #'+elem).parent().parent().prev();
    var arr = prev_elem.attr('class');
    arr = arr.split(" ");
    arr = arr[1];
    $('.selected .'+arr).text(elem);
    get_time();
    remove_popUp();
}

function append_li_to_ul(num){
    return "<li id='" + num + "'>" + num + "</li>";
}

//从页面中获得时间
function get_time(obj){
    year = $('.selected .date_year').text();
    month = $('.selected .date_month').text();
    day = check_year_month_day(obj);
    hour = $('.selected .date_hour').text();
    minute = $('.selected .date_minute').text();
    second = $('.selected .date_second').text();

    var time = year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second;
    $('.selected').prev().val(time);
}
function check_year_month_day(obj){
    var date_day = $('.selected .date_day');
    get_this_month();
    if(date_day.text()>arr_month[month-1]){
        date_day.text(arr_month[month-1]);
    }
    return date_day.text();
}
//获得当月的天数
function get_this_month(){
    if(is_leap_year()){
        arr_month[1] = 29;
    }else{
        arr_month[1] = 28;
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
//移除控件
function remove_popUp(){
    $('.popUp').remove();
    $('.selected').removeClass('selected');
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