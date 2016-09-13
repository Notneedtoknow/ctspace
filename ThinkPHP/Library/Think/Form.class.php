<?php
/**
 * Created by PhpStorm.
 * User: kangxin
 * Date: 2016-08-11
 * Time: 09:46
 */
namespace Think;
/**
 * form表单类
 */

class Form{


    /**
     * @param $value "select 显示的内容"
     * @param $name "select name值"
     * @param null $default "select 默认值"
     * @param bool|false $value2 "若$value2为true 则$value的'键'为其value值 value的'值'为其显示值"
     * @param null $onChange "select onchange 值"
     * @return string
     */
    public function select($value,$name,$default=null,$value2=false,$onChange=null){
        if(!empty($onChange)){
            $data = "<select name=\"info[$name]\" onchange=\"$onChange\">";
        }else{
            $data = "<select name=\"info[$name]\">";
        }
        foreach($value as $k => $v){
            if(empty($default)){
                $data .= "<option";
            }else if($value2==true&&$default==$k){
                $data .= "<option selected=\"selected\"";
            }else if($value2==false&&$default==$v){
                $data .= "<option selected=\"selected\"";
            }else{
                $data .= "<option";
            }

            if($value2==true){
                $data .= " value=\"$k\">$v</option>";
            }else{
                $data .= " value=\"$v\">$v</option>";
            }
        }
        $data .= "</select>";
        return $data;
    }

    /**
     * @param $value "radio 显示的内容"
     * @param $name "radio name值"
     * @param null $default "radio 默认值"
     * @param bool|false $value2 "若$value2为true 则$value的'键'为其value值 value的'值'为其显示值"
     * @return string
     */
    public function radio($value,$name,$default=null,$value2=false){
        $data = '';
        if(empty($value)||empty($name)){
            return '';
        }
        foreach($value as $k => $v){
            if($value2){
                $data .= "<input type='radio' name='info[".$name."]' value='".$k."'";
                if($default==$k){
                    $data .= " checked";
                }
            }else{
                $data = "<input type='radio' name='info[".$name."]' value='".$v."'";
                if($default==$v){
                    $data .= " checked";
                }
            }
            $data .= " style='width:15px;height:15px'>".$v.'&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        return $data;
    }

    /**
     * 日期控件V2版  调用dateV2.js
     * @param $time '默认时间 时间戳'
     * @param $name '表单提交name'
     * @param bool $is_second '是否精确到秒'
     * @return string
     */
    public function dateV2($time,$name,$is_second=false){
        $time_date = date('Y:m:d:H:i:s',$time);
        $time_date = explode(':',$time_date);
        $time = date('Y-m-d H:i:s',$time);
        $data_str = '<div class="date_select">';
        $data_str .= '<input type="text" class="info_date" name="'.$name.'" value="'.$time.'" hidden>';
        $data_str .= '<ul class="date">';
        $data_str .= '<li class="data date_year">'.intval($time_date[0]).'</li>';
        $data_str .= '<li class="middle">-</li>';
        $data_str .= '<li class="data date_month">'.intval($time_date[1]).'</li>';
        $data_str .= '<li class="middle">-</li>';
        $data_str .= '<li class="data date_day">'.intval($time_date[2]).'</li>';
        if($is_second){
            $data_str .= '<li class="middle"></li>';
            $data_str .= '<li class="data date_hour">'.intval($time_date[3]).'</li>';
            $data_str .= '<li class="middle">:</li>';
            $data_str .= '<li class="data date_minute">'.intval($time_date[4]).'</li>';
            $data_str .= '<li class="middle">:</li>';
            $data_str .= '<li class="data date_second">'.intval($time_date[5]).'</li>';
        }
        $data_str .= '</ul>';
        $data_str .= '</div>';
        return $data_str;
    }





































}