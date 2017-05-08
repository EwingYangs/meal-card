<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>“饭卡回家”系统登录</title>
    <link rel="stylesheet" href="/Public/Home/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/Public/Home/css/login.css" type="text/css">
</head>
<body>
	
	<form action="<?php echo U('login')?>" method="post">
		<div class="logo">
			<img src="/Public/Home/images/1.jpg" alt="“饭卡回家”失物招领系统">
		</div>
		<p>
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			<input name="sno" type="text" placeholder="学号" class="user" />
		</p>
		<p>
			<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
			<input name="password" type="password" placeholder="密码" class="pwd" />
		</p>
		<div class="btnbox">
			<input type="submit" class="btn btn-primary" value="登录" style="width:55px;height:33px">
			<a type="button" class="btn btn-primary" href="<?php echo U('register')?>">注册</a>
		</div>
	</form>

</body>
<script src="/Public/Home/js/jquery/jquery.min.js"></script>
<script src="/Public/Home/js/layui/layer.js"></script>
<script src="/Public/Home/js/bootstrap/js/bootstrap.min.js"></script>
<script src="/Public/Home/js/login.js"></script>
</html>