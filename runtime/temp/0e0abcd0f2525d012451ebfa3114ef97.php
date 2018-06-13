<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:94:"E:\web\WWW\shixun1\ppgongshe\ppgongshe\public/../application/index\view\adver\advertising.html";i:1527126810;}*/ ?>
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
<body class="childrenBody">
	<form  method="post" action="<?php echo url('adver/upload'); ?>" enctype="multipart/form-data">
		<div class="layui-form-item">
			<label class="layui-form-label">图片</label>
			<div class="layui-input-block">
				<input type="file" class="layui-input" name="a_img" >
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">是否展示</label>
			<div>
				<input type="radio" name="is_show" value="1">展示
				<input type="radio" name="is_show" value="1">否
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">图片链接</label>
			<div class="layui-input-block">
				<input type="text" name="a_path" placeholder="https://" >
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<input type="submit" value="提交">
				<input type="reset" value="重置">
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/newsAdd.js"></script>
</body>
</html>	