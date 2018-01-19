<?php
/**
 * BookDesc书籍详情表模型
 */

namespace Run\Model;


use Think\Model;

class BookDescModel extends Model
{
    //验证规则
    protected $_validate = array(

    );

    //定义模型
    private $_db = '';
    public function __construct()
    {
        parent::__construct();

        $this->_db = M('BookDesc');
    }

    /**
     * 根据条件查询所有
     * @param array $map  条件
     * @return array
     */
    public function getAll(array $map=[])
    {
        $p   = getpage($this->_db,$map,10);
        $arr = $this->_db->where($map)->select();
        $res = array('lists'=>$arr,
            'page'=>$p->show()
        );
        return $res;
    }

    /**
     * 根据书籍详情ID找到对应的详情
     * @param $descId  详情ID
     * @return mixed
     */
    public function getByDescId($descId)
    {
        $re = $this->_db->where(array('book_desc_id'=>$descId))->find();
        return $re;
    }


    /**
     * 更新数据
     * @param $data   数据
     */
    public function updateData($data)
    {
        $re = $this->_db->save($data);
        return $re;
    }


    /**
     * 新增一条
     * @param array $data  新增数据
     * @return mixed
     */
    public function addData(array $data)
    {
        $re = $this->_db->add($data);
        return $re;
    }

}