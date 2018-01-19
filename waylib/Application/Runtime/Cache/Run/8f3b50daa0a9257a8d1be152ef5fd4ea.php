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
		
	<!--增加藏书开始-->
	<div id="LoginBox8" class="outer">
		<div class="addbook_list">
			<ul class="outer">
				<li><p>ISBN:</p>212-123-123-12211</li>
				<li><p>尺寸：</p>6开</li>
				<li><p>页码：</p>123</li>
				<li><p>书名：</p>书名书名书名书名书名书名</li>
				<li><p>作者：</p>名字名字名字名字</li>
				<li><p>版次：</p>333</li>
				<li><p>分类号：</p>k122</li>
				<li><p>标签：</p>格林童话</li>
				<li><p>图书价格（元）：</p>00：00</li>
				<li><p>出版社：</p>人民邮电出版社</li>
				<li><p>出版地：</p>中国中国中国</li>
				<li><p>出版时间：</p>2019-10-10</li>
				<li><p>内容摘要：</p>一群可爱的</li>
			</ul>
			<div class="lib_info outer">
				<div class="neirong_z">
					<p>内容摘要：</p>
					<input type="text" />
				</div>
				<div class="lib_z">
					<p>图书馆：</p>
					<input type="text" />
				</div>
			</div>
			<div class="catalog_btn outer">
				<div class="catalog_sure">确定</div>
				<div class="catalog_close close_btn">取消</div>
			</div>
		</div>
	</div>
	<!--增加藏书结束-->

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
					
	<?php echo W('Public/catalog_menus');?>

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
						<p>题名</p>
						<input type="text" class="input-medium" id="title"/>
					</div>
					<div class="choose2 outer">
						<p>ISBN号</p>
						<input type="text" class="input-medium" id="isbn"/>
					</div>
					<div class="search">
						<img src="/Public/Run/img/search.png" id="searchBtn"/>
					</div>
				</form>
				<div class="more_warden example7">
					<a href="<?php echo U('Catalog/addCata');?>"><img src="/Public/Run/img/xzts.png" /></a>
				</div>
			</div>
		</div>
		<script>
			$(function(){
				//搜索
				$('#searchBtn').click(function(){
					var title = $('#title').val();//题名
					var isbn = $('#isbn').val();//isbn号
					if(!title && !isbn){
						return dialog.error('请先输入相关内容');
					}else {
						if(title && isbn){
							location.href = "<?php echo U('Catalog/index');?>?ti="+title+'&is='+isbn+'&ty=all';
						}
						if(!title){
							location.href = "<?php echo U('Catalog/index');?>?is="+isbn+'&ty=isbn';
						}else {
							location.href = "<?php echo U('Catalog/index');?>?ti="+title+'&ty=title';
						}
					}

				});
			});
		</script>
		<?php else: endif; ?>
	<div class="main_biaoge">
		<table  class="table1 table-bordered table-striped table table10">
			<tr>
				<th>题名</th>
				<th>ISBN号</th>
				<th>分类号</th>
				<th>出版社</th>
				<th>出版日期</th>
				<th>价格（元）</th>
				<th>藏书（部）</th>
				<th>操作</th>
			</tr>
			<?php if(($status == 1)): if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($v["title"]); ?></td>
						<td><?php echo ($v["isbn"]); ?></td>
						<td><?php echo ($v["classification_num"]); ?></td>
						<td><?php echo ($v["publisher"]); ?></td>
						<td><?php echo ($v["pubdate"]); ?></td>
						<td><?php echo ($v["price"]); ?></td>
						<td class="outer">
							<p><?php echo ($v["count"]); ?></p>
							<img src="/Public/Run/img/ckan.png" class="collectBookBtn" attr-descId="<?php echo ($v["book_desc_id"]); ?>"/>
						</td>
						<td class="outer">
							<p class="example6"><a href="<?php echo U('Catalog/editCata',['id'=>$v[book_desc_id]]);?>">编辑</a></p>
							<img src="/Public/Run/img/fg.png" />
							<p class="example8"><a href="#">增加藏书</a></p>
						</td>
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
		<div id="collectBook">

		</div>
	</div>

					<!--主体内容结束-->
				</div>
			</div>
		</div>
	
	<script>
		$(function(){
			$(".main_right_top ul").children(":eq(3)").addClass("on");
			$(".main_right_top ul").children(":eq(3)").find("a").find(".icon2").show();
			$(".main_right_top ul").children(":eq(3)").find("a").find(".icon1").hide();
			//查看藏书
			$('.collectBookBtn').click(function(){
				var descId = $(this).attr('attr-descId');//详情ID
				//获取藏书列表
				$.ajax({
					type:'get',
					url:"<?php echo U('Catalog/collectBook');?>",
					data:'descId='+descId,
					dataType:'json',
					success:function(data){
//						console.log(data);
						if(data.code == 1){
							var html = '<table  class="table1 table-bordered table-striped table table18">\
									<tr>\
									<th>题名</th>\
									<th>ISBN号</th>\
									<th>分类号</th>\
									<th>出版社</th>\
									<th>出版日期</th>\
									<th>价格（分）</th>\
							<th>图书条码</th>\
							<th>操作</th>\
						</tr>';
							for(var i=0;i<data.data.length;i++){
								html += '<tr>\
										<td>'+data.data[i]['title']+'</td>\
										<td>'+data.data[i]['isbn']+'</td>\
										<td>'+data.data[i]['classification_num']+'</td>\
										<td>'+data.data[i]['publisher']+'</td>\
										<td>'+data.data[i]['pubdate']+'</td>\
										<td>'+data.data[i]['price']+'</td>\
										<td class="outer">\
										<p class="isbn">'+data.data[i]['tiaoma']+'</p>\
										<div class="bianji_txt">\
											<input type="text"/>\
										</div>\
										<img src="'+getRoot()+'/Public/Run/img/xg.png" class="bianji_pic" attr-libId="'+data.data[i]['library_id']+'"  attr-bookId="'+data.data[i]['book_id']+'"/>\
										</td>\
										<td class="outer">\
											<p><a href="javaScript:;" class="delBook" attr-bookId="'+data.data[i]['book_id']+'">删除</a></p>\
											</td>\
											</tr>';
							}
									html +='</table>';

							$('#collectBook').html(html);

							//修改图书条码
							$(".bianji_pic").click(function(){
								var td = $(this).prev().prev();
								var input = $(this).prev();
								input.show();//文本框
								td.hide();//td框
								var tiaoma = td.text();//获取图书条码
								input.find("input").val(tiaoma);//将条码复制给文本框
								var bookId = $(this).attr('attr-bookId');//bookID
								var libId = $(this).attr('attr-libId');//libId
								//光标失焦事件
								input.find("input").blur(function(){
									var newTiaoma = $(this).val();
									//修改条码
									$.ajax({
										type:'get',
										url:"<?php echo U('Catalog/editTiaoma');?>",
										data:'tiaoma='+newTiaoma+'&bookId='+bookId+'&libId='+libId,
										dataType:'json',
										success:function(data){
											console.log(data);
											if(data.code == 1){
												td.html(newTiaoma);//给TD赋值
												input.hide();//文本框
												td.show();//td框
												return dialog.toconfirm('修改成功');
											}else {
												return dialog.error(data.message);
											}
										}
									});
								});

							});

							//删除
							$('.delBook').click(function(){
								//书籍ID
								var bookId = $(this).attr('attr-bookId');
								layer.open({
									content: '确认删除?',
									icon: 3,
									btn: ['是', '否'],
									yes: function () {
										//删除
										$.ajax({
											type:'get',
											url:"<?php echo U('Catalog/delBook');?>",
											data:'bookId='+bookId,
											dataType:'json',
											success:function(data){
												if(data.code == 1){
													return dialog.toconfirm('删除成功');
												}else {
													return dialog.error(data.message);
												}
											}
										});
									}
								});
							});
						}else {
							return dialog.error(data.message);
						}
					}
				});
			});
		})
	</script>

	</body>
</html>