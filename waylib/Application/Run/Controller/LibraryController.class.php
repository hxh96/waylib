<?php
/**
 * 图书馆管理控制器
 */

namespace Run\Controller;


class LibraryController extends RunController
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
        $this->webTitle = '图书馆管理';//标题
        $this->titleUrl = U('Library/index');
        $this->library_id = session('adminUser')['library_id'];

    }


    /**
     * 图书馆列表
     */
    public function index()
    {
        //判断身份
        if($this->library_id === "SCYT001"){
            $this->status = 1;
            //搜索
            $libName = I('get.libName');
            if(!$libName){
                $map = [] ;
            }else{
                $map['name'] = ['like','%'.$libName.'%'];//根据图书馆名称
            }
            $librarys = D('Library')->getAll($map);//根据条件找到图书馆列表
            $sys_types = C('sys_type');//获取配置文件信息(图书馆操作系统)
            foreach($librarys as &$v){//遍历操作系统名称
                foreach($sys_types as $sys_type){
                    if($sys_type['id'] == $v['sys_type']){
                        $v['sys_type'] = $sys_type['name'];
                    }
                }
            }
            $arr = Page($librarys,15);//分页
            $this->lists = $arr['lists'];
            $this->page = $arr['page'];
            $this->libName = $libName;//分配搜索的内容
            $this->sys_types = $sys_types;//分配操作系统
        }else{
            $this->status = 0;
        }
        $this->menu = '图书馆列表';
        $this->display();
    }


    /**
     * 机器列表
     * @param $libId  图书馆ID
     */
    public function mach($libId)
    {
        $arr = D('Machine')->getByLibraryId($libId);//找到机器
        foreach($arr as &$v){
            $v['library'] = D('Library')->getById($v['library_id'])['name'];//找到图书馆名称
        }
        $this->libName = D('Library')->getById($libId)['name'];//分配图书馆名称
        $lists = Page($arr,15);//分页
        $this->lists = $lists['lists'];
        $this->page = $lists['page'];
        $this->menu = '机器列表';
        $this->libId = $libId;//分配图书馆ID
        $this->display();
    }


    /**
     * 图书馆API列表
     * @param $libId  图书馆ID
     */
    public function api($libId)
    {
        $arr = D('LibraryApi')->getByLibraryId($libId);//找到API
        foreach($arr as &$v){
            $v['library'] = D('Library')->getById($v['library_id'])['name'];//找到图书馆名称
        }
        $this->libName = D('Library')->getById($libId)['name'];//分配图书馆名称
        $lists = Page($arr,15);//分页
        $this->lists = $lists['lists'];
        $this->page = $lists['page'];
        $this->menu = 'API列表';
        $this->libId = $libId;//分配图书馆ID
        $this->display();
    }


    /**
     * 在架图书列表
     * @param $libId  图书馆ID
     * @param $machId  机器ID
     */
    public function showBook($libId,$machId)
    {
        //条件
        $map['waylib_machine_lattice.mach_id'] = $machId;
        $map['waylib_machine_lattice.book_id'] = array('neq','');
        $re = D('MachineLattice')->getAllJoinBook($map);//关联book表查询数据
        foreach($re as &$v){
            $list = D('BookDesc')->getByDescId($v['bk_desc_id']);//根据book_desc_id找到数据
            $v['library'] = D('Library')->getById($v['library_id'])['name'];//图书馆名
            $v['title'] = $list['title'];//书名
            $v['isbn'] = $list['isbn'];//isbn
            $v['author'] = $list['author'];//作者
            $v['tiaoma'] = str_replace($v['library_id'],'',$v['book_id']);//图书条码
        }
        $arr = Page($re,15);
        $this->lists = $arr['lists'];
        $this->page = $arr['page'];
        $this->libId = $libId;//图书馆ID
        $this->machName = D('Machine')->getByMgId($machId)['machine_name'];//机器名称
        $this->menu = '在架图书';
        $this->display();
    }


    /**
     * 编辑机器(分配数据)
     */
    public function machOne()
    {
        $machId = I('get.machId');
        $re  = D('Machine')->getByMgId($machId);//根据ID查找数据
        if($re){
            $re['library'] = D('Library')->getById($re['library_id'])['name'];
            echo show(1,'存在',$re);
        }else{
            echo show(0,'数据不存在',$re);
        }
    }

    /**
     * 编辑api(分配数据)
     */
    public function apiOne()
    {
        $apiId = I('get.apiId');
        $re  = D('LibraryApi')->getByApiId($apiId);//根据ID查找数据
        if($re){
            $re['library'] = D('Library')->getById($re['library_id'])['name'];
            echo show(1,'存在',$re);
        }else{
            echo show(0,'数据不存在',$re);
        }
    }




    /**
     * 添加图书馆
     */
    public function addLib()
    {
        $data = I('post.');//接受参数
        $re  = D('Library')->getById($data['id']);//根据ID查找数据
        if($re){//判断ID是否存在
            echo show(0,'该图书馆ID已存在');
        }else{
            $re = D('Library')->addLib($data);//添加
            if($re){
                echo show(1,'添加成功');
            }else{
                echo show(0,'添加失败');
            }
        }
    }

    /**
     * 添加API
     */
    public function addApi()
    {
        $data = I('post.');//接受参数
        $re = D('LibraryApi')->addApi($data);//添加
        if($re){
            echo show(1,'添加成功');
        }else{
            echo show(0,'添加失败');
        }
    }


    /**
     * 编辑图书馆
     */
    public function editLib()
    {
        $data = I('post.');//接受参数
        $re = D('Library')->editLib($data);//修改
        if($re){
            echo show(1,'修改成功');
        }else{
            echo show(0,'修改失败');
        }
    }


    /**
     * 编辑机器
     */
    public function editMach()
    {
        $data = I('post.');//接受参数
        $re = D('Machine')->editMach($data);//修改
        if($re){
            echo show(1,'修改成功');
        }else{
            echo show(0,'修改失败');
        }
    }


    /**
     * 编辑API
     */
    public function editApi()
    {
        $data = I('post.');//接受参数
        $re = D('LibraryApi')->editApi($data);//修改
        if($re){
            echo show(1,'修改成功');
        }else{
            echo show(0,'修改失败');
        }
    }


    /**
     * 添加机器
     */
    public function addMach()
    {
        $data = I('post.');//接受参数
        $re  = D('Machine')->getByMgId($data['machine_id']);//根据ID查找数据
        if($re){//判断ID是否存在
            echo show(0,'该机器ID已存在');
        }else{
            $re = D('Machine')->addMach($data);//添加
            if($re){
                echo show(1,'添加成功');
            }else{
                echo show(0,'添加失败');
            }
        }
    }


    /**
     * 编辑框查找数据
     */
    public function select()
    {
        $id = I('get.id');
        $re  = D('Library')->getById($id);//根据ID查找数据
        $sys_types = C('sys_type');//获取配置文件信息(图书馆操作系统)
        if($re){
            array_push($re,$sys_types);
            echo show(1,'存在',$re);
        }else{
            echo show(0,'数据不存在',$re);
        }
    }


    /**
     * 删除图书馆
     */
    public function delLib()
    {
        $id = I('get.id');
        $machine = D('Machine')->getByLibraryId($id);//根据图书馆ID查找机器
        if($machine){//判断是否存在机器
            echo show(0,'请先删除图书馆的机器');
        }else{
            $LibraryApi = D('LibraryApi')->getByLibraryId($id);//根据图书馆ID查找API
            if($LibraryApi){//判断是否存在API
                echo show(0,'请先删除图书馆的API');
            }else{
                $re = D('Library')->delLib($id);//根据图书馆ID删除
                if($re){
                    echo show(1,'删除成功');
                }else{
                    echo show(0,'删除失败');
                }
            }
        }
    }



    /**
     * 删除机器
     */
    public function delMach()
    {
        $machId = I('get.id');
        $lattice = D('MachineLattice')->getByMachIdToAll($machId);//根据机器ID查找格子数据
        if($lattice){//判断是否存在格子
            echo show(0,'请先删除机器的格子');
        }else{
            $re = D('Machine')->delMach($machId);//根据机器ID删除
            if($re){
                echo show(1,'删除成功');
            }else{
                echo show(0,'删除失败');
            }
        }
    }

    /**
     * 删除API
     */
    public function delApi()
    {
        $apiId = I('get.id');
        $re = D('LibraryApi')->delApi($apiId);//根据机器ID删除
        if($re){
            echo show(1,'删除成功');
        }else{
            echo show(0,'删除失败');
        }
    }
}