<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"E:\web\WWW\shixun1\ppgongshe\ppgongshe\public/../application/index\view\adver\show.html";i:1528074352;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>商品模型--layui后台管理模板</title>
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
		
		<div class="layui-inline">
			<a class="layui-btn layui-btn-normal " href="<?php echo url('adver/advertising'); ?>">添加广告</a>
		</div>
		
	</blockquote>
	<div class="layui-form news_list">
	  	<table class="layui-table">
		    <colgroup>
				<col width="50">
				<col>
				<col width="9%">
				<col width="9%">
				<col width="9%">
				<col width="9%">
				<col width="9%">
				<col width="15%">
		    </colgroup>
		    <thead>
				<tr>
					<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>
					<th>图片</th>
					<th>图片链接地址</th>
					<th>操作</th>
				</tr> 
		    </thead>
		    <tbody class="news_content">
		    	
		    	<?php foreach($data as $vo): ?>
		    		<tr>
		    			<th><?php echo $vo['a_id']; ?></th>
		    			<th><img src="/uploads/<?php echo $vo['a_img']; ?>" width="100px"></th>
		    			<th><?php echo $vo['a_path']; ?></th>
		    			<th><a href="">删除</a>||<a href="">修改</a></th>
		    		</tr>
		    	<?php endforeach; ?>

		    </tbody>
		</table>
	</div>
	<div id="page"></div>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/newsList.js"></script>
</body>
</html>