<?php
/**
 * 用户管理控制器
 */

namespace Run\Controller;


class UserController extends RunController
{
    //图书馆ID
    protected $library_id = '';
    /**
     * 构造方法
     * AppController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->webTitle = '用户管理';//标题
        $this->titleUrl = U('User/index');
        $this->library_id = session('adminUser')['library_id'];
    }

    /**
     * 读者管理
     */
    public function index()
    {
        //获取get参数
        $get = I('get.');
        //判断是否超级管理员
        if($this->library_id === "SCYT001"){
            $this->status = 1;
            //获取图书馆列表
            $librarys = D('Library')->getAll();
            $this->librarys = $librarys;
            $map = [];
        }else{
            $this->status = 0;
            $this->libraryId = $this->library_id;//分配图书馆ID
            $map['library_id'] = $this->library_id;//定义条件
        }
        //判断是否搜索
        if(isset($get['st'])){
            $map['u_type'] = $get['ut'];//用户类型
            $map['is_deposited'] = $get['de'];//是否交押金
            $map['status'] = $get['st'];//状态
            if($get['ct']){//判断是否根据手机号或读者证搜索
                $map[$get['ty']] = array('like','%'.$get['ct'].'%');
                $this->type = $get['ty'];//分配数据
                $this->content = $get['ct'];//分配数据
            }
            if($get['lib']){//判断是否选择图书馆
                $map['library_id'] = $get['lib'];
                $this->library_id = $get['lib'];//分配数据
            }
            $this->u_type = $get['ut'];//分配数据
            $this->is_deposited = $get['de'];//分配数据
            $this->u_status = $get['st'];//分配数据
        }
        $map['user_role'] = 'USER';//定义角色条件
        $arr = D('User')->getAllArr($map);

        if(!empty($arr)){
            //找到图书馆名称
            foreach ($arr as &$v) {
                $v['library'] = D('Library')->getById($v['library_id'])['name'];
            }
            $arr = Page($arr,15);//分页
            $this->page = $arr['page'];// 赋值分页输出
            $this->lists = $arr['lists'];
        }
        $this->menu = '读者管理';
        $this->display();
    }


    /**
     * 读者详情
     * @param $uId  读者ID
     */
    public function info($uId)
    {
        //根据userId查找一条用户
        $list = D('User')->getByUserId($uId);
        //找到图书馆名称
        if($list['library_id']){
            $list['library'] = D('Library')->getById($list['library_id'])['name'];
        }
        //接收查找条件
        $get = I('get.ac','dqjy');
        //判断是否是当前借阅或历史借阅
        if($get == 'dqjy' || $get == 'lsjy'){
            switch ($get)
            {
                case 'dqjy':
                    $map['is_back'] = 1;//当前借阅
                    break;
                case 'lsjy':
                    $map['is_back'] = 2;//历史借阅
                    break;
                default:
                    $map['is_back'] = 1;
            }
            //找到借阅记录
            $map['user_id'] = $uId;
            $arr = D('UserLend')->getAll($map);
            foreach($arr as &$v){
                $bookDesc = D('BookDesc')->getByDescId($v['bk_desc_id']); //找到书籍详情
                $machine = D('Machine')->getByMgId($v['mg_id']);//找到机器
                $v['title'] = $bookDesc['title'];//书名
                $v['isbn'] = $bookDesc['isbn'];//ISBN
                $v['tiaoma'] = str_replace($v['library_id'],'',$v['book_id']);//图书条码
                $v['machine'] = $machine['machine_name'];//借出机器
                $v['library'] = D('Library')->getById($v['library_id'])['name'];//借出机器
            }
        }
        $lists = Page($arr,8);//分页
        $this->lists = $lists['lists'];
        $this->page = $lists['page'];
        $this->assign($list);
        $this->menu = '读者详情';
        $this->display();
    }


    /**
     * 管理员管理
     */
    public function administer()
    {
        //判断是否超级管理员
        if($this->library_id === "SCYT001"){
            $this->status = 1;

            $get = I('get.');
            //搜索
            if(isset($get['st'])){
                if($get['ph']){
                    $map['u_mobile'] = array('like','%'.$get['ph'].'%');//定义手机号条件
                    $this->ph = $get['ph'];
                }
                if($get['lib']){
                    $map['library_id'] = $get['lib'];//定义图书馆ID条件
                    $this->lib = $get['lib'];
                }
                $map['status'] = $get['st'];//状态条件
                $this->st = (string)$get['st'];
            }else{
                $map['status'] = '1';//状态条件
            }
            $map['user_role'] = 'ADMIN';//定义角色条件
            $arr = D('User')->getAllArr($map);//找到所有数据
            //获取图书馆列表
            $librarys = D('Library')->getAll();
            $this->librarys = $librarys;
            foreach ($arr as &$v) {
                $v['library'] = D('Library')->getById($v['library_id'])['name'];//找到图书馆名称
            }
        }else{
            $this->status = 0;
        }
        $lists = Page($arr,15);//分页
        $this->lists = $lists['lists'];
        $this->page = $lists['page'];
        $this->menu = '管理员管理';
        $this->display();
    }


    /**
     * 添加管理员
     */
    public function adminAdd()
    {
        if(IS_POST){
            $post = I('post.');
            $post['user_role'] = 'ADMIN';//定义角色
            $post['created_time'] = date('Y-m-d H:i:s',time());//定义创建时间
            $re = D('User')->adminAdd($post);
            if($re){
                //日志
                $var = '添加管理员';
                addlog($var,$re);
                echo show(1,'添加成功');
            }else{
                echo show(0,'添加失败');
            }
        }
    }


    /**
     * 重置密码
     */
    public function resetPwd()
    {
        if(IS_POST){
            $post = I('post.');
            $re = D('User')->updateData($post);
            if($re){
                //日志
                $var = '重置密码';
                addlog($var,$post['user_id']);
                echo show(1,'重置成功');
            }else{
                echo show(0,'重置失败');
            }
        }
    }


    /**
     * 更改管理员状态 (封停或启用    0或1)
     */
    public function checkStatus()
    {
        if(IS_POST){
            $post = I('post.');
            $re = D('User')->updateData($post);
            if($re){
                //记录封停或启用操作
                if($post['status'] == 1){
                    $var = '启用管理员账号';
                }else{
                    $var = '封停管理员账号';
                }
                addlog($var,$post['user_id']);
                echo show(1,'操作成功',$re);
            }else{
                echo show(0,'操作失败',$re);
            }
        }
    }




}