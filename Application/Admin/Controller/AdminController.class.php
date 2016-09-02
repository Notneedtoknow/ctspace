<?php
/**
 * Created by PhpStorm.
 * User: kangxin
 * Date: 2016-08-03
 * Time: 16:33
 */
namespace Admin\Controller;
class AdminController extends \Admin\AbstractCommon{
    public function __construct() {
        parent::__construct();

        if($this->login_status == false){
            $this->redirect('Admin/Index/login',array(),3);
        }

        $this->admin = D('admin_user','Model');
    }

    public function change_pwd(){
        $admin = $this->admin->where('id = '.$this->user_id)->find();
        $this->assign($admin);
        $this->display();
    }

    public function change_pwd_submit(){
        $info = I('post.info');
        $arr = $this->admin_pwd($info['password']);
        $info['password'] = $arr['password'];
        $info['encrpty'] = $arr['encrpty'];
        $flag = $this->admin->where('id = '.$this->user_id)->save($info);
        if($flag){
            $this->success('修改密码成功！');
        }else{
            $this->error('修改密码失败！');
        }
    }

    public function admin_manage(){
        $admin_lists = $this->admin->where('level > '.$this->user_info['level'])->order('level ASC')->select();
        $this->assign('admin_lists',$admin_lists);
        $this->display();
    }

    public function add_admin(){
        $action = I('get.action');
        if($action == 'edit'){
            $id = I('get.id');
            $data = $this->admin->where('id = '.$id)->find();
            $this->assign($data);
        }else{
            $level = $this->user_info['level'];
            $levels = $this->admin_level;
            unset($levels[0]);
            foreach($levels as $k => $v){
                if($k<$level){
                    unset($levels[$k]);
                }
            }
            $select_level = $this->form->select($levels,'level',$level,true);
            $this->assign('select_level',$select_level);
        }
        $this->assign('action',$action);
        $this->display();
    }

    public function add_admin_submit(){
        $action = I('post.action');
        $info = I('post.info');

        $arr = $this->admin_pwd($info['password']);
        $info['password'] = $arr['password'];
        $info['encrpty'] = $arr['encrpty'];
        if($action=='add'){
            $info['invite_id'] = $this->user_id;
            $info['invite_name'] = $this->user_info['name'];
            $info['invite_time'] = time();
            $info['trash'] = 0;
            $flag = $this->admin->add($info);
        }else{
            $id = I('post.id');
            $flag = $this->admin->where('id = '.$id)->save($info);
        }
        if($flag){
            $this->success('添加修改管理员成功','/Admin/Admin/admin_manage');
        }else{
            $this->error('添加修改管理员失败');
        }
    }

    public function delete(){
        $id = I('get.id');
        $flag = $this->admin->where('id = '.$id)->save(array('trash'=>1));
        if($flag){
            $this->success('删除管理员成功','/Admin/Admin/admin_manage');
        }else{
            $this->error('删除管理员失败');
        }
    }
    public function cancel_delete(){
        $id = I('get.id');
        $flag = $this->admin->where('id = '.$id)->save(array('trash'=>0));
        if($flag){
            $this->success('恢复管理员成功','/Admin/Admin/admin_manage');
        }else{
            $this->error('恢复管理员失败');
        }
    }

}