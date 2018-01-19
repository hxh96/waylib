<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>404错误，您所访问的页面不存在！</title>

<link rel="stylesheet" href="/Public/Run/css/style.css"/>

</head>

<body>

<div id="errorpage">
	<div class="tfans_error">
		<div class="logo"></div>
		<div class="errortans clearfix">
			<div class="e404"></div>
			<p><b>出错啦！</b></p>
			<p>您访问的页面不存在</p>
			<div class="bt"><a href="<?php echo U('Index/index');?>">返回首页</a></div>
		</div>
	</div>
</div>

<!--实际使用请删除 -->
<div style="padding:20px 0;margin-top:30px;">
	<div style="margin-bottom:30px;text-align:center;">
		<a href="http://www.yunlib.cn" target="_blank" style="color: black;">技术支持:四川云图信息</a>
	</div>
</div>


</body>
</html>