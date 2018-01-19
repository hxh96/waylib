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
					
	<?php echo W('Public/subscribe_menus');?>

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
						<option value="u_mobile" <?php echo ($u_type=='u_mobile'?'selected':''); ?>>手机号:</option>
						<option value="u_name" <?php echo ($u_type=='u_name'?'selected':''); ?>>读者证号:</option>
					</select>
					<input type="text" class="input-medium" id="content" value="<?php echo ($content); ?>"/>
				</div>
				<div class="choose5 outer">
					<p>状态</p>
					<select id="bes_status">
						<option value="">请选择</option>
						<?php if(is_array($bes_status)): $i = 0; $__LIST__ = $bes_status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>

				<div class="choose_time outer">
					<input placeholder="请选择开始时间" id="start" value="<?php echo ($start); ?>" class="laydate-icon" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
					<p>--</p>
					<input placeholder="请选择结束时间" id="end" value="<?php echo ($end); ?>" class="laydate-icon" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
				</div>
				<div class="search">
					<img src="/Public/Run/img/search.png" id="searchBtn"/>
				</div>
			</form>
		</div>
	</div>
	<script>
		$(function(){
			//搜索
			$('#searchBtn').click(function(){
				var type = $('#type option:selected').val();//搜索类型
				var content = $('#content').val();//搜索内容
				var bes_status = $('#bes_status option:selected').val();//搜索状态
				var start = $('#start').val();//开始时间
				var end = $('#end').val();//开始时间
				//判断
				if(content || bes_status || (start && end)){
					location.href = "<?php echo U('Subscribe/index');?>?ty="+type+'&co='+content+'&bS='+bes_status+'&st='+start+'&end='+end;
				}else {
					return dialog.error('请先选择搜索方式');
				}

			})
		})
	</script>
	<div class="main_biaoge">
		<table  class="table1 table-bordered table-striped table table12">
				<tr>
					<th>图书馆</th>
					<th>图书名称</th>
					<th>作者</th>
					<th>出版社</th>
					<th>ISBN</th>
					<th>状态</th>
					<th>订阅用户</th>
					<th>订阅时间</th>
					<th>是否已通知</th>
					<!--<th>操作</th>-->
				</tr>
				<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($v["library"]); ?></td>
						<td><?php echo ($v["title"]); ?></td>
						<td><?php echo ($v["author"]); ?></td>
						<td><?php echo ($v["publisher"]); ?></td>
						<td><?php echo ($v["isbn"]); ?></td>
						<td>
							<select class="b_status" attr-id="<?php echo ($v["id"]); ?>">
								<?php if(is_array($bes_status)): $i = 0; $__LIST__ = $bes_status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$y): $mod = ($i % 2 );++$i;?><option value="<?php echo ($y["id"]); ?>" <?php echo ($v[status]==$y[id]?'selected':''); ?>><?php echo ($y["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</td>
						<td><?php echo ((isset($v["u_mobile"]) && ($v["u_mobile"] !== ""))?($v["u_mobile"]):$v.u_name); ?></td>
						<td><?php echo ($v["create_time"]); ?></td>
						<td><?php echo ($v[is_notice]==2?'已通知':'未通知'); ?></td>
						<!--<td>查看</td>-->
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
			$(".main_right_top ul").children(":eq(4)").addClass("on");
			$(".main_right_top ul").children(":eq(4)").find("a").find(".icon2").show();
			$(".main_right_top ul").children(":eq(4)").find("a").find(".icon1").hide();

			$(".b_status").change(function(){
				var This = $(this);
				var status = This.val();
				var id = This.attr('attr-id');
				var url = "<?php echo U('Subscribe/checkStatus');?>";
				layer.open({
					content: '确认执行该操作?',
					icon: 3,
					btn: ['是', '否'],
					yes: function () {
						$.ajax({
							type:'get',
							url:url,
							data:'id='+id+'&status='+status,
							dataType:'json',
							success:function(data){
								if(data.code == 1){
									return dialog.success('更改成功',"<?php echo U('Subscribe/index');?>");
								}else {
									return dialog.error(data.message);
								}
							}
						});
					},
					btn2:function(){
						location.reload(true);
					}
				});
			})
		})
	</script>

	</body>
</html>