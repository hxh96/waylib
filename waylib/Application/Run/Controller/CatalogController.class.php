<?php
/**
 * 直接编目管理控制器
 */

namespace Run\Controller;


class CatalogController extends RunController
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
        $this->webTitle = '直接编目';//标题
        $this->titleUrl = U('Catalog/index');
        $this->library_id = session('adminUser')['library_id'];
    }

    /**
     * 直接编目
     */
    public function index()
    {
        //判断是否存在权限
        if($this->library_id === "SCYT001"){
            $this->status = 1;
            $get = I('get.');
            //判断搜索条件
            if($get['ty'] == 'all'){
                $map['title'] =['like','%'.$get['ti'].'%'];
                $map['isbn'] =['like','%'.$get['is'].'%'];
            }elseif($get['ty'] == 'title'){
                $map['title'] =['like','%'.$get['ti'].'%'];
            }elseif($get['ty'] == 'isbn'){
                $map['isbn'] =['like','%'.$get['is'].'%'];
            }else{
                $map['large'] = '123';//不知名的条件
            }

            $arr = D('BookDesc')->getAll($map);
            //找到藏书量
            foreach($arr['lists'] as &$v){
                $v['price'] = $v['price']/100;//价格
                $map2['bk_desc_id'] = $v['book_desc_id'];//书籍详情ID
                $arr2 = D('Book')->getAll($map2);//找到book表中对应的数据
                $count = count($arr2['lists']);//计算条数
                $v['count'] = $count;
            }
            $this->lists = $arr['lists'];
            $this->page = $arr['page'];
        }else{
            $this->status = 0;
        }
        $this->menu = '直接编目';
        $this->display();
    }


    /**
     * 新增书目
     */
    public function addCata()
    {
        $this->menu = '新增书目';
        $this->display();
    }

    /**
     * 新增书目
     */
    public function add()
    {
        $data = I('post.');
        $re = D('BookDesc')->addData($data);
        if($re){
            echo show(1,'添加成功');
        }else{
            echo show(0,'添加失败');
        }
    }


    /**
     * 编辑书目
     */
    public function editCata($id)
    {
        $list = D('BookDesc')->getByDescId($id);
        $this->assign($list);
        $this->menu = '编辑书目';
        $this->display();
    }

    /**
     * 编辑书目
     */
    public function edit()
    {
        $data = I('post.');
        $re = D('BookDesc')->updateData($data);
        if($re){
            echo show(1,'编辑成功');
        }else{
            echo show(0,'编辑失败');
        }
    }


    /**
     * 查看藏书
     */
    public function collectBook()
    {
        $descId = I('get.descId');//详情ID
        $re = D('Book')->getAllByDescId($descId);//根据详情ID查找藏书
        foreach($re as &$v){
            $v['tiaoma'] = str_replace($v['library_id'],'',$v['book_id']);//图书条码
        }
        if($re){
            echo show(1,'存在',$re);
        }else{
            echo show(0,'藏书不存在');
        }
    }


    /**
     * 删除藏书
     */
    public function delBook()
    {
        $bookId = I('get.bookId');//书籍ID
        $re = D('Book')->delBook($bookId);//根据书籍ID删除
        if($re){
            echo show(1,'删除成功');
        }else{
            echo show(0,'删除失败');
        }
    }


    /**
     * 修改条码
     */
    public function editTiaoma()
    {
        $tiaoma = I('get.tiaoma');//新条码
        $libId = I('get.libId');//新条码
        $bookId = I('get.bookId');//书籍ID
        $data['book_id'] = $tiaoma.$libId;//拼接新条码
        $re = D('Book')->updateBook($bookId,$data);//更新
        if($re){
            echo show(1,'修改成功');
        }else{
            echo show(0,'修改失败');
        }
    }


    /**
     *封面审核
     */
    public function audit()
    {
        //判断是否存在权限
        if($this->library_id === "SCYT001"){
            $this->status = 1;
            $get = I('get.cStatus');
            if($get == 1){
                $map['cover_status'] = 1;
            }else{
                $map['cover_status'] = 0;
            }
            $this->cStatus = $get;//分配状态
            //查询
            $arr = D('BookDesc')->getAll($map);
            $this->lists = $arr['lists'];
            $this->page = $arr['page'];
        }else{
            $this->status = 0;
        }
        $this->menu = '封面审核';
        $this->display();
    }


    /**
     * 通过审核
     */
    public function auditEdit()
    {
        $data['book_desc_id'] = I('get.book_desc_id');
        $data['cover_status'] = 1;
        $re = D('BookDesc')->updateData($data);
        if($re){
            echo show(1,'审核成功');
        }else{
            echo show(0,'审核失败');
        }

    }


    /**
     * 批量审核
     */
    public function auditEditAll()
    {
        $ids = I('post.ids');//接受ID
        if(!$ids){
            echo show(0,'请先选中一条信息');
        }else{
            $ids = explode(',',$ids);//转换为数组
            for($k=0;$k<count($ids);$k++)//循环更新状态
            {
                $data['book_desc_id'] = $ids[$k];
                $data['cover_status'] = 1;
                $re = D('BookDesc')->updateData($data);
                if($re){
                    $code = 1;
                }else{
                    $code = 0;
                }
            }
            if($code == 1){
                echo show(1,'批量审核成功');
            }else{
                echo show(0,'批量审核失败');
            }
        }
    }


    /**
     * 上传封面
     * @param $id  书籍ID
     */
    public function upload($id)
    {
        $list = D('BookDesc')->getByDescId($id);
        $this->assign($list);
        $this->menu = '上传封面';
        $this->display();
    }
}