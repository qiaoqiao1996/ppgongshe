<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\buurt\slideshow.html";i:1528800654;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>系统基本参数--layui后台管理模板</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="__CSS__/font_eolqem241z66flxr.css" media="all" />
	<style type="text/css">
		.layui-table td, .layui-table th{ text-align: center; }
		.layui-table td{ padding:5px; }
	</style>
</head>
<body class="childrenBody">
	<form class="layui-form" action="<?php echo url('buurt/img_at'); ?>" method="post" enctype="multipart/form-data">
		<table class="layui-table">
		    <tbody>
				<tr>
					<tr>
						<td>社区名称：</td>
						<td>
							<select name="com_id">

								<option>请选择...</option>
								<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $key = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($key % 2 );++$key;?>
									<option value="<?php echo $val['com_id']; ?>"><?php echo $val['com_name']; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</td>
					</tr>
					<td><span id="increase"><b>[+]</b></span></td>
					<span>
						<span class="span">
							<td>社区名称:</td>
							<td>
								<input type="text" name="adv_name[]">
							</td>
						</span>
						<span class="span">
							<td>社区链接:</td>
							<td>
								<input type="text" name="adv_url[]">
							</td>
						</span>
						<span class="span">
							<td>社区图片:</td>
							<td>
								<input type="file" name="adv_img[]">
							</td>
						</span>
					</span>
				</tr>
		    </tbody>
		</table>
		<div class="layui-form-item" style="text-align: center;">
			<div class="layui-input-block">
				<input type="submit" value="立即提交" class="layui-btn">
				<input type="reset" value="重置" class="layui-btn layui-btn-primary">
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/systemParameter.js"></script>
	<script type="text/javascript" src="__JS__/jquery-1.8.2.min.js"></script>
	<script type="text/javascript">
		/*
			*鼠标划上
		*/
		$(function(){
			$('#increase').hover(function(){
				$(this).css('color','red');
			},function(){
				$(this).css('color','black');
			})
		})
		/*
			*点击【+】
		*/
		$(document).on('click','#increase',function(){
			var span = $(this).html();
			if(span == '<b>[+]</b>'){
				$(this).html('<b>[-]</b>');
				var tr = $(this).parent().parent().clone();
				$(this).html('<b>[+]</b>');
				$(this).parent().parent().after(tr);
			}else{
				$(this).parent().parent().remove();
			}
		})
		/*
			url验证
		*/
	</script>
</body>
</html>