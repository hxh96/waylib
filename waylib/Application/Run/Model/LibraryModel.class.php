<?php
/**
 * Library图书馆表模型
 */

namespace Run\Model;


use Think\Model;

class LibraryModel extends Model
{
    //验证规则
    protected  $_validate = array(

    );

    //定义模型
    private $_db = '';
    public function __construct()
    {
        parent::__construct();

        $this->_db = M('Library');
    }


    /**
     * 根据ID查找图书馆
     * @param $library_id  图书馆ID
     * @return mixed
     */
    public function getById($library_id)
    {
        $re = $this->_db->where(array('id'=>$library_id))->find();
        return $re;
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
     * 根据ID删除一条数据
     * @param $id  图书馆ID
     * @return mixed
     */
    public function delLib($id)
    {
        $arr = $this->_db->where(array('id'=>$id))->delete();
        return $arr;
    }


    /**
     * 添加一条数据
     * @param array $data  数据
     * @return mixed
     */
    public function addLib(array $data)
    {
        $arr = $this->_db->add($data);
        return $arr;
    }

    /**
     * 修改一条数据
     * @param array $data  数据
     * @return bool
     */
    public function editLib(array $data)
    {
        $arr = $this->_db->save($data);
        return $arr;
    }
}