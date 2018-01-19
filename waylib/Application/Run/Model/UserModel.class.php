<?php
/**
 * User用户表模型
 */

namespace Run\Model;


use Think\Model;

class UserModel extends Model
{
    //验证规则
    protected  $_validate = array(

    );

    //定义模型
    protected $_db = '';
    public function __construct()
    {
        parent::__construct();
        $this->_db = M('User');
    }


    /**
     * 查找用户名
     * @param $username  用户名(手机号)
     * @return mixed
     */
    public function getUsername($username)
    {
        $re = $this->_db->where(array('u_mobile'=>$username))->find();
        return $re;
    }


    /**
     * 根据用户ID返回一条数据
     * @param $userId  用户ID
     * @return mixed
     */
    public function getByUserId($userId)
    {
        $re = $this->_db->where(array('user_id'=>$userId))->find();
        return $re;
    }


    /**
     * 根据条件查询所有
     * @param array $map  条件
     * @return mixed
     */
    public function getAll(array $map = [])
    {
        $p   = getpage($this->_db,$map,15);
        $arr = $this->_db->where($map)->select();
        $res = array('lists'=>$arr,
            'page'=>$p->show()
        );
        return $res;
    }

    /**
     * 根据条件查询所有  返回数组
     * @param array $map  条件
     * @return mixed
     */
    public function getAllArr(array $map = []){
        $arr = $this->_db->where($map)->select();
        return $arr;
    }


    /**
     * 添加管理员
     * @param $data  添加数据
     * @return mixed
     */
    public function adminAdd($data)
    {
        $re = $this->_db->add($data);
        return $re;
    }


    /**
     * 更新数据
     * @param $data  数据
     * @return bool
     */
    public function updateData($data)
    {
        $re = $this->_db->save($data);
        return $re;
    }


}