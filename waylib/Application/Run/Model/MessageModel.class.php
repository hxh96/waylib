<?php
/**
 * Message用户反馈表模型
 */

namespace Run\Model;


use Think\Model;

class MessageModel extends Model
{
    //验证规则
    protected $_validate = array(

    );

    //定义模型
    private $_db = '';
    public function __construct()
    {
        parent::__construct();

        $this->_db = M('Message');
    }


    /**
     * 查找一条
     * @param array  $map  条件
     * @return mixed
     */
    public function getOne(array $map)
    {
        $re = $this->_db->where($map)->find();
        return $re;
    }


    /**
     * 根据条件查询所有
     * @param array $map  条件
     * @return mixed
     */
    public function getAll(array $map = [])
    {
        $arr = $this->_db
            ->where($map)
            ->join('waylib_user ON waylib_message.user_id = waylib_user.user_id')
            ->select();
        return $arr;
    }


}