<?php
/**
 * 订阅管理控制器
 */

namespace Run\Controller;


class SubscribeController extends RunController
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
        $this->webTitle = '订阅管理';//标题
        $this->titleUrl = U('Subscribe/index');
        $this->library_id = session('adminUser')['library_id'];

    }

    /**
     * 订阅列表
     */
    public function index()
    {
        $map['waylib_bespeak.status'] = 1;//默认展示预约的数据
        //判断身份
        if($this->library_id === "SCYT001"){
            $this->status = 1;

        }else{
            $this->status = 0;
            $map['waylib_bespeak.library_id'] =$this->library_id;//只展示所属图书馆的预约
        }

        $get = I('get.');
        //搜索
        if(!empty($get['ty'])){
            //判断是否根据手机或读者号
            if(!empty($get['co'])){
                $map[$get['ty']] = array('like','%'.$get['co'].'%');
                $this->content = $get['co'];
            }
            //判断预约状态
            if(!empty($get['bS'])){
                $map['waylib_bespeak.status'] = $get['bS'];
            }
            //判断是否选择区间
            if(!empty($get['st']) && !empty($get['end'])){
                $map['create_time'] = array(array('gt',$get['st']),array('lt',$get['end']));//定义区间
                $this->start = $get['st'];
                $this->end = $get['end'];
            }
        }
        //关联user表获取数据
        $arr = D('Bespeak')->getAllJoinUser($map);
        foreach($arr as &$v){
            $v['library'] = D('Library')->getById($v['library_id'])['name'];//图书馆名称
            $bookdesc = D('BookDesc')->getByDescId($v['book_desc_id']);//书籍详情
            $v['title'] = $bookdesc['title'];//书名
            $v['author'] = $bookdesc['author'];//作者
            $v['publisher'] = $bookdesc['publisher'];//出版社
            $v['isbn'] = $bookdesc['isbn'];//ISBN
        }
        $lists = Page($arr,15);//分页
        $this->lists = $lists['lists'];
        $this->page = $lists['page'];
        //订阅状态
        $bes_status = C('bes_status');
        $this->bes_status = $bes_status;//订阅状态
        $this->menu = '订阅列表';
        $this->display();
    }

    /**
     * 更改状态
     */
    public function checkStatus()
    {
        $data['id'] = I('get.id');
        $uId = I('get.uId');
        $data['status'] = I('get.status');
        if($data['status'] == 1){//更改为预约
            $map['status'] = 1;
            $map['user_id'] = $uId;
            $arr = D('Bespeak')->getAll($map);
            //判断该用户是否已经存在两本在预约的书籍
            if(count($arr)>=2){
                echo show(0,'该用户已存在两本预约书籍');
                exit;
            }
        }
        $re = D('Bespeak')->updateData($data);
        if($re){
            echo show(1,'修改成功');
        }else{
            echo show(0,'修改失败');
        }
    }
}