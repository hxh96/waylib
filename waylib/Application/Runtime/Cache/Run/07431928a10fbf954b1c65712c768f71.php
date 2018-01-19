<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo ($webTitle); ?>|智能微图后台管理系统</title>
		<link rel="stylesheet" href="/Public/Run/css/base.css" />
		<link rel="stylesheet" href="/Public/Run/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/Public/Run/css/common.css" />
		<link rel="stylesheet" href="/Public/Run/css/main.css" />
		<link rel="stylesheet" href="/Public/Run/css/loginDialog.css" />
		<link rel="stylesheet" href="/Public/Run/css/laydate.css" />
		<link rel="stylesheet" href="/Public/Run/css/laydate1.css" />
		<script type="text/javascript" src="/Public/Run/js/jquery-1.12.0.min.js" ></script>
		<script type="text/javascript" src="/Public/Run/js/jquery.select.js" ></script>
		<script type="text/javascript" src="/Public/Run/js/sha1.js"></script>
		<script type="text/javascript" src="/Public/Run/js/index.js" ></script>
		<script type="text/javascript" src="/Public/Run/js/layer/layer.js" ></script>
		<script type="text/javascript" src="/Public/Run/js/dialog.js" ></script>
		<script type="text/javascript" src="/Public/Run/js/base64.js"></script>
		<script type="text/javascript" src="/Public/Run/js/laydate.js" ></script>
		<script type="text/javascript" src="/Public/Run/js/run.js" ></script>
		
	</head>
	<body>
		
		<div class="main outer">
			<div class="main_left">
				<div class="main_left_top">
					<a href="<?php echo U('Index/index');?>"><img src="/Public/Run/img/logo.png" /></a>
				</div>
				<div class="main_left_info">
					<div class="super outer">
						<div class="super_left">
							<img src="<?php echo ((isset($photo) && ($photo !== ""))?($photo):'/Public/Run/img/mrtx.png'); ?>" />
						</div>
						<div class="super_right">
							<p class="guanli_name"><?php echo ((isset($username) && ($username !== ""))?($username):'管理员'); ?><span>[<?php echo ($role); ?>]</span></p>
							<a href="<?php echo U('Login/checkPwd',['uId'=>$uId]);?>">修改密码</a>
						</div>
						<div class="tc1">
							<a href="javaScript:;">
								<img src="/Public/Run/img/tc1.png" id="loginOut"/>
							</a>
						</div>
					</div>
					<script>
						$(function(){
							//退出登录
							$('#loginOut').click(function(){
								var url  = "<?php echo U('Login/loginOut');?>";
								var jump_url = "<?php echo U('Login/index');?>";
								$.ajax({
									type:'get',
									url:url,
									data:'',
									dataType:'json',
									success:function(data){
										if(data.code == 1) {
											return dialog.success(data.message, jump_url);
										}else {
											return dialog.error(data.message);
										}
									}
								});
							});
						})
					</script>

					<!--左侧菜单开始-->
					
	<?php echo W('Public/user_menus');?>

					<!--左侧菜单结束-->
				</div>
			</div>
			<div class="main_right">
				<div class="main_right_top">
					<ul>
						<li>
							<a href="<?php echo U('User/index');?>">
								<img src="/Public/Run/img/icon1/yonghuguanli.png" class="icon1"/>
								<img src="/Public/Run/img/icon/yonghuguanli.png" class="icon2"/>
								<p>用户管理</p>
							</a>
						</li>
						<li>
							<a href="<?php echo U('Borrow/index');?>">
								<img src="/Public/Run/img/icon1/chaxun.png" class="icon1"/>
								<img src="/Public/Run/img/icon/chaxun.png" class="icon2"/>
								<p>借阅查询</p>
							</a>
						</li>
						<li>
							<a href="#">
								<img src="/Public/Run/img/icon1/jiankong.png" class="icon1"/>
								<img src="/Public/Run/img/icon/jiankong.png" class="icon2"/>
								<p>视频监控</p>
							</a>
						</li>
						<li>
							<a href="<?php echo U('Catalog/index');?>">
								<img src="/Public/Run/img/icon1/bianmu.png" class="icon1"/>
								<img src="/Public/Run/img/icon/bianmu.png" class="icon2"/>
								<p>直接编目</p>
							</a>
						</li>
						<li>
							<a href="<?php echo U('Subscribe/index');?>">
								<img src="/Public/Run/img/icon1/dingyue.png" class="icon1"/>
								<img src="/Public/Run/img/icon/dingyue.png" class="icon2"/>
								<p>订阅管理</p>
							</a>
						</li>
						<li>
							<a href="#">
								<img src="/Public/Run/img/icon1/dashuju.png" class="icon1"/>
								<img src="/Public/Run/img/icon/dashuju.png" class="icon2"/>
								<p>大数据</p>
							</a>
						</li>
						<li>
							<a href="#">
								<img src="/Public/Run/img/icon1/yichang.png" class="icon1"/>
								<img src="/Public/Run/img/icon/yichang.png" class="icon2"/>
								<p>异常处理</p>
							</a>
						</li>
						<li>
							<a href="<?php echo U('Library/index');?>">
								<img src="/Public/Run/img/icon1/tushu.png" class="icon1"/>
								<img src="/Public/Run/img/icon/tushu.png" class="icon2"/>
								<p>图书馆管理</p>
							</a>
						</li>
						<li>
							<a href="<?php echo U('App/index');?>">
								<img src="/Public/Run/img/icon1/app.png" class="icon1"/>
								<img src="/Public/Run/img/icon/app.png" class="icon2"/>
								<p>APP管理</p>
							</a>
						</li>
					</ul>
				</div>
				<div class="main_right_bottom">
					<div class="weizhi">
						<p>
							<a href="<?php echo U('Index/index');?>">首页></a>
							<a href="<?php echo ($titleUrl); ?>"><?php echo ($webTitle); ?>></a>
							<span><?php echo ($menu); ?></span>
						</p>
					</div>
					<!--主体内容开始-->
					
					<div class="info">
						<div class="info_left">
							<div class="info_left_top">
								<img src="/Public/Run/img/tsgyhyy.png" class="circle"/>
								<div class="top_head">
									<img src="<?php echo ((isset($u_photo) && ($u_photo !== ""))?($u_photo):'/Public/Run/img/mrtx.png'); ?>"/>
								</div>
								<?php if($u_type == 1): ?><img src="/Public/Run/img/znwtyh.png" class="shibie"/>
									<?php else: ?>
									<img src="/Public/Run/img/tsgyh.png" class="shibie"/><?php endif; ?>
							</div>
							<div class="reader_information outer">
								<div class="reader_name"><?php echo ($user_real_name); ?></div>
								<div class="sex"><?php echo ($gender==1?'男':'女'); ?></div>
							</div>
							<div class="status">
								<ul class="outer">
									<li>
										<img src="/Public/Run/img/yj.png" />
									</li>
									<li class="money_status"><?php echo ($is_deposited==1?'已交':'未交'); ?></li>
									<li class="qian">
										<img src="/Public/Run/img/qk.png" />
									</li>
									<li class="qian_money">0.00￥</li>
								</ul>
							</div>
							<div class="xiugai_btn">
								<a href="#">修改状态</a>
							</div>
						</div>
						<div class="info_right">
							<ul class="outer info_right_top">
								<li>用户名：<?php echo ($nick_name); ?></li>
								<li>图书馆：<?php echo ($library); ?></li>
								<li>联系电话：<?php echo ($u_mobile); ?></li>
								<li>读者证号：<?php echo ($u_name); ?></li>
							</ul>
							<ul class="outer info_right_bottom">
								<li>
									<a href="<?php echo U('User/info',['uId'=>$user_id,'ac'=>'dqjy']);?>">
										<img src="/Public/Run/img/dqje.png" />
										<p>当前借阅</p>
									</a>
								</li>
								<li>
									<a href="<?php echo U('User/info',['uId'=>$user_id,'ac'=>'lsjy']);?>">
										<img src="/Public/Run/img/lsjl.png" />
										<p>历史借阅</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="/Public/Run/img/now.png" />
										<p>当前订阅</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="/Public/Run/img/wgjl.png" />
										<p>违规记录</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="main_biaoge">
						<table  class="table table-bordered table-striped table2">
								<tr>
									<th>姓名</th>
									<th>电话号码</th>
									<th>读者证号</th>
									<th>借出图书馆</th>
									<th>借出机器</th>
									<th>借出时间</th>
									<th>图书条码</th>
									<th>书名</th>
									<th>ISBN号</th>
									<th>操作</th>
								</tr>
							<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
									<td><?php echo ($user_real_name); ?></td>
									<td><?php echo ($u_mobile); ?></td>
									<td><?php echo ($u_name); ?></td>
									<td><?php echo ($v["library"]); ?></td>
									<td><?php echo ($v["machine"]); ?></td>
									<td><?php echo ($v["created_time"]); ?></td>
									<td><?php echo ($v["tiaoma"]); ?></td>
									<td><?php echo ($v["title"]); ?></td>
									<td><?php echo ($v["isbn"]); ?></td>
									<td>查看</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							</table>
						<div class="reader_more">
							<div class="pagelist">
								<?php echo ($page); ?>
							</div>
						</div>
					</div>

					<!--主体内容结束-->
				</div>
			</div>
		</div>
	
	<script>
		$(function(){
			$(".main_right_top ul").children(":first").addClass("on");
			$(".main_right_top ul").children(":first").find("a").find(".icon2").show();
			$(".main_right_top ul").children(":first").find("a").find(".icon1").hide();
		})
	</script>

	</body>
</html>