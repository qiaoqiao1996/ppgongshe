<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"E:\phpstudy\WWW\ppgongshe\public/../application/index\view\opinion\details.html";i:1529032500;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>意见列表--layui后台管理模板</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">

	<link href="__CSS__/style.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="__JS__/jquery-1.11.0.min.js"></script> 
	<script type="text/javascript" src="__JS__/jquey-bigic.js"></script> 
<style>

body img {
	width: 100px;
	height: 100px;
}
</style>
</head>
<body class="childrenBody">
	<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
	<div style=" margin-right:20px;float: left;">
		<img class="test" src="http://www.ppcom.cn/uploads/<?=$v['img']?>" alt="">
	</div>
	<?php endforeach; endif; else: echo "" ;endif; ?>
	<script type="text/javascript">
	$(function(){
		$('img').bigic();
	});
	</script> 
</body>
</html>