<?php
/**
 * MachineLattice机器表详情模型
 */

namespace Run\Model;


use Think\Model;

class MachineLatticeModel extends Model
{
    //验证规则
    protected  $_validate = array(

    );

    //定义模型
    private $_db = '';
    public function __construct(){
        parent::__construct();
        $this->_db = M('MachineLattice');
    }

    /**
     * 根据条件查询所有
     * @param array $map  条件
     * @return array
     */
    public function getAll(array $map=[])
    {
        $arr = $this->_db->where($map)->select();
        return $arr;
    }


    /**
     * 根据条件关联book表查询数据
     * @param array $map  条件
     * @return mixed
     */
    public function getAllJoinBook(array $map = [])
    {
        $arr = $this->_db->where($map)
            ->join('waylib_book ON waylib_machine_lattice.book_id = waylib_book.book_id')
            ->select();
        return $arr;
    }


    /**
     * 根据机器ID返回所有
     * @param $machId  机器ID
     * @return mixed
     */
    public function getByMachIdToAll($machId)
    {
        $arr = $this->_db->where(array('mach_id'=>$machId))->select();
        return $arr;
    }


    /**
     * 根据机器ID获取机器信息
     * @param $machId  机器ID
     * @return mixed
     */
    public function getByMachId($machId)
    {
        $map['mach_id'] = $machId;
        $map['book_id'] = array('neq','');
        $arr = $this->_db->where($map)->order('sort asc')->select();
        return $arr;
    }

    /**
     * 根据bookId查询一条数据
     * @param $bookId  BookId
     * @return mixed
     */
    public function getByBookId($bookId)
    {
        $arr = $this->_db->where(array('book_id'=>$bookId))->find();
        return $arr;
    }


    /**
     * 根据序号更新排序
     * @param $latNum  格子ID
     * @param $machId  机器ID
     * @param $sort   序号
     * @return bool
     */
    public function updateSort($latNum,$machId,$sort)
    {

        $map['mach_id'] = $machId;
        $map['book_id'] = array('neq','');
        $map['mach_lat_num'] = array('neq',$latNum);


        $rand = rand('1111','9999')/10000;//生成随机数

        if($sort<=1){//排到第一
            $arr = $this->_db->where($map)->order('sort asc')->limit(0,1)->select();//找出第一条数据
            $data['sort'] = $arr[0]['sort']-$rand;
        }elseif($sort == 2){//排到第二
            $arr = $this->_db->where($map)->order('sort asc')->limit(0,2)->select();//找出第一条数据
            $cha = $arr[1]['sort']-$arr[0]['sort'];//两条数据之间的序号差
            $data['sort'] = $arr[0]['sort']+$cha-0.001;//比第二条数据小0.001
        }else{//排到第三及以上
            $arr = $this->_db->where($map)->order('sort asc')->limit($sort-2,$sort-1)->select();//找出排序序号上下的两条数据
            $cha = $arr[1]['sort']-$arr[0]['sort'];//两条数据之间的序号差
            $data['sort'] = $arr[0]['sort']+$cha-0.001;//比第二条数据小0.001
        }
        $map2['mach_id'] = $machId;
        $map2['mach_lat_num'] = $latNum;
        $ar = $this->_db->where($map2)->find();//找到需要修改排序的记录

        $re = $this->_db->where(array('mach_lat_id'=>$ar['mach_lat_id']))->save($data);//更新排序

        return $re;

    }


    /**
     * 更新数据
     * @param  $bookId   bookId
     * @param  array $data  数据
     * @return bool
     */
    public function updateDataWhereBookId($bookId,array $data)
    {
        $re = $this->_db->where(array('book_id'=>$bookId))->save($data);
        return $re;
    }

}