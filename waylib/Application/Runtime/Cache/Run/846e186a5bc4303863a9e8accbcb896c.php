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
					
					<div class="main_left_ul">
						<ul>
							<li class="outer">
								<a href="<?php echo U('App/index');?>" class="outer">
									<img src="/Public/Run/img/zj.png" />
									<p>在架图书</p>
								</a>
							</li>
							<li class="outer">
								<a href="<?php echo U('App/them');?>" class="outer">
									<img src="/Public/Run/img/zttj.png" />
									<p>专题推荐</p>
								</a>
							</li>
							<li class="outer">
								<a href="<?php echo U('App/push');?>" class="outer">
									<img src="/Public/Run/img/xxts.png" />
									<p>消息推送</p>
								</a>
							</li>
							<li class="outer">
								<a href="<?php echo U('App/backMoney');?>" class="outer">
									<img src="/Public/Run/img/tyjsh.png" />
									<p>退押金审核</p>
								</a>
							</li>
							<li class="outer">
								<a href="<?php echo U('App/userBack');?>" class="outer">
									<img src="/Public/Run/img/yhfk.png" />
									<p>用户反馈</p>
								</a>
							</li>
						</ul>
					</div>
					
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
					

	<?php if(($status == 1)): ?><div class="choose">
			<div class="kind">
				<form class="outer">
					<div class="choose5 message_inp">
						<p>图书馆:</p>
						<select id="library">
							<?php if(is_array($librarys)): $i = 0; $__LIST__ = $librarys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</form>
			</div>
		</div>
		<?php else: ?>
		<input type="hidden" name="libraryId" id="libId" value="<?php echo ($libraryId); ?>"><?php endif; ?>
		<div class="main_biaoge message_box">
			<div class="message">
				<div class="message_kuang">推送内容</div>
				<div class="message_info">
					<div class="message_form">
						<textarea></textarea>
					</div>
					<div class="ts_btn">
						<a href="#">推送</a>
					</div>
				</div>

			</div>
		</div>

					<!--主体内容结束-->
				</div>
			</div>
		</div>
	
	<script>
		$(function(){
			$(".main_right_top ul").children(":eq(8)").addClass("on");
			$(".main_right_top ul").children(":eq(8)").find("a").find(".icon2").show();
			$(".main_right_top ul").children(":eq(8)").find("a").find(".icon1").hide();
		})
	</script>

	</body>
</html>