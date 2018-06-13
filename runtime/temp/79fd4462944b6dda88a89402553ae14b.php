<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\attribute\attrRedirect.html";i:1527163064;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>文章列表--layui后台管理模板</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="__CSS__/font_eolqem241z66flxr.css" media="all" />
	<link rel="stylesheet" href="__CSS__/news.css" media="all" />
</head>
<body class="childrenBody">
	<blockquote class="layui-elem-quote news_search">
	
		<span>添加[<?php echo $data['attr_name']; ?>]成功。</span><br>
		<a href="<?php echo url('Attribute/attrAdd'); ?>?type_id=<?php echo $data['type_id']; ?>" style="color: blue">添加下一个属性</a><br>
		<a href="<?php echo url('Attribute/attrList'); ?>" style="color: blue">返回属性列表</a>
	
	</blockquote>
	
	<div id="page"></div>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/newsList.js"></script>
</body>
</html>