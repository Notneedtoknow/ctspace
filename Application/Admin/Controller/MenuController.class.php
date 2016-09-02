<?php
/**
 * Created by PhpStorm.
 * User: kangxin
 * Date: 2016-08-03
 * Time: 16:33
 */
namespace Admin\Controller;
class MenuController extends \Admin\AbstractCommon{
    public function __construct() {
        parent::__construct();

        if($this->login_status == false){
            $this->redirect('Admin/Index/login',array(),3);
        }
    }

    public function menu_manage() {
        $parent = $this->getMenuAll(true);
        foreach($parent as $key => $value){
            $arr = $this->getSonMenu($value['menuid']);
            //获取当前位置
            $place = current(array_keys($parent,$value,true));
            if(!empty($arr)){
                foreach($arr as $k => $v){
                    $arr2 = $this->getSonMenu($v['menuid']);
                    //获取当前位置
                    $place2 = current(array_keys($arr,$v,true));
                    $arr[$k]['father_name'] = $parent[$key]['name'];
                    if(!empty($arr2)){
                        foreach($arr2 as $kk => $vv){
                            $arr2[$kk]['father_name'] = $arr[$k]['name'];
                        }
                        array_splice($arr,$place2+1,0,$arr2);
                    }
                }
                array_splice($parent,$place+1,0,$arr);
            }
        }
        $this->assign('data',$parent);
        $this->display();
    }

    public function add_menu() {
        $action = I('get.action');
        if($action == 'edit'){
            $menuid = I('get.menuid');
            $data = $this->getMenu($menuid);
            $default_father = $data['father'];
            $default_level = $data['level'];
            $this->assign('data',$data);
        }else if($action == 'addson'){
            $menuid = I('get.menuid');
            $data = $this->getMenu($menuid);
            $default_father = $menuid;
            $default_level = $data['level'] == 1?2:3;
            $action = 'add';
            $this->assign('data',array('level'=>$default_level));
        }else{
            $this->assign('data',array('level'=>1));
        }
        //获得1,2级菜单列表
        $select_menu = array('0'=>'根菜单');
        $arr = $this->getMenuAll(false,true);
        foreach($arr as $v){
            $select_menu[$v['menuid']] = $v['name'];
        }
        $select_menu = $this->form->select($select_menu,'father',isset($default_father)?$default_father:0,true);
        //获得菜单级别列表
        $select_level = array(1,2,3);
        $select_level = $this->form->select($select_level,'level',isset($default_level)?$default_level:0,false,'level_on_changed(this)');

        $this->assign('action',$action);
        $this->assign('select_menu',$select_menu);
        $this->assign('select_level',$select_level);
        $this->display();
    }

    public function add_menu_submit(){
        $menu = D('menu','Model');
        $action = I('get.action');
        $info = I('post.info');
        $info['update_id'] = $this->user_id;
        $info['update_time'] = time();
        $info['update_name'] = $this->user_info['name'];
        switch($info['level']){
            case 1:{
                unset($info['c']);
                unset($info['a']);
                break;
            }
            case 2:{
                unset($info['a']);
                break;
            }
        }
        if($action == 'add'){
            $info['create_id'] = $info['update_id'];
            $info['create_time'] = $info['update_time'];
            $info['create_name'] = $info['update_name'];
            $info['sort'] = $info['sort']?$info['sort']:0;
            $add_menuid = $menu->add($info);
            if($add_menuid){
                $this->success('添加菜单成功！','/Admin/Menu/menu_manage');
            }else{
                $this->error('添加菜单失败！');
            }
        }else{
            $menuid = I('post.menuid');
            $flag = $menu->where("menuid = ".$menuid)->save($info);
            if($flag){
                $this->success('修改菜单成功！','/Admin/Menu/menu_manage');
            }else{
                $this->error('修改菜单失败！');
            }
        }
    }

    public function delete(){
        $menu = D('menu','Model');
        $menu_id = I('get.menuid');
        $flag = $menu->where('menuid = '.$menu_id)->save(array('trash'=>'1'));
        if($flag){
            $this->success('删除菜单成功！','/Admin/Menu/menu_manage');
        }else{
            $this->error('删除菜单失败！','/Admin/Menu/menu_manage');
        }
    }
}