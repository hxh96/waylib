<?php
/**
 * 平台总控制器
 */

namespace Run\Controller;


use Think\Controller;

class RunController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->_init();
        $this->username = session('adminUser')['user_real_name'];//姓名
        $library_id = session('adminUser')['library_id'];//图书馆ID
        //身份
        if($library_id ===  "SCYT001"){
            $this->role = '超级管理员';
        }else{
            $this->role = '图书馆管理员';
        }
        $this->photo = session('adminUser')['u_photo'];//头像
    }

    /**
     * 空方法
     */
    public function _empty(){
        header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
        $this->display("Public:404");
    }

    /*
    *初始化
    */
    public function _init(){
        $islogin = $this->isLogin();
        if(!$islogin){
            redirect(U('Login/index'));
        }else{
            $this->uId = session('adminUser')['user_id'];
        }
    }

    /*
    *判断是否登陆
    */
    public function isLogin(){
        $user = $this->getUserLogin();
        if($user && is_array($user)){
            return true;
        }else{
            return false;
        }
    }

    /*
    *获取用户登陆信息
    */
    public function getUserLogin(){
        return session('adminUser');
    }
}