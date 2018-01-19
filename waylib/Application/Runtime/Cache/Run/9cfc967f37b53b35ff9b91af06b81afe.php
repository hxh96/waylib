<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>修改密码|智能微图后台管理系统</title>
		<link rel="stylesheet" href="/Public/Run/css/bootstrap.css" />
		<link rel="stylesheet" href="/Public/Run/css/style.css" />
	</head>
	<body style="background: #f0f0f0;">
		<div class="changepsw">
			<div class="change_head">
				<img src="/Public/Run/img/tou.png" class="toubg"/>
				<div class="change_icon">
				<img src="/Public/Run/img/xgmm.png" />
			</div>
			</div>
			
			<div class="change_main">
				<div class="changge_center">
					<div class="change_form">
						<div class="phone">
							<span>手机号：</span>
							<input class="input-large" type="text" id="phone">
							<p>请输入正确的手机号</p>
						</div>
						<div class="yazhengma">
							<span>验证码：</span>
							<input class="input-medium" type="text" id="code">
							<input class="btn btn-success" type="button" onclick="sendCode(this)" value="发送验证码">
						</div>
						<img src="/Public/Run/img/heng.png" class="heng"/>
						<div class="newpsw">
							<span>新密码：</span>
							<input class="input-large" type="password" id="pw">
							<p>请输入6-16位的密码</p>
						</div>
						<div class="newpsw_again" >
							<span>新密码确认：</span>
							<input class="input-large" type="password" id="repw">
							<p>两次输入密码不一致</p>
						</div>
						<button class="quxiao" >取&nbsp;&nbsp;消</button>
						<button class="sure" id="checkBtn" attr-uId="<?php echo ($uId); ?>">确&nbsp;&nbsp;认</button>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="/Public/Run/js/jquery-1.12.0.min.js" ></script>
		<script type="text/javascript" src="/Public/Run/js/layer/layer.js" ></script>
		<script type="text/javascript" src="/Public/Run/js/dialog.js" ></script>
		<script type="text/javascript" src="/Public/Run/js/sha1.js"></script>
		<script type="text/javascript" src="/Public/Run/js/base64.js"></script>
		<script>

			$(function(){
				//取消
				$('.quxiao').click(function(){
					location.href = "<?php echo U('Index/index');?>";
				});

				//手机号验证
				$('#phone').blur(function () {
					var phone = $('#phone').val();
					var reg1 = /^[1][3-8]\d{9}$/;
					if (!reg1.test(phone)) {
						$('#phone').val('');
						$('.phone p').show();
					}else{
						$('.phone p').hide();
					}
				});
				//密码验证
				$('#pw').blur(function () {
					if ($('#pw').val().length < 6 || $('#pw').val().length > 16) {
						$('#pw').val('');
						$('.newpsw p').show();
					}else{
						$('.newpsw p').hide();
					}
				});
				//确认密码
				$('#repw').blur(function () {
					if ($('#pw').val() !== $('#repw').val()) {
						$('#repw').val('');
						$('.newpsw_again p').show();
					}else{
						$('.newpsw_again p').hide();
					}
				});

				//确认修改
				$('#checkBtn').click(function(){
					var phone = $('#phone').val();//手机号
					var pwd = $('#pw').val();//密码
					var repw = $('#repw').val();//确认密码
					var code = $('#code').val();//验证码
					var uId = $(this).attr('attr-uId');//userId
					if(!phone || !pwd || !repw || !code){
						return dialog.error('请填写相关信息');
					}else {
						//当前时间戳
						var timeStamp = Date.parse(new Date());
						//拼接str
						var str =  phone + code + timeStamp;
						//加密
						var b = new Base64();
						var sign = b.encode(hex_sha1(str + 'MGNiOTc3OGQyZjZhMjdhZGUwN2E0Y2Y2ODY1YThhYjYxN2Q5YTVkMA'));
						//验证验证码
						$.ajax({
							type: 'post',
							url: GetIp() + '/public/users/validateCode',
							data:'smsCode='+code+'&mobile='+phone+'&timeStamp='+timeStamp+'&sign='+sign,
							dataType:'',
							success:function(data){
								console.log(data);
								if(data.code == 100){
									//修改
									var b = new Base64();
									var password = b.encode(hex_sha1(repw+'NWQwOWEwMzJmZjZiYTdlMTUzMzFhZGNlYjgzNmQxMWEyZmU2NDlhNw=='));
									$.ajax({
										type:'post',
										url:"<?php echo U('Login/check');?>",
										data:'user_id='+uId+'&u_pwd='+password+'&phone='+phone,
										dataType:'json',
										success:function(data){
											if(data.code == 1) {
												var url  = "<?php echo U('Login/index');?>";
												return dialog.success('修改成功',url);
											}else {
												return dialog.error(data.message);
											}
										}
									});
								}else {
									return dialog.error(data.msg);
								}
							}
						});
					}
				});
			});
			var clock = '';
			var nums = 60;
			var btn;
			function sendCode(thisBtn)
			{
				btn = thisBtn;
				var phone = $('#phone').val();
				var reg1 = /^[1][3-8]\d{9}$/;
				if (!reg1.test(phone)) {
					return dialog.error('手机号格式不正确');
				}else{
					//当前时间戳
					var timeStamp = Date.parse(new Date());
					//短信模板ID
					var smsType = 'SMS_84685374';
					//拼接str
					var str =smsType+timeStamp+phone;
					//加密
					var b = new Base64();
					var sign = b.encode(hex_sha1(str+'MGNiOTc3OGQyZjZhMjdhZGUwN2E0Y2Y2ODY1YThhYjYxN2Q5YTVkMA'));

					//发送短信验证码
					$.ajax({
						type: "post",
						url: GetIp() + '/public/users/sendSMSCode',
						data: 'uMobile=' + phone +'&smsType='+smsType+ '&timeStamp=' + timeStamp + '&sign=' + sign,
						dataType: 'json',
						success: function (data) {
							if(data.code == 100){
								btn.disabled = true; //将按钮置为不可点击
								btn.value = nums+'(S)';
								clock = setInterval(doLoop, 1000); //一秒执行一次
							}else {
								return dialog.error('请稍后再试!');
							}
						}
					});
				}
			}
			function doLoop()
			{
				nums--;
				if(nums > 0){
					btn.value = nums+'(S)';
				}else{
					clearInterval(clock); //清除js定时器
					btn.disabled = false;
					btn.value = '点击发送验证码';
					nums = 60; //重置时间
				}
			}
		</script>
	</body>
</html>