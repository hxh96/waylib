<?php
/**
 * 借阅查询控制器
 */

namespace Run\Controller;


class BorrowController extends RunController
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
        $this->webTitle = '借阅查询';//标题
        $this->titleUrl = U('Borrow/index');
        $this->library_id = session('adminUser')['library_id'];
    }


    /**
     * 当前借阅列表
     */
    public function index()
    {
        $map['is_back'] = 1;//当前在借
        //判断身份
        if($this->library_id === "SCYT001"){
            $this->status = 1;
            $librarys = D('Library')->getAll();//分配图书馆列表
            $this->librarys = $librarys;
        }else{
            $this->status = 0;
            $this->libId = $this->library_id;
            //自己图书馆的读者或者智能微图的用户
            $map['book_id|waylib_user.u_type'] =array(array('like','%'.$this->library_id.'%'),1,'_multi'=>true);
        }
        $get = I('get.');
        //判断是否搜索
        if(isset($get['ty'])){
            //判断是否根据手机号或证号搜索
            if($get['co']){
                $map[$get['ty']] = array('like','%'.$get['co'].'%');
            }
            //判断是否选择图书馆
            if($get['lib']){
                $map['book_id'] =  array('like','%'.$get['lib'].'%');
                $this->library_id = $get['lib'];//分配数据
                //判断是否选择条码
                if($get['tm']){
                    $map['book_id'] = array('like','%'.$get['tm'].$get['lib'].'%');
                }
            }else{
                //判断是否选择条码
                if($get['tm']){
                    $map['book_id'] = array('like','%'.$get['tm'].'%');
                }
            }
            $this->u_type = $get['ty'];//分配数据
            $this->content = $get['co'];//分配数据
            $this->tiaoma = $get['tm'];//分配数据
        }
        $arr = D('UserLend')->getAllJoinUser($map);//关联user表找到借阅数据
//        var_dump($arr);
        $arr = $this->eachArr($arr);//遍历赋值数据
        $lists = Page($arr,15);//分页
        $this->lists = $lists['lists'];
        $this->page = $lists['page'];
        $this->menu = '当前借阅';
        $this->display();
    }


    /**
     * 借阅详情
     * @param $lendId u_user_lend_id
     * @param $uId user_id
     */
    public function nowInfo($lId,$uId)
    {
        $user  = D('User')->getByUserId($uId);
        $this->user = $user;//用户信息
        $lend = D('UserLend')->getByLendId($lId);//借阅记录
        $book = D('Book')->getByIdtoBookDesc($lend['book_id']);//书籍信息
        $book['tiaoma'] = str_replace($book['library_id'],'',$book['book_id']);//图书条码
        $book['lend-time'] = $lend['created_time'];//借阅时间
        $this->book = $book;//书籍信息
        $machine = D('Machine')->getByMgId($book['mg_id']);//机器信息
        $machine['library'] = D('Library')->getById($machine['library_id'])['name'];//找到图书馆名称
        $this->machine = $machine;//机器信息
        $map['waylib_user_lend.user_id'] = $uId;//当前借阅条件
        $map['waylib_user_lend.is_back'] = 1;//当前借阅条件
        $now_arr = D('UserLend')->getAllJoinUser($map);//关联user表找到当前借阅数据
        $now_arr = $this->eachArr($now_arr);//遍历赋值数据
        $this->nowLists = $now_arr;
        $map2['waylib_user_lend.user_id'] = $uId;//当前借阅条件
        $map2['waylib_user_lend.is_back'] = 2;//历史借阅条件
        $his_arr = D('UserLend')->getAllJoinUser($map2);//关联user表找到历史借阅数据
        $his_arr = $this->eachArr($his_arr);//遍历赋值数据
        $his_lists = Page($his_arr,3);//分页
        $this->hisLists = $his_lists['lists'];
        $this->page = $his_lists['page'];
        $this->menu = '借阅详情';
        $this->display();
    }


    //遍历
    public function eachArr($arr)
    {
        //遍历赋值数据
        foreach($arr as &$v){
            $book = D('Book')->getByBookId($v['book_id']);//找到书籍所在机器ID
            $machine = D('Machine')->getByMgId($book['mg_id']);//找到机器的详情
            $v['machine_name'] = $machine['machine_name'];//机器名称
            $v['tiaoma'] = str_replace($machine['library_id'],'',$v['book_id']);//图书条码
            $v['library'] = D('Library')->getById($book['library_id'])['name'];//找到图书馆名称
            $bookDesc = D('BookDesc')->getByDescId($book['bk_desc_id']);//找到书籍详情
            $v['title'] = $bookDesc['title'];//书名
            $v['isbn'] = $bookDesc['isbn'];//isbn
        }
        return $arr;
    }


    /**
     * 历史借阅列表
     */
    public function hisBorrow()
    {
        $map['is_back'] = 2;//历史借阅
        //判断身份
        if($this->library_id === "SCYT001"){
            $this->status = 1;
            $librarys = D('Library')->getAll();//分配图书馆列表
            $this->librarys = $librarys;
        }else{
            $this->status = 0;
            $this->libId = $this->library_id;
            //自己图书馆的读者或者智能微图的用户
            $map['book_id|waylib_user.u_type'] =array(array('like','%'.$this->library_id.'%'),1,'_multi'=>true);
        }
        $get = I('get.');
        //判断是否搜索
        if(isset($get['ty'])){
            //判断是否根据手机号或证号搜索
            if($get['co']){
                $map[$get['ty']] = array('like','%'.$get['co'].'%');
            }
            //判断是否选择图书馆
            if($get['lib']){
                $map['book_id'] =  array('like','%'.$get['lib'].'%');
                $this->library_id = $get['lib'];//分配数据
                //判断是否选择条码
                if($get['tm']){
                    $map['book_id'] = array('like','%'.$get['tm'].$get['lib'].'%');
                }
            }else{
                //判断是否选择条码
                if($get['tm']){
                    $map['book_id'] = array('like','%'.$get['tm'].'%');
                }
            }
            $this->u_type = $get['ty'];//分配数据
            $this->content = $get['co'];//分配数据
            $this->tiaoma = $get['tm'];//分配数据
        }
        $arr = D('UserLend')->getAllJoinUser($map);//关联user表找到借阅数据
        $arr = $this->eachArr($arr);//遍历赋值数据
        $lists = Page($arr,15);//分页
        $this->lists = $lists['lists'];
        $this->page = $lists['page'];
        $this->menu = '借阅详情';
        $this->display();
    }


    /**
     * 历史借阅详情
     * @param $lId  lend_id
     * @param $uId  用户id
     */
    public function hisInfo($lId,$uId)
    {
        $user  = D('User')->getByUserId($uId);
        $this->user = $user;//用户信息
        $lend = D('UserLend')->getByLendId($lId);//借阅记录
        $book = D('Book')->getByIdtoBookDesc($lend['book_id']);//书籍信息
        $book['tiaoma'] = str_replace($book['library_id'],'',$book['book_id']);//图书条码
        $book['lend-time'] = $lend['created_time'];//借阅时间
        $this->book = $book;//书籍信息
        $machine = D('Machine')->getByMgId($book['mg_id']);//机器信息
        $machine['library'] = D('Library')->getById($machine['library_id'])['name'];//找到图书馆名称
        $this->machine = $machine;//机器信息
        $map['waylib_user_lend.user_id'] = $uId;//历史借阅条件
        $map['waylib_user_lend.is_back'] = 2;//历史借阅条件
        $start = I('get.start');//搜索(开始时间)
        $end = I('get.end');//搜索(结束时间)
        if($start && $end){
            $map['waylib_user_lend.created_time'] = array(array('gt',$start),array('lt',$end));//定义区间
            $this->start = $start;
            $this->end = $end;
        }
        $arr = D('UserLend')->getAllJoinUser($map);//关联user表找到当前借阅数据
        $arr = $this->eachArr($arr);//遍历赋值数据
        $lists = Page($arr,10);//分页
        $this->lists = $lists['lists'];
        $this->page = $lists['page'];
        $this->menu = '借阅详情';
        $this->lId = $lId;//lend_id
        $this->uId = $uId;//user_id
        $this->display();
    }

}