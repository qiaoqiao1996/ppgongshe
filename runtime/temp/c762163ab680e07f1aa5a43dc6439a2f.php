<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"E:\phpstudy\WWW\ppgongshe\public/../application/index\view\showtitle\titleAdd.html";i:1528978627;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>文章添加--layui后台管理模板</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="__CSS__/font_eolqem241z66flxr.css" media="all" />
</head>
<body class="childrenBody" >
	<form class="layui-form" action="" method="post">

		<div class="layui-form-item">
			<label class="layui-form-label">标题名称</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input newsName" lay-verify="required"  name="title_name" id="title_name" ><span></span>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
			<button type="submit" class="layui-btn" lay-filter="addNews" id="button">立即提交</button>
               <input type="reset" value="重置" class="layui-btn layui-btn-primary">
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/newsAdd.js"></script>
</body>
<script  type="text/javascript" src="__ROOT__/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
	$('#button').on('click',function(){
		var title_name=$("#title_name").val();
		if (title_name=="") {
           $('#title_name').next().html("<font color='red'>标题不能为空</font>")
           return false
		}
	})
</script>
</html>