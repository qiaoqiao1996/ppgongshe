<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\attribute\attrAdd.html";i:1528802789;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>属性添加--layui后台管理模板</title>
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
	
	<form class="layui-form" action="<?php echo url('Attribute/attrAdd'); ?>" method="post">
		<div class="layui-form-item">
			<label class="layui-form-label">属性名称</label>
			<div class="layui-input-block">
				<input type="text" name="attr_name" id="attr_name" class="layui-input newsName" lay-verify="required" placeholder="请输入属性名称" v-validate:attr_name="['required']">
			</div>
		</div>

		<div class="layui-inline">
				<label class="layui-form-label">所属商品模型</label>
				<div class="layui-input-inline">


					<select class="newsLook" name="type_id" lay-filter="browseLook">
						<option>所有商品模型</option>
						<?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['type_id'] == $type_id): ?>
		                          <option value="<?php echo $vo['type_id']; ?>" selected><?php echo $vo['type_name']; ?></option>
								<?php else: ?> 
								  <option value="<?php echo $vo['type_id']; ?>"><?php echo $vo['type_name']; ?></option>
								<?php endif; endforeach; endif; else: echo "" ;endif; ?>
				    
				    </select>
				</div>
			</div>
            <br>
			<div class="layui-inline">
			    <label class="layui-form-label">属性类型</label>
			    <div class="layui-input-block userSex">
			      	<input type="radio" name="attr_type" value="1" title="参数" checked>
			      	<input type="radio" name="attr_type" value="2" title="规格">
			    </div>
		    </div>

		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit="attrAdd" type="submit" v-if="$validation.valid">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
	</form>
	
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/attrAdd.js"></script>

</body>
</html>

<script type="text/javascript">
	 new Vue({
	 	el:"#validForm"
	 })

</script>