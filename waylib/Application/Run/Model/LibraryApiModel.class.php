<?php
/**
 * 图书馆Api模型
 */

namespace Run\Model;


use Think\Model;

class LibraryApiModel extends Model
{
    //验证规则
    protected $_validate = array(

    );

    //定义模型
    private $_db = '';
    public function __construct()
    {
        parent::__construct();

        $this->_db = M('LibraryApi');
    }


    /**
     * 根据图书馆ID找到数据
     * @param $LibraryId
     * @return mixed
     */
    public function getByLibraryId($LibraryId)
    {
        $re = $this->_db->where(array('library_id'=>$LibraryId))->select();
        return $re;
    }

    /**
     * 根据apiId找到数据
     * @param $apiId api_id
     * @return mixed
     */
    public function getByApiId($apiId)
    {
        $re = $this->_db->where(array('api_id'=>$apiId))->find();
        return $re;
    }


    /**
     * 添加一条数据
     * @param array $data 数据
     * @return mixed
     */
    public function addApi(array $data)
    {
        $re = $this->_db->add($data);
        return $re;
    }

    /**
     * 根据api_id删除
     * @param $apiId  api_id
     * @return mixed
     */
    public function delApi($apiId)
    {
        $re = $this->_db->where(array('api_id'=>$apiId))->delete();
        return $re;
    }

    /**
     * 编辑一条数据
     * @param array $data 数据
     * @return bool
     */
    public function editApi(array $data)
    {
        $re = $this->_db->save($data);
        return $re;
    }
}