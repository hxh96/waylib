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
		
	<!--编辑机器开始-->
	<div id="LoginBox14">
		<div class="mach_list" id="editMach">

		</div>
	</div>
	<!--编辑机器结束-->
	<!--新增机器开始-->
	<div id="LoginBox15">
		<div class="mach_list">
			<form id="add">
				<ul class="outer">
					<input type="hidden" name="library_id" id="libId" value="<?php echo ($libId); ?>">
					<li class="lib">
						<p>图书馆：</p>
						<span><?php echo ($libName); ?></span>
					</li>
					<li>
						<p>机器ID：</p>
						<input type="text" name="machine_id"/>
					</li>
					<li>
						<p>地址：</p>
						<input type="text" name="machine_addr"/>
					</li>
					<li>
						<p>机器名称：</p>
						<input type="text" name="machine_name"/>
					</li>
					<li>
						<p>状态：</p>
						<select name="machine_state">
							<option value="1">正常</option>
							<option value="0">停用</option>
						</select>
					</li>
					<li>
						<p>经度：</p>
						<input type="text" name="gps_latitude"/>
					</li>
					<li>
						<p>类型：</p>
						<select name="machine_type">
							<option value="1">智能微图</option>
							<option value="2">图书馆</option>
						</select>
					</li>
					<li>
						<p>纬度：</p>
						<input type="text" name="gps_longitude"/>
					</li>
				</ul>
			</form>
			<div class="catalog_btn outer">
				<div class="catalog_sure" id="addMach">确定</div>
				<div class="catalog_close close_btn">取消</div>
			</div>
		</div>
	</div>
	<script>
		$(function(){
			//添加
			$('#addMach').click(function(){
				var data = $('#add').serialize();
				var libId = $('#libId').val();
				$.ajax({
					type:'post',
					url:"<?php echo U('Library/addMach');?>",
					data:data,
					dataType:'json',
					success:function(data){
						if(data.code == 1){
							var url = "<?php echo U('Library/mach');?>?libId="+libId;
							return dialog.success('添加成功',url);
						}else {
							return dialog.error(data.message);
						}
					}
				});
			});
		})
	</script>
	<!--新增机器器结束-->

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
					
	<div class="choose">
		<div class="kind outer">
			<div class="back_mach">
				<a href="<?php echo U('Library/index');?>">
					<img src="/Public/Run/img/fhtslb.png" />
				</a>
			</div>
			<div class="add_mach">
				<a href="#" class="example15">
					<img src="/Public/Run/img/fhtjlb.png" />
				</a>
			</div>
		</div>
	</div>
	<div class="main_biaoge">
		<table  class="table1 table-bordered table-striped table table14">
			<tr>
				<th>机器ID</th>
				<th>机器名称</th>
				<th>经度</th>
				<th>纬度</th>
				<th>地址</th>
				<th>状态</th>
				<th>类型</th>
				<th>查看在架图书</th>
				<th>所属图书馆</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($v["machine_id"]); ?></td>
					<td><?php echo ($v["machine_name"]); ?></td>
					<td><?php echo ($v["gps_latitude"]); ?></td>
					<td><?php echo ($v["gps_longitude"]); ?></td>
					<td><?php echo ($v["machine_addr"]); ?></td>
					<td><?php echo ($v[machine_state]==1?'正常':'停用'); ?></td>
					<td><?php echo ($v[machine_type]==1?'图书馆':'智能微图'); ?></td>
					<td>
						<a href="<?php echo U('Library/showBook',['libId'=>$v[library_id],'machId'=>$v[machine_id]]);?>">
							<img src="/Public/Run/img/zjts.png" />
						</a>
					</td>
					<td><?php echo ($v["library"]); ?></td>
					<td class="outer">
						<a href="#" class="lib_bianji example14" attr-machId="<?php echo ($v["machine_id"]); ?>">编辑</a>
						<a href="javaScript:;" attr-id="<?php echo ($v["machine_id"]); ?>" attr-libId="<?php echo ($v["library_id"]); ?>" class="del">删除</a>
					</td>
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
			$(".main_right_top ul").children(":eq(7)").addClass("on");
			$(".main_right_top ul").children(":eq(7)").find("a").find(".icon2").show();
			$(".main_right_top ul").children(":eq(7)").find("a").find(".icon1").hide();

			//删除
			$('.del').click(function(){
				var id = $(this).attr('attr-id');//机器ID
				var libId = $(this).attr('attr-libId');//图书馆ID
				layer.open({
					content: '确认删除?',
					icon: 3,
					btn: ['是', '否'],
					yes: function () {
						$.ajax({
							type:'get',
							url:"<?php echo U('Library/delMach');?>",
							data:'id='+id,
							dataType:'json',
							success:function(data){
								if(data.code == 1){
									var url = "<?php echo U('Library/mach');?>?libId="+libId;
									return dialog.success('删除成功',url);
								}else {
									return dialog.error(data.message);
								}
							}
						});
					}
				})
			});
		})
	</script>

	</body>
</html>