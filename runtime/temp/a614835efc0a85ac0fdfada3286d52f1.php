<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"E:\phpstudy\WWW\ppgongshe\public/../application/index\view\repair\xqlist.html";i:1529032540;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>详细信息</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="__CSS__/font_eolqem241z66flxr.css" media="all" />
	<link rel="stylesheet" href="__CSS__/style.css">


	<style>
		
		    select{

    background-color: #ffffff;
    background-image: none !important;
    filter: none !important;
    border: 1px solid #e5e5e5;
    outline: none;
    height: 30px !important;
    line-height: 25px;
}
	</style>
</head>
<body class="childrenBody">
	
		<div class="layui-form-item">
			<center><h1>详细信息</h1></center>
			
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">订单号</label>
			<div class="layui-input-block">
			
				<span class="layui-input" style="border:none"><?php echo $data['l_numbers']; ?></span>
			</div>
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">报修时间</label>
			<div class="layui-input-block">
				
				<span class="layui-input" style="border:none"><?php echo $data['l_time']; ?></span>
			</div>
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">报修类型</label>
			<div class="layui-input-block">
				
				<span class="layui-input" style="border:none"><?php echo $data['t_name']; ?></span>
			</div>
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">报修人</label>
			<div class="layui-input-block">
				
				<span class="layui-input" style="border:none"><?php echo $data['l_name']; ?></span>
			</div>
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">报修人手机</label>
			<div class="layui-input-block">
				
				<span class="layui-input" style="border:none"><?php echo $data['l_tel']; ?></span>
			</div>
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">报修人地址</label>
			<div class="layui-input-block">
				
				<span class="layui-input" style="border:none"><?php echo $data['l_address']; ?></span>
			</div>
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">描述</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea  goods_desc" name="goods_desc" lay-verify="content" id="news_content"><?php echo $data['l_content']; ?></textarea>
				<?php if(is_array($data['l_img']) || $data['l_img'] instanceof \think\Collection || $data['l_img'] instanceof \think\Paginator): if( count($data['l_img'])==0 ) : echo "" ;else: foreach($data['l_img'] as $k=>$v): if($k != ''): ?>
				 <img src="http://www.ppcom.cn/uploads/<?=$data['l_img'][$k]?>" style="width: 100px">
				<?php endif; endforeach; endif; else: echo "" ;endif; ?>
				<!-- <span class="goodsdesc"></span> -->
			</div>
		</div>
		
		
		<div class="layui-form-item">
			<div class="layui-input-block">

			<?php switch($data['l_status']): case "0": ?><button type="submit" class="layui-btn btn" >进行中</button><?php break; case "1": ?><button type="submit" class="layui-btn btn" >已催单</button><?php break; default: ?><button type="submit" class="layui-btn btn" >已处理</button>
			<?php endswitch; ?>


				
				<a href="javascript:history.go(-1)" class="layui-btn layui-btn-primary">返回</a>
		    </div>
		</div>
	
<!-- 	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/newsAdd.js"></script> -->
</body>
</html>
	<script type="text/javascript" src="__JS__/jquery-1.11.0.min.js"></script> 
	<script type="text/javascript" src="__JS__/jquey-bigic.js"></script> 
	<script type="text/javascript">
	$(function(){
		$('img').bigic();
	});

   </script>
