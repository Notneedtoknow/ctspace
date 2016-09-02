<?php
namespace Admin\Controller;
class IndexController extends \Admin\AbstractCommon {
    private $need_login_action,$no_need_login_action;
    public function __construct(){
        parent::__construct();

        //需要登录的方法
        $this->need_login_action = array(
            'index'
        );
        //不需要登陆的方法
        $this->no_need_login_action = array(
            'login','ajax_check_login','verify_c'
        );
        //检查是否登录
        if(in_array(ACTION_NAME,$this->need_login_action)){
            if($this->login_status == false){
                $this->redirect('Admin/Index/login',array(),3);
            }
        }
    }

    public function index(){
        $this->assign($this->requestData);
        $this->display();
    }

    public function login(){
        $this->display();
    }

    public function login_out(){
        session_destroy();
        $this->success('退出成功','/Admin/Index/login');
    }

    public function ajax_check_login(){
        $info = I('post.info');
        $flag = check_verify($info['code']);
        if($flag == false){
            $this->error('验证码错误','/Admin/Index/login');
        }
        $result =  $this->check_admin($info['name'],$info['password']);
        if($result[0] == 'error'){
            $this->error($result[1],$result[2]);
        }else{
            $this->success($result[1],$result[2]);
        }
    }

    /**
     *
     * 验证码生成
     */
    public function verify_c(){
        $Verify = new \Think\Verify();
        $Verify->fontSize = 22;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->imageW = 150;
        $Verify->imageH = 50;
        //$Verify->expire = 600;
        $Verify->entry();
    }

    /**
     * 查询子菜单列表 ajax接口
     */
    public function ajax_get_menu_son(){
        $menu_id = I('get.menu_id');
        $trash = (I('get.trash')==1)?true:false;
        if(empty($menu_id)){
            $this->error('缺少必要参数！');
        }
        $menu_list = $this->getSonMenu($menu_id,$trash);
        $this->ajaxReturn($menu_list);
    }
}