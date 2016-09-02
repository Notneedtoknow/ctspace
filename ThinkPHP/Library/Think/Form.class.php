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
     * 日期时间控件
     *
     * @param $name 控件name，id
     * @param $value 选中值
     * @param $isdatetime 是否显示时间
     * @param $loadjs 是否重复加载js，防止页面程序加载不规则导致的控件无法显示
     * @param $showweek 是否显示周，使用，true | false
     */
    public static function date($name, $value = '', $isdatetime = 0, $loadjs = 0, $showweek = 'true', $timesystem = 1, $minDate, $maxDate) {

        if($value == '0000-00-00 00:00:00') $value = '';
        $id = preg_match("/\[(.*)\]/", $name, $m) ? $m[1] : $name;
        if($isdatetime) {
            $size = 21;
            $format = '%Y-%m-%d %H:%M:%S';
            if($timesystem){
                $showsTime = 'true';
            } else {
                $showsTime = '12';
            }

        } else {
            $size = 10;
            $format = '%Y-%m-%d';
            $showsTime = 'false';
        }
        $str = '';
        $showdate = '';
        if($isdatetime){
            $showdate = ' HH:mm:ss';
        }
        if($maxDate!=''){
            $maxDate =",maxDate:'#F{\$dp.\$D(\\'".$maxDate."\\')}'";
        }
        if($minDate!=''){
            $minDate =",minDate:'#F{\$dp.\$D(\\'".$minDate."\\')}'";
        }
        $str .= '<input type="text"  name="'.$name.'" id="'.$id.'" onfocus="WdatePicker({dateFmt:\'yyyy-MM-dd'.$showdate.'\''.$minDate.$maxDate.'})" value="'.$value.'" size="'.$size.'" class="date" readonly>';
        return $str;
    }





































}