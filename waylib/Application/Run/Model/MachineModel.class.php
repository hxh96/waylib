<?php
/**
 * Machine机器表模型
 */

namespace Run\Model;


use Think\Model;

class MachineModel extends Model
{
//验证规则
    protected  $_validate = array(

    );

    //定义模型
    private $_db = '';
    public function __construct()
    {
        parent::__construct();

        $this->_db = M('Machine');
    }


    /**
     * 根据图书馆ID查找机器
     * @param $LibraryId  图书馆ID
     * @return mixed
     */
    public function getByLibraryId($LibraryId)
    {
        $arr = $this->_db->where(array('library_id'=>$LibraryId))->select();
        return $arr;
    }


    /**
     * 根据条件查询所有
     * @param array $map  条件
     * @return array
     */
    public function getAll(array $map=[])
    {
        $p   = getpage($this->_db,$map,15);
        $arr = $this->_db->where($map)->select();
        $res = array('lists'=>$arr,
            'page'=>$p->show()
        );
        return $res;
    }


    /**
     * 根据机器ID找到一条数据
     * @param $mgId  机器ID
     * @return mixed
     */
    public function getByMgId($mgId)
    {
        $arr = $this->_db->where(array('machine_id'=>$mgId))->find();
        return $arr;
    }


    /**
     * 根据机器ID删除一条数据
     * @param $machId  机器ID
     * @return mixed
     */
    public function delMach($machId)
    {
        $arr = $this->_db->where(array('machine_id'=>$machId))->delete();
        return $arr;
    }


    /**
     * 添加一个机器
     * @param array $data 数据
     * @return mixed
     */
    public function addMach(array $data)
    {
        $arr = $this->_db->add($data);
        return $arr;
    }


    /**
     * 修改一个机器
     * @param array $data 数据
     * @return bool
     */
    public function editMach(array $data)
    {
        $arr = $this->_db->save($data);
        return $arr;
    }

}