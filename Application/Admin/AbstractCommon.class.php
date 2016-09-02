<?php
/**
 * Created by PhpStorm.
 * User: kangxin
 * Date: 2016-07-27
 * Time: 16:52
 */

/**
 * 后台管理抽象类
 */
namespace Admin;
use Think\Controller;
class AbstractCommon extends Controller {
    protected $login_status,$user_info,$user_id;
    protected $requestData;
    protected $header,$footer;

    public function __construct(){
        parent::__construct();

        //检查用户是否处于登陆状态
        $this->check_login_status();
        //32位随机字符串作为标识
        $RequestId = $this->createRequestId();
        $_REQUEST['RequestId'] = $RequestId;

        //给通用模板文件找寻路径
        $this->requestData['header'] = $this->commonTemplate('header_admin');
        //获得菜单
        $this->requestData['menu_header'] = $this->getMenuAll(true,false,true);
        foreach($this->requestData['menu_header'] as $value){
            $this->requestData['menu_left'][$value['menuid']] = $this->getLeftMenu($value['menuid']);
        }
        //管理员级别
        $this->admin_level = array(0=>'万能管理员',1=>'超级管理员',2=>'管理员',3=>'发布员');
    }



    /**
     * 生成RequestId
     */
    private function createRequestId()
    {
        $rand = md5(time() . mt_rand(0, 1000));
        return $rand;
    }

    /**
     * 返回模板文件路径 针对于后台
     * @param $filename
     * @param string $suffix
     * @return string
     */
    public function commonTemplate($filename,$suffix = 'html'){
        if(empty($filename)){
            $this->error('缺少必要参数');
        }
        if($suffix == 'tpl'){
            return THINK_PATH.'Tpl/Common/'.$filename.'.tpl.php';
        }else{
            return THINK_PATH.'Tpl/Common/'.$filename.'.html';
        }
    }

    /**
     * 获得某一级别的所有菜单
     * @param bool|false $one 若为true 则获得一级菜单
     * @param bool|false $two 若为true 则获得一级二级菜单
     * @param bool|false $trash 若为true 则查找时考虑获得的菜单为trash=0
     * @return mixed
     */
    public function getMenuAll($one = false,$two = false,$trash = false){
        $menu = D('menu','Model');
        if($one){
            if($trash){
                return $menu->where("level = 1 AND trash = '0'")->order('sort ASC')->select();
            }else{
                return $menu->where("level = 1")->order('sort ASC')->select();
            }
        }else if($two){
            if($trash){
                return $menu->where("level <> 3 AND trash = '0'")->order('sort ASC')->select();
            }else{
                return $menu->where("level <> 3")->order('sort ASC')->select();
            }
        }
    }

    /**
     * 根据id获取子菜单列表
     * @param $father '父级菜单id'
     * @param bool|false $trash 若为true 则查找时考虑获得的菜单为trash=0
     * @return mixed
     */
    public function getSonMenu($father,$trash = false){
        $menu = D('menu','Model');
        if($trash){
            return $menu->where("father = ".$father." AND trash = '0'")->order('sort ASC')->select();
        }else{
            return $menu->where("father = ".$father)->order('sort ASC')->select();
        }
    }

    /**
     * 根据menuid获取该菜单信息
     * @param $menuid
     * @return mixed
     */
    public function getMenu($menuid){
        $menu = D('menu','Model');
        return $menu->where("menuid = ".$menuid)->find();
    }

    public function getLeftMenu($father){
        $menu = D('menu','Model');
        $arr = $menu->where("father = ".$father." AND trash = '0'")->order('sort ASC')->select();
        foreach($arr as $k => $v){
            $arr2 = $this->getSonMenu($v['menuid'],true);
            if(!empty($arr2)){
                array_splice($arr,$k+1,0,$arr2);
            }
        }
        return $arr;
    }


    /**
     * 管理员登陆检测
     * @param $admin_name
     * @param $password
     * @return array
     */
    public function check_admin($admin_name, $password){
        $admin = D('admin_user','Model');
        $admin_user = $admin->where("admin_name ='".$admin_name."' AND trash = '0'")->find();
        if(empty($admin_user)){
            return array(0=>'error',1=>'管理员不存在！',2=>'/Admin/Index/login');
        }
        if($this->admin_pwd($password,$admin_user['encrpty']) == $admin_user['password']){
            $admin->where("admin_name = '".$admin_name."'")->save(array('login_time'=>time(),'login_ip'=>get_client_ip()));
            session('id',$admin_user['id']);
            session('name',$admin_name);
            session('level',$admin_user['level']);
            session('expire',3600);
            session('time',time());
            $this->login_status = true;
            $this->user_id = session('id');
            $this->user_info = array(
                'id' => session('id'),
                'name' => session('name'),
                'level' => session('level')
            );
            return array(0=>'success',1=>'登陆成功！',2=>'/Admin/Index/index');
        }
        return array(0=>'error',1=>'登陆密码错误！',2=>'/Admin/Index/login');
    }

    /**
     * 管理员密码加密
     * @param $password
     * @param $encrpty
     * @return string
     */
    public function admin_pwd($password,$encrpty=null){
        if(empty($encrpty)){
            $encrpty = random_encrpty(6);
            return array('password'=>base64_encode($password.$encrpty),'encrpty'=>$encrpty);
        }
        return base64_encode($password.$encrpty);
    }

    /**
     * 检查用户是否处于登陆状态
     * @return bool
     */
    protected function check_login_status(){
        if((session('expire')+session('time'))<=time()){
            $this->login_status = false;
            return false;
        }else{
            $this->login_status = true;
            $this->user_id = session('id');
            $this->user_info = array(
                'id' => session('id'),
                'name' => session('name'),
                'level' => session('level')
            );
        }
        return true;
    }
}