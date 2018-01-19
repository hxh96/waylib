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
		
	<!--添加管理员弹框开始-->
	<div id="LoginBox" class="outer">
		<div class="new_left">
			<div class="new_name outer">
				<p>姓名：</p>
				<input type="text" id="real_name"/>
			</div>
			<div class="new_sex outer">
				<p>性别：</p>
				<div class="sex_g outer">
					<input type="radio" name="sex" value="1" checked/><p>男</p>
				</div>
				<div class="sex_b outer">
					<input type="radio" name="sex" value="2"/><p>女</p>
				</div>
			</div>
			<div class="new_lib outer">
				<p>所属图书馆：</p>
				<select id="libId">
					<?php if(is_array($librarys)): $i = 0; $__LIST__ = $librarys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
			<div class="new_phone outer">
				<p>联系电话：</p>
				<input type="text" id="u_mobile"/>
			</div>
		</div>
		<div class="new_right">
			<div class="set_txt">
				<p>设置密码</p>
			</div>
			<div class="psw_inp">
				<input type="password" placeholder="请输入密码" id="u_pwd"/>
				<img src="/Public/Run/img/mm.png" />
			</div>
			<div class="qiyong">
				<input type="radio" name="qiyong" value="1" checked/><p>启用</p>
				<input type="radio" name="qiyong" style="margin-left: 10%;" value="0"/><p>封停</p>
			</div>
			<div class="more_qiyong">
				<img src="/Public/Run/img/qd.png" id="loginbtn"/>
			</div>
		</div>
		<a href="javascript:void(0)" title="关闭窗口" class="close_btn" id="closeBtn">
			<img src="/Public/Run/img/tc.png" />
		</a>
	</div>
	<script>
		$(function(){
			//添加管理员
			$('#loginbtn').click(function(){
				var realName = $('#real_name').val();//姓名
				var Mobile = $('#u_mobile').val();//电话
				var Pwd = $('#u_pwd').val();//密码
				var gender = $('input[name="sex"]:checked').val();//性别
				var status = $('input[name="qiyong"]:checked').val();//是否启用
				var libId =  $("#libId option:selected").val();//图书馆ID
				//判断是否填写信息
				if(!realName || !Mobile || !Pwd){
					return dialog.error('请先填写相关信息');
				}
				//手机号验证
				var reg1 = /^[1][3-8]\d{9}$/;
				if (!reg1.test(Mobile)) {
					return dialog.error('您输入的手机号格式不正确');
				}
				//密码验证
				if (Pwd.length < 6 || Pwd.length > 16) {
					return dialog.error('请输入6-16位密码');
				}

				var b = new Base64();
				var password = b.encode(hex_sha1(Pwd+'NWQwOWEwMzJmZjZiYTdlMTUzMzFhZGNlYjgzNmQxMWEyZmU2NDlhNw=='));//密码加密

				//添加
				$.ajax({
					type:'post',
					url:"<?php echo U('User/adminAdd');?>",
					data:'user_real_name='+realName+'&u_mobile='+Mobile+'&u_pwd='+password+'&gender='+gender+'&status='+status+'&library_id='+libId,
					dataType:'json',
					success:function(data){
						console.log(data);
						if(data.code == 1){
							var url = "<?php echo U('User/administer');?>";
							return dialog.success('添加成功',url);
						}else {
							return dialog.error(data.message);
						}
					}
				})

			})
		})
	</script>
	<!--添加管理员弹框结束-->
	<!--查看弹框开始-->
	<div id="LoginBox1" class="outer">
		<div class="check_head">
			<img src="" id="Photo"/>
		</div>
		<div class="check_all outer">
			<div class="check_left">
				<div class="check_name">姓名：<span id="Name"></span></div>
				<div class="check_sex">性别：<span id="Gender"></span></div>
				<div class="check_role">角色：<span id="Role"></span></div>
				<div class="check_phone">联系电话：<span id="Mobile"></span></div>
				<div class="last_time"><span>•</span>最后登录时间：<span id="Last"></span></div>
			</div>
			<div class="check_right">
				<div class="check_ul">
					<ul class="outer">
						<li>
							<a href="#">
								<img src="/Public/Run/img/ck.png" />
								<p>查看操作日志</p>
							</a>
						</li>
						<li id="checkStatus">
							<!--封停或启用  index.js  134行-->
						</li>
					</ul>
				</div>
				<div class="set_psw">
					<div class="set_password">重置密码:</div>
					<input type="password" placeholder="新密码" id="newPwd"/>
					<div class="change_btn"><a href="#" id="updateData">修改</a></div>
				</div>
			</div>
		</div>
		<a href="javascript:void(0)" title="关闭窗口" class="close_btn" id="closeBtn">
			<img src="/Public/Run/img/tc.png" />
		</a>
	</div>
	<script>
		$(function(){
			//修改按钮
			$('#updateData').click(function(){
				var newPwd = $('#newPwd').val();//新密码
				//密码验证
				if (newPwd.length < 6 || newPwd.length > 16) {
					return dialog.error('请输入6-16位密码');
				}
				var userId = $(this).attr('attr-userid');//用户id

				var b = new Base64();
				var password = b.encode(hex_sha1(newPwd+'NWQwOWEwMzJmZjZiYTdlMTUzMzFhZGNlYjgzNmQxMWEyZmU2NDlhNw=='));//密码加密

				layer.open({
					content: '确认重置?',
					icon: 3,
					btn: ['是', '否'],
					yes: function () {
						$.ajax({
							type:'post',
							url:"<?php echo U('User/resetPwd');?>",
							data:'user_id='+userId+'&u_pwd='+password,
							dataType:'json',
							success:function(data){
								if(data.code == 1){
									var url = "<?php echo U('User/administer');?>";
									return dialog.success('重置成功',url);
								}else {
									return dialog.error(data.message);
								}
							}
						})
					}
				});
			});
		})
	</script>
	<!--查看弹框结束-->

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
					
	<?php if(($status == 1)): ?><div class="choose">
			<div class="kind">
				<form class="outer">
					<div class="choose2 outer">
						<p>手机号</p>
						<input type="text" class="input-medium" id="phone" value="<?php echo ($ph); ?>"/>
					</div>
					<div class="choose5 outer">
						<p>图书馆</p>
						<select id="lib">
							<option value="">请选择</option>
							<?php if(is_array($librarys)): $i = 0; $__LIST__ = $librarys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php echo ($lid==$v[id]?'selected':''); ?>><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
					<div class="choose5 outer">
						<p>状态</p>
						<select id="status">
							<option value="1" <?php echo ($st==1?'selected':''); ?>>启用</option>
							<option value="0" <?php echo ($st==0?'selected':''); ?>>封停</option>
						</select>
					</div>
					<div class="search">
						<img src="/Public/Run/img/search.png" id="admin_search"/>
					</div>
				</form>
				<div class="more_warden" id="example">
					<img src="/Public/Run/img/tianjia.png" />
				</div>
			</div>
		</div>
		<script>
			$(function(){
				//搜索管理员
				$('#admin_search').click(function(){
					var phone = $('#phone').val();//获取手机号
					var libraryId = $("#lib option:selected").val();//获取图书馆ID
					var status = $("#status option:selected").val();//状态
					if(!phone){
						if(!libraryId){
							location.href = "<?php echo U('User/administer');?>?st="+status;
						}else {
							location.href = "<?php echo U('User/administer');?>?lib="+libraryId+'&st='+status;
						}
					}else {
						if(!libraryId){
							location.href = "<?php echo U('User/administer');?>?ph="+phone+'&st='+status;
						}else {
							location.href = "<?php echo U('User/administer');?>?ph="+phone+'&lib='+libraryId+'&st='+status;
						}
					}
				})
			});
		</script>
		<?php else: endif; ?>
		<div class="main_biaoge">
			<table  class="table1 table-bordered table-striped table table3">
					<tr>
						<th>姓名</th>
						<th>电话号码</th>
						<th>图书馆</th>
						<th>角色</th>
						<th>性别</th>
						<th>注册时间</th>
						<th>最后一次登录</th>
						<th>操作</th>
					</tr>
				<?php if(($status == 1)): if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($v["user_real_name"]); ?></td>
							<td><?php echo ($v["u_mobile"]); ?></td>
							<td><?php echo ($v["library"]); ?></td>
							<td><?php echo ($v[library_id]=='SCYT001'?'超级管理员':'管理员'); ?></td>
							<td><?php echo ($v[gender]==1?'男':'女'); ?></td>
							<td><?php echo ($v["created_time"]); ?></td>
							<td><?php echo ($v["last_login_time"]); ?></td>
							<td class="example1" data-status="<?php echo ($v["status"]); ?>" data-userid="<?php echo ($v["user_id"]); ?>" data-name="<?php echo ($v["user_real_name"]); ?>" data-photo="<?php echo ((isset($v["u_photo"]) && ($v["u_photo"] !== ""))?($v["u_photo"]):'/Public/Run/img/mrtx.png'); ?>" data-gender="<?php echo ($v["gender"]); ?>" data-lib="<?php echo ($v["library"]); ?>" data-phone="<?php echo ($v["u_mobile"]); ?>" data-last="<?php echo ($v["last_login_time"]); ?>">查看</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
					<tr>
						<td colspan="8">您没有此权限</td>
					</tr><?php endif; ?>
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