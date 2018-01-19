<?php
/**
 * 订阅waylib_bespeak表
 */

namespace Run\Model;


use Think\Model;

class BespeakModel extends Model
{
    //验证规则
    protected $_validate = array();

    //定义模型
    private $_db = '';

    public function __construct()
    {
        parent::__construct();

        $this->_db = M('Bespeak');
    }

    /**
     * 关联user表查询所有记录
     * @param array $map 条件
     * @return mixed
     */
    public function getAllJoinUser(array $map)
    {
        $arr = $this->_db
            ->field(
                array(
                    'waylib_bespeak.id',
                    'waylib_bespeak.library_id',
                    'waylib_bespeak.book_desc_id',
                    'waylib_bespeak.status',
                    'waylib_bespeak.remarks',
                    'waylib_bespeak.user_id',
                    'waylib_bespeak.is_notice',
                    'waylib_bespeak.create_time',
                    'waylib_bespeak.update_time',
                    'waylib_user.u_name',
                    'waylib_user.u_mobile',
                    'waylib_user.user_id',
                )
            )
            ->where($map)
            ->join('waylib_user ON waylib_bespeak.user_id = waylib_user.user_id')
            ->select();
        return $arr;
    }


    /**
     * 更新数据
     * @param array $data 数据
     * @return bool
     */
    public function updateData(array $data)
    {
        $re = $this->_db->save($data);
        return $re;
    }


    /**
     * 根据条件查询数据
     * @param $map  条件
     * @return mixed
     */
    public function getAll($map)
    {
        $re = $this->_db->where($map)->select();
        return $re;
    }

}