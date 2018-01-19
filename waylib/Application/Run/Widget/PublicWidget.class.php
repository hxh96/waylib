<?php
namespace Run\Widget;
use Think\Controller;

class PublicWidget extends Controller {

  //用户管理菜单
  public function user_menus(){
    $html = '<div class="main_left_ul">
		<ul>
			<li class="outer">
				<a href="'.U('User/index').'">
					<img src="'.__ROOT__.'/Public/Run/img/dzgl.png" />
					<p>读者管理</p>
				</a>
			</li>
			<li class="outer">
				<a href="'.U('User/administer').'">
					<img src="'.__ROOT__.'/Public/Run/img/glygl.png" />
					<p>管理员管理</p>
				</a>
			</li>
		</ul>
	</div>';

    echo $html;
  }

  //直接编目菜单
  public function catalog_menus()
  {
    $html = '<div class="main_left_ul">
                <ul>
                    <li class="outer">
                        <a href="'.U('Catalog/index').'" class="outer">
                            <img src="'.__ROOT__.'/Public/Run/img/zjbm.png" />
                            <p>直接编目</p>
                        </a>
                    </li>
                    <li class="outer">
                        <a href="'.U('Catalog/audit').'" class="outer">
                            <img src="'.__ROOT__.'/Public/Run/img/fmsh.png" />
                            <p>封面审核</p>
                        </a>
                    </li>
                </ul>
            </div>';

    echo $html;
  }


  //图书馆管理菜单
  public function library_menus()
  {
    $html = '<div class="main_left_ul">
						<ul>
							<li class="outer">
								<a href="'.U('Library/index').'" class="outer">
									<img src="'.__ROOT__.'/Public/Run/img/tsglb.png" />
									<p>图书馆列表</p>
								</a>
							</li>
						</ul>
					</div>';

    echo $html;
  }


  //借阅查询菜单
  public function borrow_menus()
  {
    $html = '<div class="main_left_ul">
						<ul>
							<li class="outer">
								<a href="'.U('Borrow/index').'" class="outer">
									<img src="'.__ROOT__.'/Public/Run/img/dqjy.png" />
									<p>当前借阅</p>
								</a>
							</li>
							<li class="outer">
								<a href="'.U('Borrow/hisBorrow').'" class="outer">
									<img src="'.__ROOT__.'/Public/Run/img/lsjy.png" />
									<p>历史借阅</p>
								</a>
							</li>
						</ul>
					</div>';

    echo $html;
  }


  //订阅管理菜单
  public function subscribe_menus()
  {
    $html = '<div class="main_left_ul">
						<ul>
							<li class="outer">
								<a href="'.U('Subscribe/index').'" class="outer">
									<img src="'.__ROOT__.'/Public/Run/img/dy.png" />
									<p>订阅管理</p>
								</a>
							</li>
						</ul>
					</div>';

    echo $html;
  }


  //异常处理菜单
  public function exception_menus()
  {
    $html = '<div class="main_left_ul">
						<ul>
							<li class="outer">
								<a href="'.U('Exception/index').'" class="outer">
									<img src="'.__ROOT__.'/Public/Run/img/yicang.png" />
									<p>异常处理</p>
								</a>
							</li>
						</ul>
					</div>';

    echo $html;
  }


  //异常处理顶部菜单列表
  public function exception_lists()
  {
    $html = '<div class="Box">
					    	<div class="content">
					    		<div class="Box_con clearfix">
					    			<span class="btnl btn" id="btnl"></span>
					    			<span class="btnr btn" id="btnr"></span>
					    			<div class="conbox" id="BoxUl">
						    			<ul class="swiper-wrapper">
						    				<li class="cur">
						    					<a href="'.U('Exception/handle1_1').'" class="hua1">借书成功，柜中无书</a>
						    				</li>
						    				<li class="cur ">
						    					<a href="'.U('Exception/handle2_1').'" class="hua2">借书成功，书目信息有误</a>
						    				</li>

						    				<li class="cur ">
						    					<a href="'.U('Exception/handle3_1').'" class="hua3">盘点，系统有书，柜中无书</a>
						    				</li>

						    				<li class="cur ">
						    					<a href="'.U('Exception/handle4_1').'" class="hua4">盘点，系统无书，柜中有书</a>
						    				</li>

						    				<li class="cur ">
						    					<a href="'.U('Exception/handle5_1').'" class="hua5">盘点数目信息有误</a>
						    				</li>
						    				<li class="cur ">
						    					<a href="'.U('Exception/handle6_1').'" class="hua6">遇到新的异常，提交反馈</a>
						    				</li>
					    				</ul>
					    			</div>
					    		</div>
				    		</div>
			   			</div>';

    echo $html;
  }



}