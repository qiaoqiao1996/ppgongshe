<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\cate\cateList.html";i:1528974509;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>分类列表</title>
	<link rel="stylesheet" href="__CSS__/news.css" media="all" />
	<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" />
	<!-- <link rel="stylesheet" href="__CSS__/font_eolqem241z66flxr.css" media="all" /> -->
</head>
<body class="childrenBody">
	<blockquote class="layui-elem-quote news_search">
		<div class="layui-inline">
		    <div class="layui-input-inline">
		    	<input type="text" value="" placeholder="请输入关键字" class="layui-input search_input">
		    </div>
		    <a class="layui-btn search_btn">查询</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-normal newsAdd_btn" href="<?php echo url('cate/cateAdd'); ?>">添加分类</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-danger batchDel">批量删除</a>
		</div>
		<div class="layui-inline">
			<div class="layui-form-mid layui-word-aux">本页面刷新后除新添加的文章外所有操作无效，关闭页面所有数据重置</div>
		</div>
	</blockquote>
	<div class="layui-form news_list">
		<form class="layui-form">
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
					<th>
						<input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose">
					</th>
					<th style="text-align:left;">分类名称</th>
					<th style="text-align:center;">商品数量</th>
					<th style="text-align:center;">操作</th>
				</tr> 
		    </thead>
		    <tbody class="news_content">
		    	<?php foreach($cate_data as $value): ?>
		    	<tr id=<?php echo $value['cat_id']; ?>>
		    		<td><input type="checkbox" name=""></td>
		    		<td style="text-align:left;"><?php echo str_repeat("&nbsp;&nbsp;&nbsp;  ",$value['f']) ?><?php echo $value['cat_name']; ?></td>
		    		<td style="text-align:left;"><?php echo $value['count']; ?></td>
		    		<td><a href="javascript:void(0)" class="up">编辑</a> | <a href="javascript:void(0)" class="del">删除</a></td>
		    	</tr>
		    	<?php endforeach; ?>
		    </tbody>
		</table>
		</form>
	</div>
	<div id="page"></div>
	<script type="text/javascript" src="__JS__/newsList.js"></script>
</body>
</html>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<script type="text/javascript">
	$(document).on("click",".del",function()
	{
		var cate_id = $(this).parents("tr").attr("id");
		var _this = $(this);

		$.ajax({
			url:"<?php echo url('cate/cateDel'); ?>",
			type:"post",
			data:{cate_id:cate_id},
			dataType:"json",
			success:function(data)
			{
				if(data.status == 1)
				{
					if(data.is_del == 0 || data.is_del == 2 || data.is_del == 3)
					{
						alert(data.msg);
					}else{
						_this.parents("tr").remove();
					}
				}
				
			}
		})
	})

	$(document).on("click",".up",function()
	{
		var cate_id = $(this).parents("tr").attr("id");
		var _this = $(this);

		$.ajax({
			url:"<?php echo url('cate/checkUp'); ?>",
			type:"post",
			data:{cate_id:cate_id},
			dataType:"json",
			success:function(data)
			{
				if(data.status == 1)
				{
					if(data.is_del == 0 || data.is_del == 2 || data.is_del == 3)
					{
						alert(data.msg);
					}else{
						location.href=data.msg+"?id="+data.cate_id;
					}
				}
				
			}
		})
	})
</script>