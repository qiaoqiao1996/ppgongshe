<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\brand\brandAdd.html";i:1528974509;}*/ ?>
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

	<form class="layui-form" style="width:80%;"  action="<?php echo url('brand/brandAdd'); ?>" method="post" enctype="multipart/form-data" onsubmit="return checkform()">
		<div class="layui-form-item">
			<label class="layui-form-label">品牌名称</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input linksName" lay-verify="required" placeholder="请输入品牌名称" name="brand_name" id="brand_name">
			</div>
			<div>
          <p class="error_p2"><i class="glyphicon glyphicon-info-sign"></i>注册错误信息</p>
        </div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">品牌logo</label>
			<div class="layui-input-block">
				<input type="file" class="layui-input linksUrl" lay-verify="required|url" name="brand_logo" id="brand_logo">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">品牌描述</label>
			<div class="layui-input-block">
				<textarea placeholder="请输入品牌描述" class="layui-textarea linksDesc" name="brand_desc" id="brand_desc"></textarea>
			</div>
		</div>		
			<div class="layui-inline">		
				<label class="layui-form-label">品牌排序</label>
				<div class="layui-input-inline">
					<input type="text" class="layui-input linksTime" lay-verify="date" name="sort_order" id="sort_order">
				</div>
			</div>
		</div>

		<div class="layui-form-item">
		    <label class="layui-form-label">是否显示</label>
		    <div class="layui-input-block">
		    	<input type="radio" name="is_show" value="1" title="是" id="is_show">
     			<input type="radio" name="is_show" value="0" title="否" id="is_show">
		    </div>
		</div>
	
		<div class="layui-form-item">
			<div class="layui-input-block">

				<input type="submit" value="提交" class="layui-btn layui-btn-primary">
				<input type="reset" class="layui-btn layui-btn-primary" value="重置">
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/linksAdd.js"></script>
</body>
</html>

<script>
function checkform(){
		var brand_name = document.getElementById('brand_name').value;
		if(brand_name == ''){

			alert('品牌名称不能为空');
			return false;
		}

		var brand_logo = document.getElementById('brand_logo').value;

		if(brand_logo==''){
			alert('品牌logo不能为空');
			return false;
		}

		var brand_desc = document.getElementById('brand_desc').value;
		if(brand_desc == ''){
			alert('品牌描述不能为空');
			return false;
		}
		var sort_order = document.getElementById('sort_order').value;
		if(sort_order == ''){
			alert('品牌排序不能为空');
			return false;
		}

		var is_show = document.getElementsByName('is_show');
		if(is_show[0].checked || is_show[1].checked){
			
		}else{
			alert('是否显示不能为空');
			return false;
		}
	}
	
</script>