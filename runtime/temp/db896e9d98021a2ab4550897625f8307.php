<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\img\img_add.html";i:1527900474;}*/ ?>
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
	<form class="layui-form" action="__URL__/imgAdd" method="post"  enctype="multipart/form-data">
		<div class="layui-form-item">
			<label class="layui-form-label">商品名称</label>
			<div class="layui-input-block">
				<select name="goods_id" class="newsLook" lay-filter="browseLook">
						<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
				        <option value="<?php echo $v['goods_id']; ?>"><?php echo $v['goods_name']; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>
				    </select>
			</div>
		</div>
		
	
		<div class="layui-form-item">
			<label class="layui-form-label">添加图片</label>
			<div class="layui-input-block">
				<input type="file" class="file" name="img_path[]"> <span class="jia" style="cursor: pointer;">[+]</span><br>
			</div>
		</div>
		
		
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn btn" type="submit" value="立即提交">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/newsAdd.js"></script>
</body>
</html>
<script src="__JS__/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
	$(document).on("click",".jia",function(){
		if($(this).html()=="[+]")
		{
			$(this).html("[-]")
			var div=$(this).parent().clone()
			$(this).html("[+]")
			$(this).parent().after(div)
		}
		else
		{
			$(this).parent().remove()
		}
		
	})


	$(document).on("click",".btn",function(){
 		var result = false;
 		var file=$('.file').each(function(){
 			if($(this).val()==''){
 				alert('请添加图片')
 				  
                 result = false;  
	 		}else{
	 			result=true;
	 		}
 		})
 		 if (result==false) {
 		 	return false; 
 		 }
 		 

 	})
</script>