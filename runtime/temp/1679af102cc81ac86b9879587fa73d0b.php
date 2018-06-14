<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\brand\brandUpdate.html";i:1528977185;}*/ ?>
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

	<form class="layui-form" style="width:80%;" action="<?php echo url('brand/brandSave'); ?>" method="post" enctype="multipart/form-data" >
		<tr>
	     	<td><input type="hidden" name="brand_id" value="<?php echo $res['brand_id']; ?>"></td>
	     </tr>
		<div class="layui-form-item">
			<label class="layui-form-label">品牌名称</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input linksName" lay-verify="required" placeholder="请输入品牌名称" name="brand_name" value="<?php echo $res['brand_name']; ?>">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">品牌logo</label>
			<div class="layui-input-block">
			<img src="../../../../../uploads/<?php echo $res['brand_logo']; ?>"  alt="" width="100px">
				<input type="file" class="layui-input linksUrl" lay-verify="required|url" name="brand_logo" value="<?php echo $res['brand_logo']; ?>">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">品牌描述</label>
			<div class="layui-input-block">
				<textarea placeholder="请输入品牌描述" class="layui-textarea linksDesc" name="brand_desc"><?php echo $res['brand_desc']; ?></textarea>
			</div>
		</div>		
			<div class="layui-inline">		
				<label class="layui-form-label">品牌排序</label>
				<div class="layui-input-inline">
					<input type="text" class="layui-input linksTime" lay-verify="date" name="sort_order" value="<?php echo $res['sort_order']; ?>">
				</div>
			</div>
		</div>

		<div class="layui-form-item">
		    <label class="layui-form-label">是否显示</label>
		    <div class="layui-input-block">
		    	<input type="radio" name="is_show" value="1" title="是" <?php if($res['is_show'] == 1): ?>checked<?php endif; ?>>
     			<input type="radio" name="is_show" value="0" title="否" <?php if($res['is_show'] == 0): ?>checked<?php endif; ?>>
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