<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"E:\phpstudy\WWW\ppgongshe\public/../application/index\view\goods\goods_add.html";i:1528978627;}*/ ?>
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
	<form action="__URL__/goodsAdd" method="post" onsubmit="return myFunction()">
		<div class="layui-form-item">
			<center><h1>请添加数据(必须添写)</h1></center>
			
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">商品名称</label>
			<div class="layui-input-block">
				<input type="text" name="goods_name"  class="layui-input goods_name" lay-verify="required" >
				<span class="goodsname"></span>
			</div>
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">货号</label>
			<div class="layui-input-block">
				<input type="text" name="goods_sn"  class="layui-input goods_sn" lay-verify="required" >
				<span class="goodssn"></span>
			</div>
		</div></br>
		<div class="layui-inline">
				<label class="layui-form-label">品牌</label>
				<div class="layui-input-inline">
					<select name="brand_id" class="newsLook" lay-filter="browseLook">
						<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
				        <option value="<?php echo $v['brand_id']; ?>"><?php echo $v['brand_name']; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>
				    </select>
				</div>
		</div></br>
		<div class="layui-inline">
				<label class="layui-form-label">展示标题</label>
				<div class="layui-input-inline">
					<select name="title_id" class="newsLook title_id" lay-filter="browseLook">
						<?php if(is_array($det) || $det instanceof \think\Collection || $det instanceof \think\Paginator): if( count($det)==0 ) : echo "" ;else: foreach($det as $key=>$v): ?>
				        <option value="<?php echo $v['title_id']; ?>"><?php echo $v['title_name']; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>
				    </select>
				</div>
		</div></br>
		<div class="layui-inline">
				<label class="layui-form-label">商品分类</label>
				<div class="layui-input-block">
					<select name="cat_id" class="userGrade" lay-filter="userGrade">
						<option value="">请选择</option>
						  <option value="0">顶级分类</option>
				        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
				        <option value="<?php echo $v['cat_id']; ?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$v['level']) ;?><?php echo $v['cat_name']; ?></option>
				        <?php endforeach; endif; else: echo "" ;endif; ?>
				    </select><span></span>
				</div>
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">商品库存数量</label>
			<div class="layui-input-block">
				<input type="text" name="goods_number"  class="layui-input newsName goods_number" lay-verify="required" >
				<span class="goodsnumber"></span>
			</div>
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">成本价</label>
			<div class="layui-input-block">
				<input type="text" name="market_price"  class="layui-input newsName market_price" lay-verify="required" >
				<span class="marketprice"></span>
			</div>
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">本店售价</label>
			<div class="layui-input-block">
				<input type="text" name="shop_price"  class="layui-input newsName shop_price" lay-verify="required" >
				<span class="shopprice"></span>
			</div>
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">商品关键字</label>
			<div class="layui-input-block">
				<input type="text" name="keywords"  class="layui-input newsName keywords" lay-verify="required" >
				<span class="keyword"></span>
			</div>
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">商品描述</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea  goods_desc" name="goods_desc" lay-verify="content" id="news_content"></textarea>
				<!-- <span class="goodsdesc"></span> -->
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">购买商品可以使用的公分</label>
			<div class="layui-input-block">
				<input type="text" name="integral"  class="layui-input integral" lay-verify="required" >
				<span class="integra"></span>
			</div>
		</div></br>
		<div class="layui-form-item">
			<label class="layui-form-label">购买该商品时每笔成功交易赠送的积分数量</label>
			<div class="layui-input-block">
				<input type="text" name="give_integral"  class="layui-input give_integral" lay-verify="required" >
				<span class="giveintegral"></span>
			</div>
		</div></br>
		<div class="layui-inline">
				<label class="layui-form-label">商品所属类型</label>
				<div class="layui-input-inline">
					<select name="type_id" class="newsLook" lay-filter="browseLook">
						<?php if(is_array($date) || $date instanceof \think\Collection || $date instanceof \think\Paginator): if( count($date)==0 ) : echo "" ;else: foreach($date as $key=>$vo): ?>
				        	<option value="<?php echo $vo['type_id']; ?>"><?php echo $vo['type_name']; ?></option>
				        <?php endforeach; endif; else: echo "" ;endif; ?>
				    </select>
				</div>
		</div></br>
	
				<label class="layui-form-label">商品所属地区</label>
				
	  
	  
		 <div>
  
		  <div>
		    <select name="location_p" id="location_p">
		    </select>
		    <select name="location_c" id="location_c">
		    </select>
		    <select name="location_a" id="location_a">
		    </select>
		    <script src="__ROOT__/region_select.js"></script>
		    <script type="text/javascript">
				new PCAS('location_p', 'location_c', 'location_a', '±±¾©ÊÐ', '', '');
			</script>
		  </div>
		</div>
		 
		
		
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button type="submit" class="layui-btn btn" value="立即提交">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
	</form>
<!-- 	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/newsAdd.js"></script> -->
</body>
</html>
<script type="text/javascript" src='__JS__/jquery-1.8.2.min.js'></script>
<script>
	
	
		$(document).on('blur','.goods_name',function(){
			var goods_name=$('.goods_name').val()
			if(goods_name==''){
				$('.goodsname').html("商品名称不能为空")
				return false
			}else{
				$('.goodsname').html("")
				return true
			}
		})
		
		$(document).on('blur','.goods_sn',function(){
			var goods_sn=$('.goods_sn').val()
			if(goods_sn==''){
				$('.goodssn').html("货号不能为空")
				return false
			}else{
				$('.goodssn').html("")
				return true
			}
		})

		$(document).on('blur','.goods_number',function(){
			var goods_number=$('.goods_number').val()
			if(goods_number==''){
				$('.goodsnumber').html("商品数量不能为空")
				return false
			}else{
				$('.goodsnumber').html("")
				return true
			}
		})
		
		
		$(document).on('blur','.market_price',function(){
			var market_price=$('.market_price').val()
			if(market_price==''){
				$('.marketprice').html("成本价不能为空")
				return false
			}else{
				$('.marketprice').html("")
				return true
			}
		})
		


		$(document).on('blur','.shop_price',function(){
			var shop_price=$('.shop_price').val()
			if(shop_price==''){
				$('.shopprice').html("本店售价不能为空")
				return false
			}else{
				$('.shopprice').html("")
				return true
			}
		})
		



		$(document).on('blur','.keywords',function(){
			var keywords=$('.keywords').val()
			if(keywords==''){
				$('.keyword').html("关键字不能为空")
				return false
			}else{
				$('.keyword').html("")
				return true
			}
		})
		



		$(document).on('blur','.goods_desc',function(){
			var goods_desc=$('.goods_desc').val()
			if(goods_desc==''){
				$('.goodsdesc').html("商品描述不能为空")
				return false
			}else{
				$('.goodsdesc').html("")
				return true
			}
		})
		



		$(document).on('blur','.integral',function(){
			var integral=$('.integral').val()
			if(integral==''){
				$('.integra').html("商品公分不能为空")
				return false
			}else{
				$('.integra').html("")
				return true
			}
		})
		





		$(document).on('blur','.give_integral',function(){
			var give_integral=$('.give_integral').val()
			if(give_integral==''){
				$('.giveintegral').html("商品返回公分不能为空")
				return false
			}else{
				$('.giveintegral').html("")
				return true
			}
		})
		
		$(document).on('click','.btn',function(){
			var give_integral=$('.give_integral').val()
			var integral=$('.integral').val()
			var goods_desc=$('.goods_desc').val()
			var keywords=$('.keywords').val()
			var shop_price=$('.shop_price').val()
			var market_price=$('.market_price').val()
			var goods_name=$('.goods_name').val()
			var goods_sn=$('.goods_sn').val()
			var goods_number=$('.goods_number').val()
			if(give_integral==''){
				alert('商品返回公分不能为空')	
				return false
			}else{
				if(integral==''){
					alert('商品公分不能为空')
					return false
				}else{
					if(goods_desc==''){
						alert('商品描述不能为空')
						return false
					}else{
						if(keywords=''){
							alert('关键字不能为空')
							return false
						}else{
							if(shop_price==''){
								alert('本店售价不能为空')
								return false
							}else{
								if(market_price=''){
									alert('成本价不能为空')
									return false
								}else{
									if (goods_name=='') {
										alert('商品名称不能为空')
										return false
									}else{
										if(goods_sn==''){
											alert('商品货号不能为空')
											return false
										}else{
											if(goods_number==''){
												alert('商品数量不能为空')
												return false
											}
										}
									}
								}
							}
						}
					}
				}
			}
		})



		$(document).on("click",".keywords",function(){
			var name=$('.goods_name').val()
			$('.keywords').val(name)
		})
</script>
