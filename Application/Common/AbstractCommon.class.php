<?php
/**
 * Created by PhpStorm.
 * User: kangxin
 * Date: 2016-07-27
 * Time: 16:52
 */

/**
 * 用户检测抽象类
 */
namespace Common;
use Think\Controller;
class AbstractCommon extends Controller {
    protected $login_status,$user_info,$user_id;
    protected $requestData;

    public function __construct(){

        //32位随机字符串作为标识
        $RequestId = $this->createRequestId();
        $_REQUEST['RequestId'] = $RequestId;
//        $this->requestData = $this->get();

        $this->user_info = session('user_info') ? session('user_info') : false;
        $this->login_status = session('user_info') ? true : false;
        $this->user_id = session('user_info') ? session('user_info')['userid'] : false;


        parent::__construct();
    }



    /**
     * 生成RequestId
     */
    private function createRequestId()
    {
        $rand = md5(time() . mt_rand(0, 1000));
        return $rand;
    }

}