<?php
/**
 * 用户登录控制器
 */

namespace Run\Controller;


use Think\Controller;
use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;

class LoginController extends Controller
{
    /**
     * 空方法
     */
    public function _empty(){
        header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
        $this->display("Public:404");
    }

    /**
     * 登录展示
     */
    public function index()
    {
        $this->display();
    }

    /**
     * 验证登录
     */
    public function checkLogin()
    {
        if(IS_POST) {
            $username = I('post.username', '', '');
            $password = I('post.password', '', '');
            $code = I('post.code', '', '');
            if (!trim($username)) {
                echo show(0, '用户名不能为空');
                exit;
            }
            if (!trim($password)) {
                echo show(0, '密码不能为空');
                exit;
            }
            if (!trim($code)) {
                echo show(0, '验证码不能为空');
                exit;
            }
            /*校验验证码*/
            if (!$this->check_var($code)) {
                echo show(0, '验证码错误');
                exit;
            }
            $ret = D('User')->getUsername($username);
            if($ret['nick_name'] == '超级管理员'){
                session('adminUser', $ret);
                echo show(1,'登录成功');
                exit;
            }
            if (empty($ret)) {
                echo show(0, '该用户不存在');
                exit;
            }
            if ($ret['status'] == 0) {
                echo show(0, '该用户已被封停');
                exit;
            }
            if ($ret['user_role'] != 'ADMIN') {
                echo show(0, '该账号不是管理员');
                exit;
            }
            if ($ret['u_pwd'] != $password) {
                echo show(0, '密码错误');
                exit;
            }
            $data['last_login_time'] = date('Y-m-d H:i:s',time());
            $data['user_id'] = $ret['user_id'];
            $re = D('User')->updateData($data);
            if($re){
                //日志
                $var = '管理员登录';
                addlog($var,null,$ret['user_id']);
                session('adminUser', $ret);
                echo show(1,'登录成功',$ret);
            }else{
                echo show(0,'更新登录时间失败');
            }
        }
    }


    /**
     * 修改密码
     * @param $uId  userId
     */
    public function checkPwd($uId)
    {
        $this->uId = $uId;
        $this->display();
    }


    /**
     * 修改密码
     */
    public function check()
    {
        $get = I('post.');
        $arr = D('User')->getByUserId($get['user_id']);//找到用户信息
        if($arr['u_mobile'] == $get['phone']){//验证手机号是否是管理员手机号
            $data['user_id'] =  $get['user_id'];
            $data['u_pwd'] =  $get['u_pwd'];
            $re = D('User')->updateData($data);//更新密码
            if($re){
                //日志记录
                $var = '修改密码';
                addlog($var,$get['user_id']);
                echo show(1, '修改成功',$re);
            }else{
                echo show(0, '修改失败',$re);
            }
        }else{
            echo show(0, '该手机号不是管理员',$arr);
        }
    }


    /**
     * 忘记密码
     */
    public function forgetPwd()
    {
        if(IS_AJAX){
            $get = I('post.');
            $arr = D('User')->getUsername($get['phone']);//找到用户信息
            //判断是否存在并是管理员
            if(is_array($arr) && $arr['user_role']=='ADMIN'){
                $data['user_id'] =  $arr['user_id'];
                $data['u_pwd'] =  $get['u_pwd'];
                $re = D('User')->updateData($data);//更新密码
                if($re){
                    //日志记录
                    $var = '找回密码';
                    addlog($var,null,$arr['user_id']);
                    echo show(1, '修改成功',$re);
                }else{
                    echo show(0, '修改失败',$re);
                }
            }else{
                echo show(0, '该手机号不是管理员',$arr);
            }
        }else{
            $this->display();
        }
    }



    /**
     * 退出登录
     */
    public function loginOut()
    {
        if(IS_AJAX){
            session('adminUser', null);
            echo show(1, '退出成功');
        }
    }

    /**
     *验证码
     */
    public function ver(){
        $Verify = new \Think\Verify();
        $Verify->length   = 4;
        $Verify->fontSize = 100;
        $Verify->entry();
    }

    /**
     * 检验验证码
     */
    public function check_var($code,$id ='')
    {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

}