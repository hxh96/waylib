<?php
/**
 * 导航首页控制器
 */

namespace Run\Controller;


class IndexController extends RunController
{
    /**
     * 首页
     */
    public function index()
    {
        //图书馆ID
        $library_id = session('adminUser')['library_id'];
        $this->library = D('Library')->getById($library_id)['name'];
        //用户名(手机号)
        $this->phone = session('adminUser')['u_mobile'];
        $this->webTitle = '首页';
        $this->display();
    }
}