<?php
/**
 * UserLend用户借阅表模型
 */

namespace Run\Model;


use Think\Model;

class UserLendModel extends Model
{
    //验证规则
    protected $_validate = array();


    //定义模型
    private $_db = '';

    public function __construct()
    {
        parent::__construct();
        $this->_db = M('UserLend');
    }


    /**
     * 根据条件查询所有
     * @param array $map  条件
     */
    public function getAll(array $map=[])
    {
        $arr = $this->_db
            ->where($map)
            ->join('waylib_book ON waylib_user_lend.book_id = waylib_book.book_id')
            ->select();
        return $arr;
    }


    /**
     * 根据用户ID找到所有
     * @param $userId  用户ID
     * @return mixed
     */
    public function getAllByUserId($userId)
    {
        $arr = $this->_db
            ->where(array('user_id'=>$userId))
            ->join('waylib_book ON waylib_user_lend.book_id = waylib_book.book_id')
            ->select();
        return $arr;
    }

    /**
     * 关联user表获取所有数据
     * @param array $map  条件
     * @return mixed
     */
    public function getAllJoinUser(array $map=[])
    {
        $arr = $this->_db
            ->field(
                array(
                    'waylib_user_lend.created_time'=>'lend_created_time',//借书时间
                    'waylib_user_lend.book_id',
                    'waylib_user_lend.u_user_lend_id',
                    'waylib_user_lend.updated_time'=>'lend_updated_time',//还书时间
                    'waylib_user_lend.lend_times',
                    'waylib_user_lend.is_back',
                    'waylib_user.u_pwd',
                    'waylib_user.u_type',
                    'waylib_user.u_photo',
                    'waylib_user.is_deposited',
                    'waylib_user.lend_num',
                    'waylib_user.gender',
                    'waylib_user.user_real_name',
                    'waylib_user.user_role',
                    'waylib_user.is_arrearage',
                    'waylib_user.arrearage_money',
                    'waylib_user.nick_name',
                    'waylib_user.address',
                    'waylib_user.is_backmoney',
                    'waylib_user.status',
                    'waylib_user.u_mobile',
                    'waylib_user.u_name',
                    'waylib_user.library_id',
                    'waylib_user.user_id',
                )
            )
            ->where($map)
            ->order('waylib_user_lend.created_time desc')
            ->join('waylib_user ON waylib_user_lend.user_id = waylib_user.user_id')
            ->select();
        return $arr;
    }



    /**
     * 关联user表获取一条数据
     * @param array $map  条件
     * @return mixed
     */
    public function getOneJoinUser(array $map=[])
    {
        $arr = $this->_db
            ->field(
                array(
                    'waylib_user_lend.created_time'=>'lend_created_time',//借书时间
                    'waylib_user_lend.book_id',
                    'waylib_user_lend.u_user_lend_id',
                    'waylib_user_lend.updated_time'=>'lend_updated_time',//还书时间
                    'waylib_user_lend.lend_times',
                    'waylib_user_lend.is_back',
                    'waylib_user.u_pwd',
                    'waylib_user.u_type',
                    'waylib_user.u_photo',
                    'waylib_user.is_deposited',
                    'waylib_user.lend_num',
                    'waylib_user.gender',
                    'waylib_user.user_real_name',
                    'waylib_user.user_role',
                    'waylib_user.is_arrearage',
                    'waylib_user.arrearage_money',
                    'waylib_user.nick_name',
                    'waylib_user.address',
                    'waylib_user.is_backmoney',
                    'waylib_user.status',
                    'waylib_user.u_mobile',
                    'waylib_user.u_name',
                    'waylib_user.library_id',
                    'waylib_user.user_id',
                )
            )
            ->where($map)
            ->order('waylib_user_lend.u_user_lend_id desc')
            ->join('waylib_user ON waylib_user_lend.user_id = waylib_user.user_id')
            ->find();
        return $arr;
    }



    /**
     * 根据lendId获取一条数据
     * @param $lendId  lendId
     * @return mixed
     */
    public function getByLendId($lendId)
    {
        $arr = $this->_db->where(array('u_user_lend_id'=>$lendId))->find();
        return $arr;
    }

    /**
     * 根据bookId获取数据
     * @param $map  条件
     * @return mixed
     */
    public function getAllByBookId(array $map)
    {
        $arr = $this->_db->where($map)->select();
        return $arr;
    }



    /**
     * 更新数据
     * @param array $data  数据
     * @return bool
     */
    public function updateDate(array $data)
    {
        $re = $this->_db->save($data);
        return $re;
    }


}