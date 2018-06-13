<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\buurt\slidestrate.html";i:1528799524;}*/ ?>
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
		<!--<div class="layui-inline">-->
		    <!--<div class="layui-input-inline">-->
		    	<!--<input type="text" value="" placeholder="请输入关键字" class="layui-input search_input">-->
		    <!--</div>-->
		    <!--<a class="layui-btn search_btn">查询</a>-->
		<!--</div>-->
		<!--<div class="layui-inline">-->
			<!--<a class="layui-btn layui-btn-danger batchDel">批量删除</a>-->
		<!--</div>-->
		<div class="layui-inline">
			<div class="layui-form-mid layui-word-aux">本页面刷新后除新添加的链接外所有操作无效，关闭页面所有数据重置</div>
		</div>
	</blockquote>
	<div class="layui-form links_list">
	  	<table class="layui-table">
		    <thead>
				<tr>
					<!--<th><input type="checkbox" name="zhu" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>-->
					<th>社区广告名称</th>
					<th>社区广告链接</th>
					<th>社区广告图片</th>
				</tr> 
		    </thead>
		    <tbody class="links_content">
		    	<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($k % 2 );++$k;?>
			    	<tr>
			    		<!--<td><input type="checkbox" name="fu" lay-skin="primary" lay-filter="allChoose" id="allChoose"></td>-->
			    		<td><?php echo $val['adv_name']; ?></td>
			    		<td><?php echo $val['adv_url']; ?></td>
			    		<td><img src="../../../../uploads/<?php echo $val['adv_img']; ?>" width="100px" height="100px"></td>
			    	</tr>
		    	<?php endforeach; endif; else: echo "" ;endif; ?>
		    </tbody>
		</table>
	</div>
	<div id="page"></div>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/linksList.js"></script>
</body>
</html>