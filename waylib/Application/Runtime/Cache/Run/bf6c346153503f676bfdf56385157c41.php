<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link href="/Public/favicon.ico" rel="shortcut icon">
		<title><?php echo ($webTitle); ?>|智能微图后台管理系统</title>
		<link rel="stylesheet" href="/Public/Run/css/base.css" />
		<link rel="stylesheet" href="/Public/Run/css/bootstrap.css" />
		<link rel="stylesheet" href="/Public/Run/css/style.css" />
		<script type="text/javascript" src="/Public/Run/js/jquery-1.12.0.min.js" ></script>
		<script type="text/javascript" src="/Public/Run/js/index.js" ></script>
		<script src="/Public/Run/js/layer/layer.js"></script>
		<script src="/Public/Run/js/dialog.js"></script>
		<style>
			html,body{
				overflow-y:hidden ;
			}
		</style>
	</head>
	<body>
		<div class="shouye_box">
			<div class="admin">
				<p><span>单&nbsp;&nbsp;&nbsp;位：</span><?php echo ($library); ?></p>
				<p class="yonghuming"><span>用户名：</span><?php echo ($phone); ?></p>
				<button class="change_psw" attr-uId="<?php echo ($uId); ?>">修改密码</button>
				<button class="quit" id="loginOut">退出</button>
			</div>
			<script>
				$(function(){
					$('.change_psw').click(function(){
						var uId = $(this).attr('attr-uId');
						location.href = "<?php echo U('Login/checkPwd');?>?uId="+uId;
					});
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
			<div class="index_icon">
				<img src="/Public/Run/img/danghangcaidan.png" />
			</div>
			<div class="shouye_top">
				<ul class="outer">
					<li class="a1">
						<a href="<?php echo U('User/index');?>">
							<img src="/Public/Run/img/yonghuguanli.png" class="icon1"/>
							<img src="/Public/Run/img/yonghuguanl2.png" class="icon11"/>
						</a>
					</li>
					<li class="a2">
						<a href="<?php echo U('Borrow/index');?>">
							<img src="/Public/Run/img/jieyuexhaxun.png" class="icon2"/>
							<img src="/Public/Run/img/jieyuexhaxun2.png" class="icon22" style="margin-left: -1px;margin-top: 1px;"/>
						</a>
					</li>
					<li class="a3">
						<a href="#">
							<img src="/Public/Run/img/shipinjiankong.png" class="icon3"/>
							<img src="/Public/Run/img/shipinjiankong2.png" class="icon33"/>
						</a>
					</li>
					<li class="a4">
						<a href="<?php echo U('Catalog/index');?>">
							<img src="/Public/Run/img/zhijiebianmu.png" class="icon4"/>
							<img src="/Public/Run/img/zhijiebianmu2.png" class="icon44"/>
						</a>
					</li>
				</ul>
				<div class="heng1">
					<img src="/Public/Run/img/xian.png" />
				</div>
			</div>
			<div class="shouye_bottom">
				<ul>
					<li class="a5">
						<a href="<?php echo U('App/index');?>">
							<img src="/Public/Run/img/app.png" class="icon5"/>
							<img src="/Public/Run/img/app2.png" class="icon55"/>
						</a>
					</li>
					<li class="a6">
						<a href="<?php echo U('Subscribe/index');?>">
							<img src="/Public/Run/img/dingyueguanli.png" class="icon6"/>
							<img src="/Public/Run/img/dingyueguanli2.png" class="icon66"/>
						</a>
					</li>
					<li class="a7">
						<a href="<?php echo U('Library/index');?>">
							<img src="/Public/Run/img/tushuguanli.png" class="icon7"/>
							<img src="/Public/Run/img/tushuguanli2.png" class="icon77"/>
						</a>
					</li>
					<li class="a8">
						<a href="#">
							<img src="/Public/Run/img/dashuju.png" class="icon8"/>
							<img src="/Public/Run/img/dashuju2.png" class="icon88"/>
						</a>
					</li>
					<li class="a9">
						<a href="#">
							<img src="/Public/Run/img/yichangchuli.png" class="icon9"/>
							<img src="/Public/Run/img/yichangchuli2.png" class="icon99"/>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>