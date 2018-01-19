<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="/Public/favicon.ico" rel="shortcut icon">
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
					
		<div class="choose">
			<div class="kind">
				<form class="outer">
					<div class="choose8">
						<select id="type">
							<option value="u_mobile" <?php echo ($type=='u_mobile'?'selected':''); ?>>手机号</option>
							<option value="u_name" <?php echo ($type=='u_name'?'selected':''); ?>>读者证号</option>
						</select>
						<input type="text" class="input-medium" id="type_content" value="<?php echo ($content); ?>"/>
					</div>
					<?php if(($status == 1)): ?><div class="choose3 outer">
							<p>图书馆</p>
							<select id="libId">
								<option value="">请选择</option>
								<?php if(is_array($librarys)): $i = 0; $__LIST__ = $librarys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php echo ($library_id==$v[id]?'selected':''); ?>><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</div>
						<?php else: endif; ?>
					<div class="choose3 outer">
						<p>用户类型</p>
						<select id="uType">
							<option value="1" <?php echo ($u_type==1?'selected':''); ?>>智能微图用户</option>
							<option value="2" <?php echo ($u_type==2?'selected':''); ?>>图书馆用户</option>
						</select>
					</div>
					<div class="choose4 outer">
						<p>押金</p>
						<select id="deposited">
							<option value="1" <?php echo ($is_deposited==1?'selected':''); ?>>是</option>
							<option value="0" <?php echo ($is_deposited==0?'selected':''); ?>>否</option>
						</select>
					</div>
					<div class="choose5 outer">
						<p>状态</p>
						<select id="status">
							<option value="1" <?php echo ($u_status==1?'selected':''); ?>>启用</option>
							<option value="0" <?php echo ($u_status==0?'selected':''); ?>>封停</option>
						</select>
					</div>
					<div class="search">
						<img src="/Public/Run/img/search.png" attr-role="<?php echo ($role); ?>" attr-libraryId="<?php echo ($libraryId); ?>" id="userBtn"/>
					</div>
				</form>
			</div>
		</div>
		<script>
			$(function(){
				//读者搜索
				$('#userBtn').click(function(){
					var role = $(this).attr('attr-role');//身份
					if(role == 1){
						//根据身份获取图书馆ID
						var libraryId = $("#libId option:selected").val();
					}else{
						var libraryId = $(this).attr('attr-libraryId');
					}
					var uType = $("#uType option:selected").val();//用户类型
					var deposited = $("#deposited option:selected").val();//押金状态
					var status = $("#status option:selected").val();//状态

					var type_content = $('#type_content').val();//手机号(读者证号)
					//判断是否使用读者证或手机号进行搜索
					if(!type_content){
						//判断是否选择图书馆
						if(!libraryId){
							location.href="<?php echo U('User/index');?>?ut="+uType+'&de='+deposited+'&st='+status;
						}else {
							location.href="<?php echo U('User/index');?>?lib="+libraryId+'&ut='+uType+'&de='+deposited+'&st='+status;
						}
					}else {
						var type = $("#type option:selected").val();//检索类型
						//判断是否选择图书馆
						if(!libraryId){
							location.href="<?php echo U('User/index');?>?ty="+type+'&ct='+type_content+'&ut='+uType+'&de='+deposited+'&st='+status;
						}else {
							location.href="<?php echo U('User/index');?>?ty="+type+'&ct='+type_content+'&lib='+libraryId+'&ut='+uType+'&de='+deposited+'&st='+status;
						}
					}
				})
			})
		</script>
		<div class="main_biaoge">
			<table  class="table1 table-bordered table-striped table">
					<tr>
						<th>姓名</th>
						<th>电话号码</th>
						<th>读者证号</th>
						<th>图书馆</th>
						<th>读者类型</th>
						<th>性别</th>
						<th>是否交押金</th>
						<th>欠款金额（元）</th>
						<th>注册时间</th>
						<th>最后一次登录</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
						<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($v["user_real_name"]); ?></td>
								<td><?php echo ($v["u_mobile"]); ?></td>
								<td><?php echo ($v["u_name"]); ?></td>
								<td><?php echo ($v["library"]); ?></td>
								<td><?php echo ($v[u_type]==1?'智能微图用户':'图书馆用户'); ?></td>
								<td><?php echo ($v[gender]==1?'男':'女'); ?></td>
								<td><?php echo ($v[is_deposited]==1?'是':'否'); ?></td>
								<td>100.00</td>
								<td><?php echo ($v["created_time"]); ?></td>
								<td><?php echo ($v["last_login_time"]); ?></td>
								<td><?php echo ($v[status]==1?'启用':'封停'); ?></td>
								<td><a href="<?php echo U('User/info',['uId'=>$v[user_id]]);?>">查看</a></td>
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