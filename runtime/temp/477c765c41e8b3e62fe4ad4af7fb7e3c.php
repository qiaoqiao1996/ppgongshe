<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"E:\phpstudy\WWW\ppgongshe\public/../application/index\view\brand\brand.html";i:1528978627;}*/ ?>
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
		
		<div class="layui-inline">
			<a class="layui-btn layui-btn-normal " href="<?php echo url('brand/brandAdd'); ?>">添加品牌</a>
		</div>
		
		<div class="layui-inline">
			<div class="layui-form-mid layui-word-aux">本页面刷新后除新添加的文章外所有操作无效，关闭页面所有数据重置</div>
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
		   </thead>
		    <thead>
				<tr>
					<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>
					<th>品牌名称</th>
					<th>品牌描述</th>
					<th>品牌排序</th>
					<th>是否显示</th>
					<th>操作</th>
				</tr> 
				<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr class="tr" brand_id="<?php echo $vo['brand_id']; ?>">
					<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>
					<td>
						<span><?php echo $vo['brand_name']; ?></span>
						<span><img src="../../../../../uploads/<?php echo $vo['brand_logo']; ?>"  alt="" width="100px"></span>
					</td>
					<td><?php echo $vo['brand_desc']; ?></td>
					<td><?php echo $vo['sort_order']; ?></td>
					<td>
						<?php 
							if($vo['is_show'] == '0'){
								echo "<span>未启用</span>";
							}
						 
						 	if($vo['is_show'] == '1'){
						 		echo "<span>已启用</span>";
						 	}
						  ?>
					</td>
					<td align="center"><a href="<?php echo url('brandDelete'); ?>?id=<?php echo $vo['brand_id']; ?>">删除</a> | <a href="<?php echo url('brandUpdate'); ?>?id=<?php echo $vo['brand_id']; ?>">修改</a></td>
				</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
		    </thead>
		    <tbody class="news_content"></tbody>
		</table>
	</div>
	<div id="page"></div>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/newsList.js"></script>
</body>
</html>