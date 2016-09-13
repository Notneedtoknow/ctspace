<?php
namespace Extra\Controller;
use Admin;
class IndexController extends Admin\AbstractCommon {
    protected $poster_place,$poster,$poster_btn,$is_show,$type;
    public function __construct() {
        parent::__construct();

        if($this->login_status == false){
            $this->redirect('Admin/Index/login',array(),3);
        }

        $this->poster_place = D('poster_place','Model');
        $this->poster = D('poster','Model');
        $this->poster_btn = D('poster_btn','Model');

        $this->is_show = array('Y'=>'显示','N'=>'隐藏');
        $this->type = array('btn'=>'按钮','pic'=>'图片','list'=>'列表','special'=>'专题');
    }

    public function poster_manage(){
        $data = $this->poster_place->where("trash = '0'")->select();
        $this->assign('poster_place',$data);
        $this->display();
    }

    public function add_poster_place(){
        $action = I('get.action');
        if($action == 'edit'){
            $id = I('get.id');
            $data = $this->poster_place->where('id = '.$id)->find();
            $default = $data['is_show'];
            unset($data['is_show']);
            $this->assign($data);
        }else{
            $default = 'Y';
        }
        $this->assign('action',$action);
        $this->assign('is_show',$this->form->radio($this->is_show,'is_show',$default,true));
        $this->display();
    }

    public function add_poster_place_submit(){
        $action = I('post.action');
        $info = I('post.info');
        if(empty($action)||empty($info)){
            $this->error('传递参数错误！');
        }
        if($action == 'edit'){
            $id = I('post.id');
            if(empty($id)){
                $this->error('传递参数错误！');
            }
            $result = $this->poster_place->where('id = '.$id)->save($info);
        }else{
            $result = $this->poster_place->add($info);
        }
        if($result){
            $this->success('添加修改广告位置成功！','/Extra/Index/poster_manage');
        }else{
            $this->error('添加修改广告位置失败！');
        }
    }

    public function delete_poster_place(){
        $id = I('get.id');
        if(empty($id)){
            $this->error('传递参数错误！');
        }
        $result = $this->poster_place->where('id = '.$id)->save(array('trash'=>'1'));
        if($result){
            $this->success('删除广告位置成功！');
        }else{
            $this->error('删除广告位置失败！');
        }
    }

    public function poster(){
        $poster_place_id = I('get.id');
        if(empty($poster_place_id)){
            $this->error('传递参数错误！');
        }
        $poster = $this->poster->where('place_id = '.$poster_place_id." AND trash = '0'")->select();
        $this->assign('poster_place_id',$poster_place_id);
        $this->assign('poster',$poster);
        $this->display();
    }

    public function add_poster(){
        $action = I('get.action');
        $start_time = time();
        $end_time = time()+86400;
        if($action == 'edit'){
            $id = I('get.id');
            $data = $this->poster->where('id = '.$id)->find();
            $default = $data['is_show'];
            $default_type = $data['type'];
            $start_time = $data['start_time'];
            $end_time = $data['end_time'];
            unset($data['is_show']);
            unset($data['type']);
            unset($data['start_time']);
            unset($data['end_time']);
            $this->assign($data);
        }else{
            $default = 'Y';
            $default_type = 'btn';
        }
        $this->assign('action',$action);
        $this->assign('is_show',$this->form->radio($this->is_show,'is_show',$default,true));
        $this->assign('type',$this->form->radio($this->type,'type',$default_type,true));
        $this->assign('start_time',$this->form->dateV2($start_time,'info[start_time]',false));
        $this->assign('end_time',$this->form->dateV2($end_time,'info[end_time]',false));
        $this->display();
    }

    public function add_poster_submit(){
        $action = I('post.action');
        $info = I('post.info');
//        if(empty($action)||empty($info)){
//            $this->error('传递参数错误！');
//        }
        $info['start_time'] = strtotime($info['start_time']);
        $info['end_time'] = strtotime($info['end_time']);

        $info['update_id'] = $this->user_id;
        $info['update_name'] = $this->user_info['name'];
        $info['update_time'] = time();

        var_dump($info);die;
        if($action == 'edit'){
            $id = I('post.id');
            if(empty($id)){
                $this->error('传递参数错误！');
            }
            $result = $this->poster->where('id = '.$id)->save($info);
        }else{
            $result = $this->poster->add($info);
        }
        if($result){
            $this->success('添加修改广告位置成功！');
        }else{
            $this->error('添加修改广告位置失败！');
        }
    }

}