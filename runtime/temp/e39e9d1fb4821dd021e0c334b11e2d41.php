<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\cate\cateUp.html";i:1528974509;}*/ ?>
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
	<form class="layui-form" action="<?php echo url('cate/cateUpdo'); ?>" method="post" enctype="multipart/form-data" onsubmit="return checkform()">
		<div class="layui-form-item">
			<label class="layui-form-label">分类名称</label>
			<div class="layui-input-block">
				<input type="text" name="cat_name" id="cat_name" value="<?php echo $cate['cat_name']; ?>" class="layui-input newsName" lay-verify="required" placeholder="请输入分类名称">
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">上级分类</label>
				<div class="layui-input-inline">
					<select name="parent_id" class="newsLook" lay-filter="browseLook">
				        <option value="0">顶级分类</option>
				        <?php foreach($cate_data as $value): ?>
				        	<option value="<?php echo $value['cat_id']; ?>" 
				        	<?php if(isset($value['select'])): ?>
				        		selected="<?php echo $value['select']; ?>" 
				        	<?php endif; ?>
				        	><?php echo str_repeat("&nbsp;  ",$value['f']) ?><?php echo $value['cat_name']; ?></option>
				        <?php endforeach; ?>
				    </select>
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">分类描述</label>
			<div class="layui-input-block">
				<input type="text" name="cat_desc" id="cat_desc" value="<?php echo $cate['cat_desc']; ?>" class="layui-input newsName" lay-verify="required" placeholder="分类描述">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">排序</label>
			<div class="layui-input-block">
				<input type="text" name="sort" id="sort"  value="<?php echo $cate['sort']; ?>" class="layui-input newsName" lay-verify="required" placeholder="分类描述">
			</div>
		</div>
		<div class="layui-form-item">
		    <label class="layui-form-label">是否导航栏</label>
		    <div class="layui-input-block">
		    	<?php if($cate['is_nav'] == 1): ?>
		    	<input type="radio" name="is_nav" value="1" title="是" checked="checked">
     			<input type="radio" name="is_nav" value="0" title="否">
		    	<?php else: ?>
		    	<input type="radio" name="is_nav" value="1" title="是">
     			<input type="radio" name="is_nav" value="0" title="否" checked="checked">
		    	<?php endif; ?>
<!-- 		    	<input type="radio" name="is_nav" value="1" title="是">
     			<input type="radio" name="is_nav" value="0" title="否"> -->
		    </div>
		</div>
		<div class="layui-form-item">
		    <label class="layui-form-label">是否显示</label>
		    <div class="layui-input-block">
		    	<?php if($cate['is_show'] == 1): ?>
		    	<input type="radio" name="is_show" value="1" title="是" checked="checked">
     			<input type="radio" name="is_show" value="0" title="否">
		    	<?php else: ?>
		    	<input type="radio" name="is_show" value="1" title="是">
     			<input type="radio" name="is_show" value="0" title="否" checked="checked">
		    	<?php endif; ?>
		    	<!-- <input type="radio" name="is_show" value="1" title="是">
     			<input type="radio" name="is_show" value="0" title="否"> -->
		    </div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">分类logo</label>
			<div class="layui-input-block">
				<input type="file" class="layui-input linksUrl" lay-verify="required|url" name="cat_logo" id="cat_logo">
			</div>
		</div>

		<div class="layui-form-item">
			<div class="layui-input-block">
				<input type="hidden" name="id" value="<?php echo $cate_id; ?>">
				<input type="submit" value="立即提交" class="layui-btn">
				<!-- <button class="layui-btn" lay-submit="" lay-filter="addNews">立即提交</button> -->
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/newsAdd.js"></script>
</body>
</html>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<script type="text/javascript">
	
	function checkform(){
		var cat_name = document.getElementById('cat_name').value;
		if(cat_name == ''){
			// document.getElementById('brand_name').innerHTML('<span font></span>');
			alert('分类名称不能为空');
			return false;
		}

		var cat_desc = document.getElementById('cat_desc').value;

		if(cat_desc==''){
			alert('分类描述不能为空');
			return false;
		}

		var sort = document.getElementById('sort').value;
		if(sort == ''){
			alert('排序不能为空');
			return false;
		}

		var is_nav = document.getElementsByName('is_nav');
		if(is_nav[0].checked || is_nav[1].checked){
			
		}else{
			alert('是否导航栏不能为空');
			return false;
		}

		var is_show = document.getElementsByName('is_show');
		if(is_show[0].checked || is_show[1].checked){
			
		}else{
			alert('是否显示不能为空');
			return false;
		}
		
		var cat_logo = document.getElementById('cat_logo').value;
		if(cat_logo == ''){
			alert('分类logo不能为空');
			return false;
		}

		// var is_show = document.getElementsByName('is_show');
		// if(is_show[0].checked || is_show[1].checked){
			
		// }else{
		// 	alert('是否显示不能为空');
		// 	return false;
		// }
	}

</script>	
<script type="text/javascript">
	
	// $(document).on("click",".layui-btn",function()
	// {
	// 	// alert(1)
	// 	var cate_id = $("select[name='parent_id']").val();
	// 	// alert(cat_id);return;
	// 	// var _this = $(this);
	// 	window.status = 0;
	// 	$.ajax({
	// 		url:"<?php echo url('cate/checkCat'); ?>",
	// 		type:"post",
	// 		data:{cate_id:cate_id},
	// 		dataType:"json",
	// 		success:function(data)
	// 		{
	// 			if(data.status == 1)
	// 			{
	// 				if(data.is_del == 0)
	// 				{
	// 					alert(data.msg);
	// 				}else{
	// 					// alert(status);
	// 					window.status = 1;
	// 					// location.href=data.msg;
	// 				}
	// 			}
				
	// 		}
	// 	})
	// })

	// function sub()
	// {
	// 	var cate_id = $("select[name='parent_id']").val();
	// 	// alert(cat_id);return;
	// 	// var _this = $(this);
	// 	window.status = 0;
	// 	$.ajax({
	// 		url:"<?php echo url('cate/checkCat'); ?>",
	// 		type:"post",
	// 		data:{cate_id:cate_id},
	// 		dataType:"json",
	// 		success:function(data)
	// 		{
	// 			if(data.status == 1)
	// 			{
	// 				if(data.is_del == 0)
	// 				{
	// 					alert(data.msg);
	// 				}else{
	// 					// alert(status);
	// 					window.status = 1;
	// 					// location.href=data.msg;
	// 				}
	// 			}
				
	// 		}
	// 	})
	// 	// alert(status);
	// 	if(window.status == 1)
	// 	{
	// 		alert(window.status);
	// 		return true;
	// 	}else{
	// 		alert(window.status);
	// 		return false;
	// 	}
	// 	// return false;
	// }
</script>