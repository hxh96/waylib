<?php
/**
 * 管理员操作日志记录
 */

namespace Run\Model;


use Think\Model;

class AdminLogModel extends Model
{
    //验证规则
    protected $_validate = array(

    );


    //定义模型
    private $_db = '';
    public function __construct()
    {
        parent::__construct();
        $this->_db = M('AdminLog');
    }

    /**
     * 新增一条记录
     * @param array $data 数据
     */
    public function addData(array $data)
    {
        $re = $this->_db->add($data);
        return $re;
    }
}