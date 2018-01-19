<?php
/**
 * App管理控制器
 */

namespace Run\Controller;


class AppController extends RunController
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
        $this->webTitle = 'APP管理';//标题
        $this->titleUrl = U('App/index');
        $this->library_id = session('adminUser')['library_id'];

    }


    /**
     * 首页列表(在架图书)
     */
    public function index()
    {
        //判断身份
        if($this->library_id === "SCYT001"){
            $this->status = 1;
            //搜索
            $libraryid = I('get.libraryid');
            $librarys = D('Library')->getAll();
            if(!$libraryid){
                $map['library_id'] = $librarys[0]['id'] ;//没有搜索默认显示第一个图书馆
            }else{
                $map['library_id'] = $libraryid;
            }
            $this->librarys = $librarys;
        }else{
            $map['library_id'] = $this->library_id;
            $this->status = 0;
        }
        //找到机器信息
        $machines = D('Machine')->getByLibraryId($map['library_id']);

        $lists = [];
        //遍历机器信息
        foreach($machines as $v){
            $arr2 = D('MachineLattice')->getByMachId($v['machine_id']);
            //遍历得到bookid
            foreach($arr2 as $z){
                $arr3 = D('Book')->getByIdtoBookDesc($z['book_id']);
                //追加到lists中
                array_push($lists,$arr3);
            }
        }
        $arr = Page($lists,15);//分页
        $this->page = $arr['page'];// 赋值分页输出
        $this->lists = $arr['lists'];
        $this->libraryid = $map['library_id'];
        $this->menu = '在架图书';
        $this->display();
    }


    /**
     * 专题推荐
     */
    public function them()
    {
        //判断是否超级管理员
        if($this->library_id === "SCYT001"){
            $this->status = 1;
            //获取图书馆列表
            $librarys = D('Library')->getAll();
            $this->librarys = $librarys;
        }else{
            $this->status = 0;

        }
//        $this->libraryId = $this->library_id;
        $this->menu = '专题推荐';
        $this->display();
    }


    /**
     * 消息推送
     */
    public function push()
    {
        //判断是否超级管理员
        if($this->library_id === "SCYT001"){
            $this->status = 1;

            $librarys = D('Library')->getAll();
            $this->librarys = $librarys;
        }else{
            $this->status = 0;
            $this->libraryId = $this->library_id;
        }
        $this->menu = '消息推送';
        $this->display();
    }



    /**
     * 退押金审核
     */
    public function backMoney()
    {
        //判断是否超级管理员
        if($this->library_id === "SCYT001"){
            $map['is_backmoney'] = 1;
            //根据条件查询所有
            $arr = D('User')->getAll($map);
            //关联图书馆
            foreach($arr['lists'] as &$v){
                $v['library'] = D('Library')->getById($this->library_id)['name'];
                $v['u_type'] = $v['u_type']==1?'微图用户':'图书馆用户';
                $v['gender'] = $v['gender']==1?'男':'女';
                $v['is_backmoney'] = $v['is_backmoney']==1?'审核中':'已通过';
                $v['is_arrearage'] = $v['is_arrearage']==1?'否':'是';
            }
            $this->status = 1;

//            var_dump($arr['lists']);
            $this->lists = $arr['lists'];
            $this->page = $arr['page'];
        }else{
            $this->status = 0;
        }
        $this->menu = '退押金审核';
        $this->display();
    }


    /**
     * 用户反馈
     */
    public function userBack()
    {
        //判断是否超级管理员
        if($this->library_id === "SCYT001"){
            $this->status = 1;
            $type = I('get.t'); //搜索类型
            $content = I('get.ct');  //搜索内容
            //判断是否搜索
            if($content != ''){
                //拼接SQL语句
                $map = "waylib_user.".$type." like '%".$content."%'";
                $sql = "SELECT *
              FROM waylib_message
              INNER JOIN waylib_user ON waylib_user.user_id = waylib_message.user_id
              WHERE message_type = 2 And ".$map;
                $Model = M();
                $arr = $Model->query($sql);
                $this->content = $content;//分配搜索内容
            }else{
                $map['message_type'] = 2;
                $arr = D('Message')->getAll($map);
            }
            //分页
            $lists =Page($arr,15);
            $this->lists = $lists['lists'];
            $this->page = $lists['page'];
        }else{
            $this->status = 0;
        }
       $this->menu = '用户反馈';
       $this->display();
    }



    /**
     * 在架图书排序
     */
    public function checkSort()
    {
            $sort = I('get.sort');
            $bookId = I('get.bookId');
            //根据bookid找到对应的机器详情
            $list = D('MachineLattice')->getByBookId($bookId);
            //更新排序
            $re = D('MachineLattice')->updateSort($list['mach_lat_num'],$list['mach_id'],$sort);
            if($re){
               echo show(1,'排序成功',$re);
            }else{
               echo show(0,'排序失败',$re);
            }
    }



}