<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\www\wamp\www\ppgongshe\public/../application/index\view\mobilecard\card_add.html";i:1527240122;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>手机号添加--layui后台管理模板</title>
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
	<form class="layui-form" method="post" action="<?php echo url('Mobilecard/cardAdd'); ?>" enctype="multipart/form-data">	
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">选择运营商</label>
				<div class="layui-input-inline">
					<select name="type_id" class="card_type" id="card_type" lay-filter="browseLook">
				        <option value="1" type_id='1'>移动</option>
				        <option value="2" type_id='2'>联通</option>
				        <option value="3" type_id='3'>电信</option>
				    </select>
				</div>
			</div>
			<div class="layui-inline">
			<label class="layui-form-label">选择套餐</label>
				<div class="layui-input-inline">
					<select name="meal_id" class="meal" id="meal" lay-filter="browseLook1">
				        <option value="0">请选择套餐</option>
				        <?php foreach($data as $v): ?>
				        	<option value="<?php echo $v['details_id']; ?>"><?php echo $v['d_name']; ?></option>
				        <?php endforeach; ?>
				    </select>
				</div>
			</div>
			<input type="file" name="cardFile" id=""/>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit="" lay-filter="addCards">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
	</form>
	<?php if(isset($error)){?>
		<table  class="layui-table">
			<tr>
				<th>未添加号码</th>
				<th>原因</th>
			</tr>
			<?php foreach($error as $k => $v): ?>
			<tr>
				<td><?php echo $v['tel']; ?></td>
				<td><?php echo $v['error']; ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	<?php }?>	
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/cardAdd.js"></script>
</body>
</html>