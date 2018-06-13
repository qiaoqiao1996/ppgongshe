<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\type\typeUpdate.html";i:1527319686;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>模型添加--layui后台管理模板</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="__CSS__/font_eolqem241z66flxr.css" media="all" />

	 <script src="__ROOT__/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/vue.validator/2.1.6/vue-validator.min.js"></script>
</head>
<body class="childrenBody" id="validForm">
	<form class="layui-form" method="post" action="<?php echo url('Type/typeUpdate'); ?>">
		<div class="layui-form-item">
			<label class="layui-form-label">模型名称</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input typeName" value="<?php echo $msg['type_name']; ?>" disabled="true" id="type_name" name="type_name" lay-verify="required"v-validate:type_name="['required']">
			</div>
		</div>
	    <input type="hidden" name="type_id" value="<?php echo $msg['type_id']; ?>">


		<div class="layui-inline">
			    <label class="layui-form-label">属性类型</label>
			    <div class="layui-input-block userSex">
			    	<?php if($msg['enabled'] == 1): ?>
                         <input type="radio" name="enabled" value="1" title="启用" checked>
			      	     <input type="radio" name="enabled" value="0" title="不启用">
          						<?php else: ?> 
          				 <input type="radio" name="enabled" value="1" title="启用">
			      	     <input type="radio" name="enabled" value="0" title="不启用" checked>
          						<?php endif; ?>
			      	
			    </div>
		    </div>


		<div class="layui-form-item">
			<label class="layui-form-label">模型详情</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea layui-hide type_content" name="type_content" lay-verify="content" id="news_content"><?php echo $msg['type_content']; ?></textarea>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit="" lay-filter="typeAdd" v-if="$validation.valid">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/typeAdd.js"></script>
</body>
</html>
<script type="text/javascript">
	 new Vue({
	 	el:"#validForm"
	 })

</script>

