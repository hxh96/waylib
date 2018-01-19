<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="/Public/favicon.ico" rel="shortcut icon">
		<title>用户登录|智能微图后台管理系统</title>
		<link rel="stylesheet" href="/Public/Run/css/base.css" />
		<link rel="stylesheet" href="/Public/Run/css/style.css" />

	</head>
	<body>
		<div class="login_box">
			<div class="login_boxing">
				<div class="login">
					<div class="login_log">
						<img src="/Public/Run/img/yonghudenrglu.png" />
					</div>
						<div class="user outer">
							<div class="user_txt outer">
								<img src="/Public/Run/img/yonghuming.png" />
								<p>用户名：</p>
							</div>
							<input class="username" id="username"/>
						</div>
						<div class="user outer">
							<div class="user_txt outer">
								<img src="/Public/Run/img/mima.png" />
								<p>密&nbsp;&nbsp;&nbsp;码：</p>
							</div>
							<input class="username" type="password" id="password"/>
						</div>
						<div class="yazheng outer">
							<div class="user_txt outer">
								<img src="/Public/Run/img/yanzhenma.png" />
								<p>验证码：</p>
								<input class="username" type="text" id="code"/>
								<img src="<?php echo U('Login/ver');?>" id="img"/>
							</div>
						</div>
						<div class="denglu">
							<button id="btn_login">登&nbsp;&nbsp;录</button>
						</div>
						<a href="<?php echo U('Login/forgetPwd');?>" class="forget">忘记密码？点击找回</a>
				</div>
			</div>
		</div>
		<script src="/Public/Run/js/jquery-1.12.0.min.js"></script>
		<script type="text/javascript" src="/Public/Run/js/sha1.js"></script>
		<script type="text/javascript" src="/Public/Run/js/base64.js"></script>
		<script src="/Public/Run/js/layer/layer.js"></script>
		<script src="/Public/Run/js/dialog.js"></script>
		<script>
			$(function(){

				/*
				 * 登录
				 */
				$('#btn_login').click(function(){
					var username = $("#username").val();
					var password = $("#password").val();
					var code     = $("#code").val();
					if(!username){
						return dialog.error('用户名不能为空！');
					}
					if(!password){
						return dialog.error('密码不能为空！');
					}
					if(!code){
						return dialog.error('验证码不能为空！');
					}
					var b = new Base64();
					password = b.encode(hex_sha1(password+'NWQwOWEwMzJmZjZiYTdlMTUzMzFhZGNlYjgzNmQxMWEyZmU2NDlhNw=='));
					var url  = "<?php echo U('Login/checkLogin');?>";
					var jump_url = "<?php echo U('Index/index');?>";
					$.ajax({
						type:'post',
						url:url,
						data:'username='+username+'&password='+password+'&code='+code,
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

				/*
				 *验证码刷新
				 */
				var verify = $("#img").attr('src');
				$("#img").click(function(){  //验证码点击刷新
					if( verify.indexOf('?')>0){
						$("#img").attr("src", verify+'&random='+Math.random());
					}
					else{
						$("#img").attr("src", verify.replace(/\?.*$/,'')+'?'+Math.random());
					}
				});
			});
		</script>
	</body>
</html>