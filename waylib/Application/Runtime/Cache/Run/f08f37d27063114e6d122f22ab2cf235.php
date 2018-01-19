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
		
	<!--编辑图书馆开始-->
	<div id="LoginBox10">
		<div class="lib_list" id="editLib">
			<!--run.js  里面-->
		</div>
	</div>
	<!--编辑图书馆结束-->
	<!--新增图书馆开始-->
	<div id="LoginBox11">
		<div class="lib_list">
			<form id="add">
				<div class="lib_id outer lib_commmon">
					<p>图书馆ID：</p>
					<input type="text" name="id"/>
				</div>
				<div class="lib_name outer lib_sel">
					<p>图书馆名称：</p>
					<input type="text" name="name"/>
				</div>
				<div class="lib_num outer lib_commmon">
					<p>可借数量：</p>
					<input type="text" name="max_lend_times"/>
				</div>
				<div class="lib_num outer lib_sel">
					<p>管理系统：</p>
					<select name="sys_type">
						<?php if(is_array($sys_types)): $i = 0; $__LIST__ = $sys_types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php echo ($z==$v[id]?'selectes':''); ?>><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
			</form>
			<div class="lib_btns outer">
				<div class="lib_sure" id="addLib">确定</div>
				<div class="lib_close close_btn">取消</div>
			</div>
		</div>
	</div>
	<script>
		$(function(){
			//新增图书馆
			$('#addLib').click(function(){
				var add = $("#add").serialize();
				$.ajax({
					type:'post',
					url:"<?php echo U('Library/addLib');?>",
					data:add,
					dataType:'json',
					success:function(data){
						if(data.code == 1){
							var url = "<?php echo U('Library/index');?>";
							return dialog.success('添加成功',url);
						}else {
							return dialog.error(data.message);
						}
					}
				});
			})
		})
	</script>
	<!--新增图书馆结束-->

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
					
	<?php echo W('Public/library_menus');?>

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
						<p>图书馆</p>
						<input type="text" class="input-medium" id="libName" value="<?php echo ($libName); ?>"/>
					</div>
					<div class="search">
						<img src="/Public/Run/img/search.png" id="search"/>
					</div>
				</form>
				<div class="more_warden example11">
					<img src="/Public/Run/img/xztsg.png" />
				</div>
			</div>
		</div>
		<script>
			$(function(){
				//搜索
				$('#search').click(function(){
					var libName = $("#libName").val();//获取当前选择项的值.
					location.href = "<?php echo U('Library/index');?>?libName="+libName;
				});
			})
		</script>
		<?php else: endif; ?>

	<div class="main_biaoge">
		<table  class="table1 table-bordered table-striped table table13">
				<tr>
					<th>ID</th>
					<th>图书馆名称</th>
					<th>查看机器</th>
					<th>查看API</th>
					<th>管理系统</th>
					<th>可借数量</th>
					<th>操作</th>
				</tr>
			<?php if(($status == 1)): if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($v["id"]); ?></td>
						<td><?php echo ($v["name"]); ?></td>
						<td><a href="<?php echo U('Library/mach',['libId'=>$v[id]]);?>">
							<img src="/Public/Run/img/jq.png" />
						</a></td>
						<td>
							<a href="<?php echo U('Library/api',['libId'=>$v[id]]);?>">
								<img src="/Public/Run/img/API.png" />
							</a>
						</td>
						<td><?php echo ($v["sys_type"]); ?></td>
						<td><?php echo ($v["max_lend_times"]); ?></td>
						<td class="outer">
							<a href="#" class="lib_bianji example10" attr-id="<?php echo ($v["id"]); ?>" attr-sys="<?php echo ($v["sys_type"]); ?>">编辑</a>
							<!--	<img src="/Public/Run/img/fg.png" />-->
							<a href="javaScript:;" attr-id="<?php echo ($v["id"]); ?>" class="del">删除</a>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
					<tr>
						<td colspan="7">您没有此权限</td>
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
			$(".main_right_top ul").children(":eq(7)").addClass("on");
			$(".main_right_top ul").children(":eq(7)").find("a").find(".icon2").show();
			$(".main_right_top ul").children(":eq(7)").find("a").find(".icon1").hide();


			//删除
			$('.del').click(function(){
				var id = $(this).attr('attr-id');
				layer.open({
					content: '确认删除?',
					icon: 3,
					btn: ['是', '否'],
					yes: function () {
						$.ajax({
							type:'get',
							url:"<?php echo U('Library/delLib');?>",
							data:'id='+id,
							dataType:'json',
							success:function(data){
								if(data.code == 1){
									var url = "<?php echo U('Library/index');?>";
									return dialog.success('删除成功',url);
								}else {
									return dialog.error(data.message);
								}
							}
						});
					}
				});
			})
		});
	</script>

	</body>
</html>