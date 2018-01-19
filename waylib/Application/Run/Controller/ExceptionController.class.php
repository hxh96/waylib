<?php
/**
 * 异常处理控制器
 */

namespace Run\Controller;


class ExceptionController extends RunController
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
        $this->webTitle = '异常处理';//标题
        $this->titleUrl = U('Exception/index');
        $this->library_id = session('adminUser')['library_id'];

    }

    /**
     * 异常处理列表
     */
    public function index()
    {
        $this->menu = '异常处理';
        $this->display();
    }


    /**
     * 借书成功,柜中无书,1_1第一步
     */
    public function handle1_1()
    {
        $this->menu = '借书成功,柜中无书(1)';
        $this->display();
    }

    /**
     * 搜索验证
     */
    public function handle1Check()
    {
        $content = I('get.co');
        $map['u_name|u_mobile'] =$content;
        $re = D('UserLend')->getAllJoinUser($map);
        if($re){
            echo show(1,'存在',$re);
        }else{
            echo show(0,'不存在',$re);
        }
    }


    /**
     * 借书成功,柜中无书,1_2第二步
     */
    public function handle1_2()
    {
        $content = I('get.co');
        $map['u_name|u_mobile'] =$content;
//        $map['is_back'] =array('neq',3);
        $map['is_back'] =1;//在借中的书
        $arr = D('UserLend')->getAllJoinUser($map);//找到借阅记录
        //遍历数据
        foreach($arr as &$v){
            $book = D('Book')->getByBookId($v['book_id']);//找到书籍所在机器ID
            $machine = D('Machine')->getByMgId($book['mg_id']);//找到机器的详情
            $v['machine_name'] = $machine['machine_name'];//机器名称
            $v['tiaoma'] = str_replace($book['library_id'],'',$v['book_id']);//图书条码
            $v['library'] = D('Library')->getById($book['library_id'])['name'];//找到图书馆名称
            $bookDesc = D('BookDesc')->getByDescId($book['bk_desc_id']);//找到书籍详情
            $v['title'] = $bookDesc['title'];//书名
            $v['isbn'] = $bookDesc['isbn'];//isbn
        }
        $lists = Page($arr,9);//分页
        $this->lists = $lists['lists'];
        $this->page = $lists['page'];
        $this->menu = '借书成功,柜中无书(2)';
        $this->display();
    }


    /**
     * 借书成功,柜中无书,1_3第三步
     */
    public function handle1_3($lendId)
    {
        $userLend = D('UserLend')->getByLendId($lendId);//获取借阅记录
        $user  = D('User')->getByUserId($userLend['user_id']);
        $this->user = $user;//用户信息
        $book = D('Book')->getByIdtoBookDesc($userLend['book_id']);//书籍信息
        $book['tiaoma'] = str_replace($book['library_id'],'',$book['book_id']);//图书条码
        $book['lend-time'] = $userLend['created_time'];//借阅时间
        $this->book = $book;//书籍信息
        $machine = D('Machine')->getByMgId($book['mg_id']);//机器信息
        $machine['library'] = D('Library')->getById($machine['library_id'])['name'];//找到图书馆名称
        $this->machine = $machine;//机器信息
        $this->backUrl = $_SERVER['HTTP_REFERER'];//获取上一页的链接
        $this->menu = '借书成功,柜中无书(3)';
        $this->lendId = $lendId;
        $this->display();
    }


    /**
     * 借书成功,柜中无书,1_3第三步  清除记录
     */
    public function handle1_3Del()
    {
        $lendId = I('get.lendId');//借阅Id
        $data['u_user_lend_id'] = $lendId;
        $data['is_back'] = 3;
        $re = D('UserLend')->updateDate($data);//更新借阅记录的状态
        if($re){
            $lend = D('UserLend')->getByLendId($lendId);//找到借阅记录
            $book = D('Book')->getByBookId($lend['book_id']);//找到书籍记录
            $book_data['status'] = 3;
            $book_re = D('Book')->updateBook($book['book_id'],$book_data);//更新书籍状态
            if($book_re){
                $machine_data['book_id'] = '';
                $machine_re = D('MachineLattice')->updateDataWhereBookId($lend['book_id'],$machine_data);//更新格子中book_id为空
                if($machine_re){
                    echo show(1,'清除成功');
                }else{
                    echo show(0,'更新格子书籍失败');
                }
            }else{
                echo show(0,'更新书籍状态失败');
            }
        }else{
            echo show(0,'清除失败');
        }
    }

    /**
     * 借书成功,柜中无书,1_4第四步
     */
    public function handle1_4()
    {
        $this->menu = '借书成功,柜中无书(4)';
        $this->display();
    }





    /**
     * 借书成功,书目信息有误,2_1第一步
     */
    public function handle2_1()
    {
        $this->menu = '借书成功,书目信息有误(1)';
        $this->display();
    }


    /**
     * 借书成功,书目信息有误,2_2第二步
     */
    public function handle2_2()
    {
        $content = I('get.co');
        $map['u_name|u_mobile'] =$content;
        $map['is_back'] =array('neq',3);
        $arr = D('UserLend')->getAllJoinUser($map);//找到借阅记录
        //遍历数据
        foreach($arr as &$v){
            $book = D('Book')->getByBookId($v['book_id']);//找到书籍所在机器ID
            $machine = D('Machine')->getByMgId($book['mg_id']);//找到机器的详情
            $v['machine_name'] = $machine['machine_name'];//机器名称
            $v['tiaoma'] = str_replace($book['library_id'],'',$v['book_id']);//图书条码
            $v['library'] = D('Library')->getById($book['library_id'])['name'];//找到图书馆名称
            $v['library_id'] = $book['library_id'];//图书馆ID
            $bookDesc = D('BookDesc')->getByDescId($book['bk_desc_id']);//找到书籍详情
            $v['title'] = $bookDesc['title'];//书名
            $v['isbn'] = $bookDesc['isbn'];//isbn
        }
        $lists = Page($arr,5);//分页
        $this->lists = $lists['lists'];
        $this->page = $lists['page'];
        $this->co = $content;//分配搜索内容
        $this->menu = '借书成功,书目信息有误(2)';
        $this->display();
    }

    /**
     * 清除记录
     */
    public function handle2Del()
    {
        $lendId = I('get.lendId');//借阅Id
        $data['u_user_lend_id'] = $lendId;
        $data['is_back'] = 3;
        $userLend = D('UserLend');
        $userLend->startTrans(); // 启动事务
        $re = $userLend->updateDate($data);//更新借阅记录的状态
        if($re){
            $lend = D('UserLend')->getByLendId($lendId);//找到借阅记录
            $book = D('Book')->getByBookId($lend['book_id']);//找到书籍记录
            $book_data['status'] = 3;
            $BOOK = D('Book');
            $BOOK->startTrans(); // 启动事务
            $book_re = $BOOK->updateBook($book['book_id'],$book_data);//更新书籍状态
            if($book_re){
                $MachineLattice = D('MachineLattice');
                $mach = $MachineLattice->getByBookId($lend['book_id']);//根据bookid查数据
                if($mach){//判断格子书籍是否存在
                    $machine_data['book_id'] = '';
                    $MachineLattice->startTrans(); // 启动事务
                    $machine_re = $MachineLattice->updateDataWhereBookId($lend['book_id'],$machine_data);//更新格子中book_id为空
                    if($machine_re){
                        $userLend->commit(); // 提交事务
                        $BOOK->commit(); // 提交事务
                        $MachineLattice->commit(); // 提交事务
                        echo show(1,'清除成功');
                    }else{
                        $BOOK->rollback(); // 事务回滚
                        $userLend->rollback(); // 事务回滚
                        echo show(0,'更新格子书籍失败');
                    }
                }else{
                    $userLend->commit(); // 提交事务
                    $BOOK->commit(); // 提交事务
                    echo show(1,'清除成功');
                }
            }else{
                $userLend->rollback(); // 事务回滚
                echo show(0,'更新书籍状态失败');
            }
        }else{
            echo show(0,'清除失败');
        }
    }

    /**
     * 借书成功,书目信息有误,2_3第三步
     */
    public function handle2_3()
    {
        $this->libraryId = I('get.lId');//图书馆ID
        $this->co = I('get.co');//搜索内容
        $this->backUrl = $_SERVER['HTTP_REFERER'];//获取上一页的链接
        $this->menu = '借书成功,书目信息有误(3)';
        $this->display();
    }


    /**
     * 验证书目信息
     */
    public function handle2Check()
    {
        $bookId = I('get.bookId');
        $re = D('Book')->getByBookId($bookId);
        if($re){
            echo show(1,'存在',$re);
        }else{
            echo show(0,'不存在',$re);
        }
    }

    /**
     * 借书成功,书目信息有误,2_4第四步
     */
    public function handle2_4()
    {
        $bookId = I('get.bookId');
        $map['book_id'] = $bookId;
        $arr = D('UserLend')->getAllJoinUser($map);
        //遍历数据
        foreach($arr as &$v){
            $book = D('Book')->getByBookId($v['book_id']);//找到书籍所在机器ID
            $machine = D('Machine')->getByMgId($book['mg_id']);//找到机器的详情
            $v['machine_name'] = $machine['machine_name'];//机器名称
            $v['tiaoma'] = str_replace($book['library_id'],'',$v['book_id']);//图书条码
            $v['library'] = D('Library')->getById($book['library_id'])['name'];//找到图书馆名称
            $v['library_id'] = $book['library_id'];//图书馆ID
            $bookDesc = D('BookDesc')->getByDescId($book['bk_desc_id']);//找到书籍详情
            $v['title'] = $bookDesc['title'];//书名
            $v['isbn'] = $bookDesc['isbn'];//isbn
        }
        $lists = Page($arr,5);
        $this->lists = $lists['lists'];
        $this->page = $lists['page'];
        $this->backUrl = $_SERVER['HTTP_REFERER'];//获取上一页的链接
        $this->menu = '借书成功,书目信息有误(4)';
        $this->display();
    }



    /**
     * 盘点,系统有书,柜中无书,3_1第一步
     */
    public function handle3_1()
    {
        $this->menu = '盘点,系统有书,柜中无书(1)';
        $this->display();
    }


    /**
     * 验证条码借阅记录
     */
    public function handle3Check()
    {
        $content = I('get.co');
        //判断身份
        if($this->library_id === "SCYT001"){
            $map['book_id'] = array('like','%'.$content.'%');
        }else{
            $map['book_id'] = $content.$this->library_id;
        }
        $re = D('UserLend')->getAllByBookId($map);
        if($re){
            echo show(1,'存在',$map['book_id']);
        }else{
            echo show(0,'不存在',$re);
        }
    }


    /**
     * 盘点,系统有书,柜中无书,3_2第二步
     */
    public function handle3_2()
    {
        $content = I('get.co');
        //判断身份
        if($this->library_id === "SCYT001"){
            $map['book_id'] = array('like','%'.$content.'%');
        }else{
            $map['book_id'] = $content.$this->library_id;
        }
        $map['is_back'] =array('neq',3);
        $arr = D('UserLend')->getOneJoinUser($map);//找到借阅记录
        $book = D('Book')->getByBookId($arr['book_id']);//找到书籍所在机器ID
        $machine = D('Machine')->getByMgId($book['mg_id']);//找到机器的详情
        $arr['machine_name'] = $machine['machine_name'];//机器名称
        $arr['tiaoma'] = str_replace($book['library_id'],'',$arr['book_id']);//图书条码
        $arr['library'] = D('Library')->getById($book['library_id'])['name'];//找到图书馆名称
        $arr['library_id'] = $book['library_id'];//图书馆ID
        $bookDesc = D('BookDesc')->getByDescId($book['bk_desc_id']);//找到书籍详情
        $arr['title'] = $bookDesc['title'];//书名
        $arr['isbn'] = $bookDesc['isbn'];//isbn
        $this->lists = $arr;
        $this->co = $content;//分配搜索内容
        $this->menu = '盘点,系统有书,柜中无书(2)';
        $this->display();
    }


    /**
     * 盘点,系统有书,柜中无书,3_3第三步
     */
    public function handle3_3($lendId)
    {
        $userLend = D('UserLend')->getByLendId($lendId);//获取借阅记录
        $user  = D('User')->getByUserId($userLend['user_id']);
        $this->user = $user;//用户信息
        $book = D('Book')->getByIdtoBookDesc($userLend['book_id']);//书籍信息
        $book['tiaoma'] = str_replace($book['library_id'],'',$book['book_id']);//图书条码
        $book['lend-time'] = $userLend['created_time'];//借阅时间
        $this->book = $book;//书籍信息
        $machine = D('Machine')->getByMgId($book['mg_id']);//机器信息
        $machine['library'] = D('Library')->getById($machine['library_id'])['name'];//找到图书馆名称
        $this->machine = $machine;//机器信息
        $this->backUrl = $_SERVER['HTTP_REFERER'];//获取上一页的链接
        $this->lendId = $lendId;//分配lendId
        $this->menu = '盘点,系统有书,柜中无书(3)';
        $this->display();
    }

    /**
     * 盘点,系统无书,柜中有书,4_1第一步
     */
    public function handle4_1()
    {
        $this->menu = '盘点,系统无书,柜中有书(1)';
        $this->display();
    }

    /**
     * 盘点,系统无书,柜中有书,4_2第二步
     */
    public function handle4_2()
    {
        $content = I('get.co');
        if($this->library_id === "SCYT001"){
            $map['book_id'] = array('like','%'.$content.'%');
        }else{
            $map['book_id'] = $content.$this->library_id;
        }
        $map['is_back'] =array('neq',3);
        $arr = D('UserLend')->getOneJoinUser($map);//找到借阅记录
        $book = D('Book')->getByBookId($arr['book_id']);//找到书籍所在机器ID
        $machine = D('Machine')->getByMgId($book['mg_id']);//找到机器的详情
        $arr['machine_name'] = $machine['machine_name'];//机器名称
        $arr['tiaoma'] = str_replace($book['library_id'],'',$arr['book_id']);//图书条码
        $arr['library'] = D('Library')->getById($book['library_id'])['name'];//找到图书馆名称
        $arr['library_id'] = $book['library_id'];//图书馆ID
        $bookDesc = D('BookDesc')->getByDescId($book['bk_desc_id']);//找到书籍详情
        $arr['title'] = $bookDesc['title'];//书名
        $arr['isbn'] = $bookDesc['isbn'];//isbn
        $this->lists = $arr;
        $this->co = $content;
        $this->menu = '盘点,系统无书,柜中有书(2)';
        $this->display();
    }


    /**
     * 下架图书
     */
    public function handle4Down()
    {
        $bookId = I('get.bookId');
        $book_data['status'] = 3;
        $re = D('Book')->updateBook($bookId,$book_data);//修改书籍状态
        if($re){
            $MachineLattice = D('MachineLattice');
            $mach = $MachineLattice->getByBookId($bookId);//根据bookid查数据
            if($mach){//判断格子书籍是否存在
                $machine_data['book_id'] = '';
                $machine_re = $MachineLattice->updateDataWhereBookId($bookId,$machine_data);//更新格子中book_id为空
                if($machine_re){
                    echo show(1,'下架成功');
                }else{
                    echo show(0,'更新格子书籍状态失败');
                }
            }else{
                echo show(1,'下架成功');
            }
        }else{
            echo show(0,'下架失败');
        }

    }


    /**
     * 盘点,书目信息有误,5_1第一步
     */
    public function handle5_1()
    {
        $this->menu = '盘点,书目信息有误(1)';
        $this->display();
    }

    /**
     * 盘点,书目信息有误,5_2第二步
     */
    public function handle5_2()
    {
        $content = I('get.co');
        if($this->library_id === "SCYT001"){
            $map['book_id'] = array('like','%'.$content.'%');
        }else{
            $map['book_id'] = $content.$this->library_id;
        }
        $map['is_back'] =array('neq',3);
        $arr = D('UserLend')->getOneJoinUser($map);//找到借阅记录
        $book = D('Book')->getByBookId($arr['book_id']);//找到书籍所在机器ID
        $machine = D('Machine')->getByMgId($book['mg_id']);//找到机器的详情
        $arr['machine_name'] = $machine['machine_name'];//机器名称
        $arr['tiaoma'] = str_replace($book['library_id'],'',$arr['book_id']);//图书条码
        $arr['library'] = D('Library')->getById($book['library_id'])['name'];//找到图书馆名称
        $arr['library_id'] = $book['library_id'];//图书馆ID
        $bookDesc = D('BookDesc')->getByDescId($book['bk_desc_id']);//找到书籍详情
        $arr['title'] = $bookDesc['title'];//书名
        $arr['isbn'] = $bookDesc['isbn'];//isbn
        $this->lists = $arr;
        $this->co = $content;
        $this->menu = '盘点,书目信息有误(2)';
        $this->display();
    }

}