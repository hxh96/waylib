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
					
	<?php echo W('Public/borrow_menus');?>

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
				<?php if(($status == 1)): ?><div class="choose5 outer">
						<p>图书馆:</p>
						<select id="lib">
							<option value="">请选择</option>
							<?php if(is_array($librarys)): $i = 0; $__LIST__ = $librarys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php echo ($library_id==$v[id]?'selected':''); ?>><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
					<?php else: endif; ?>
				<div class="choose2 outer">
					<p>图书条形码:</p>
					<input type="text" class="input-medium" id="tiaoma" value="<?php echo ($tiaoma); ?>"/>
				</div>
				<div class="search">
					<img src="/Public/Run/img/search.png" id="searchBtn" attr-status="<?php echo ($status); ?>" attr-libId="<?php echo ($libId); ?>"/>
				</div>
			</form>
		</div>
	</div>
	<script>
		$(function(){
			//搜索
			$('#searchBtn').click(function(){
				var type = $('#type option:selected').val();//类型  手机号或证号
				var content = $('#content').val();//手机号或证号
				var status = $(this).attr('attr-status');//身份状态
				if(status == 1){
					var libId = $('#lib option:selected').val();//图书馆ID
				}else {
					var libId = $(this).attr('attr-libId');//图书馆ID
				}
				var tiaoma = $('#tiaoma').val();//条码
				//判断是否根据手机号搜索
				if(content){
					//判断条码是否存在
					if(tiaoma){
						location.href = "<?php echo U('Borrow/index');?>?ty="+type+'&co='+content+'&lib='+libId+'&tm='+tiaoma;
					}else {
						location.href = "<?php echo U('Borrow/index');?>?ty="+type+'&co='+content+'&lib='+libId;
					}
				}else {
					//判断条码是否存在
					if(tiaoma){
						location.href = "<?php echo U('Borrow/index');?>?ty="+type+'&lib='+libId+'&tm='+tiaoma;
					}else {
						if(libId){
							location.href = "<?php echo U('Borrow/index');?>?ty="+type+'&lib='+libId;
						}else {
							return dialog.error('请先输入搜索条件');
						}
					}
				}

			})
		})
	</script>
	<div class="main_biaoge">
		<table  class="table1 table-bordered table-striped table table4">
			<tr>
				<th>姓名</th>
				<th>电话号码</th>
				<th>读者证号</th>
				<th>借出图书馆</th>
				<th>借出机器</th>
				<th>借出时间</th>
				<th>图书条码</th>
				<th>书名</th>
				<th>ISBN</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($v["user_real_name"]); ?></td>
					<td><?php echo ($v["u_mobile"]); ?></td>
					<td><?php echo ($v["u_name"]); ?></td>
					<td><?php echo ($v["library"]); ?></td>
					<td><?php echo ($v["machine_name"]); ?></td>
					<td><?php echo ($v["lend_created_time"]); ?></td>
					<td><?php echo ($v["tiaoma"]); ?></td>
					<td><?php echo ($v["title"]); ?></td>
					<td><?php echo ($v["isbn"]); ?></td>
					<td><a href="<?php echo U('Borrow/nowInfo',['lId'=>$v[u_user_lend_id],'uId'=>$v[user_id]]);?>">查看</a></td>
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
			$(".main_right_top ul").children(":eq(1)").addClass("on");
			$(".main_right_top ul").children(":eq(1)").find("a").find(".icon2").show();
			$(".main_right_top ul").children(":eq(1)").find("a").find(".icon1").hide();
		})
	</script>

	</body>
</html>