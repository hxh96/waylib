<?php
/**
 * Book书籍表模型
 */

namespace Run\Model;


use Think\Model;

class BookModel extends Model
{
    //验证规则
    protected $_validate = array(

    );

    //定义模型
    private $_db = '';
    public function __construct()
    {
        parent::__construct();
        $this->_db = M('Book');
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
     * 根据bookID查找一条数据
     * @param $bookId book_id
     * @return mixed
     */
    public function getByBookId($bookId)
    {
        $arr = $this->_db->where(array('book_id'=>$bookId))->find();
        return $arr;
    }

    /**
     * 根据bookid查找一条数据
     * @param $bookId  书籍ID
     * @return mixed
     */
    public function getByIdtoBookDesc($bookId)
    {


        $re = $this->_db
            ->where(array('book_id'=>$bookId))
            ->join('waylib_book_desc ON waylib_book.bk_desc_id = waylib_book_desc.book_desc_id')
            ->find();
        return $re;
    }


    /**
     * 根据详情ID查询数据
     * @param $descId 详情ID
     * @return mixed
     */
    public function getAllByDescId($descId)
    {
        $arr = $this->_db->where(array('bk_desc_id'=>$descId))
            ->join('waylib_book_desc ON waylib_book.bk_desc_id = waylib_book_desc.book_desc_id')
            ->select();
        return $arr;
    }

    /**
     * 根据book_id删除数据
     * @param $bookId  book_ID
     * @return mixed
     */
    public function delBook($bookId)
    {
        $re = $this->_db->where(array('book_id'=>$bookId))->delete();
        return $re;
    }


    /**
     * 修改书籍
     * @param array $data  书籍
     * @param $bookId  bookId
     * @return bool
     */
    public function updateBook($bookId,array $data)
    {
        $re = $this->_db->where(array('book_id'=>$bookId))->save($data);
        return $re;
    }
}