<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"E:\phpstudy\WWW\ppgongshe\public/../application/index\view\goodscategory\categoryAdd.html";i:1528978627;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>会员添加--layui后台管理模板</title>
	<meta name="renderer" content="webkit">
	<!-- <link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" /> -->
	<script src="https://cdn.jsdelivr.net/vue.validator/2.1.6/vue-validator.min.js"></script>
    <script src="__ROOT__/vue.js"></script>	
	<style type="text/css">
		.layui-form-item .layui-inline{ width:33.333%; float:left; margin-right:0; }
		@media(max-width:1240px){
			.layui-form-item .layui-inline{ width:100%; float:none; }
		}
		    select{

    background-color: #ffffff;
    background-image: none !important;
    filter: none !important;
    border: 1px solid #e5e5e5;
    outline: none;
    height: 30px !important;
    line-height: 25px;
}

	input[type="text"]{
		width: 200px;
		height: 25px;
	}
	textarea{
		width: 400px;
		height: 200px;
	}
	label{
		margin-top:50px;
	}
	</style>
	<script src="__ROOT__/vue.js"></script>
</head>
<body class="childrenBody" id="validForm" > 
	<form class="layui-form" style="width:80%;" action="" method="post" enctype="multipart/form-data">
		<div class="layui-form-item" >
			<label class="layui-form-label">分类名称</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input" lay-verify="required" placeholder="请输入分类名称" name="cat_name"  id="cat_name"
				/><span></span>
			</div>
		</div>	
		<br>
		    <div class="layui-inline">
			 <label class="layui-form-label">上级分类</label>
				<div class="layui-input-block">
					<select name="parent_id" class="userGrade" lay-filter="userGrade">
						<option value="">请选择</option>
						  <option value="0">顶级分类</option>
				        <?php if(is_array($datas) || $datas instanceof \think\Collection || $datas instanceof \think\Paginator): $i = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
				        <option value="<?php echo $v['cat_id']; ?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$v['level']) ;?><?php echo $v['cat_name']; ?></option>
				        <?php endforeach; endif; else: echo "" ;endif; ?>
				    </select><span></span>
				</div>
		    </div>
		    <br>
		    <div>
			 <label>筛选属性</label>
				<div>
				<a href="javascript:void(0)" class="jia">[+]</a>
				<select  class="changesd">
					<option value="0">请选择</option>
						<?php if(is_array($goods_type) || $goods_type instanceof \think\Collection || $goods_type instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
				        <option value="<?php echo $v['type_id']; ?>"><?php echo $v['type_name']; ?></option>
				        <?php endforeach; endif; else: echo "" ;endif; ?>
				    </select><span></span>
				</div>
		    </div>
		    <br>
		      	<div class="layui-item">
			     <label class="layui-form-label">是否显示：</label>
			    <div class="layui-input-block userSex">
			      <input type="radio" name="is_show" value="0" title="是" checked>是
			      	<input type="radio" name="is_show" value="1" title="否">否
			    </div>
		    </div>
		    <br>
		    <div class="layui-item">
			     <label class="layui-form-label">是否显示在导航栏：</label>
			    <div class="layui-input-block userSex">
			    	<input type="radio" name="is_nav"  value="0" title="是" checked>是
			      	<input type="radio" name="is_nav"  value="1" title="否">否
			    </div>
		    </div>
		    <br>
		    <div class="layui-form-item">
			<label class="layui-form-label">排序</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input"  name="sort" id="sort" ><span></span>
			</div>
		</div>	
		<br>
		<div class="layui-form-item">
			<label class="layui-form-label">关键字</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input" placeholder="请输入分类搜索关键字" name="cat_keywords" id="cat_keywords"><span></span>
			</div>
		</div>	
		<br>
		<div class="layui-form-item">
			<label class="layui-form-label">分类LOGO</label>
			<div class="layui-input-block">
				<input type="file" class="layui-input" name="cat_logo" id="cat_logo" ><span></span>
			</div>
		</div>
		<br>
		<div class="layui-form-item">
			<label class="layui-form-label">分类描述</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea layui-hide" name="cat_desc" lay-verify="content" id="news_content"></textarea>
			</div>
		</div>
		<br>
		<div class="layui-form-item">
			<div class="layui-input-block">
			<button type="submit"  class="layui-btn" lay-filter="addNews" id="button">立即提交</button>
               <input type="reset" value="重置" class="layui-btn layui-btn-primary">
		    </div>
		</div>
	</form>
	
	<script  type="text/javascript" src="__ROOT__/jquery-1.8.2.min.js"></script>
	
</body>
<script type="text/javascript">
	/**
	*设置筛选属性下拉框的克隆
	*/
		 $('.jia').on('click',function(){
		 var div=$(this).parent().clone();
		 div.find(".jia").html("[-]");
		 div.find(".jia").attr('class','jian')
		 $(this).parent().after(div)
		 })
		 $(document).on('click',".jian",function(){
		 	$(this).parent().remove()
		 })
 /**
 *在类型下拉框下添加属性的下拉框
 */
	 $(document).on("change",".changesd",function(){
		var type_id=$(this).val();
		_this=$(this)
		//alert(cat_id)
		$.ajax({
			data:{type_id:type_id},
			type:"post",
			url:"__URL__/attrSelect",
			dataType:"json",
			success:function(e){
	         var select='<select class="change"  name="filter_attr[]">'
              select+='<option value="0">顶级分类选项</option>';
	         $.each(e,function(i,obj){
                select+='<option value="'+obj.attr_id+'">'+obj.attr_name+'</option>';
	         })
	         select+='</select>'
	         _this.next().remove()
             _this.after(select)
			}
		})
	}) 
	 /**
	 *添加关键字
	 */
	 $('#cat_keywords').on('click',function(){
	 	var cat_name=$('#cat_name').val();
	 	$('#cat_keywords').val(""+cat_name+"");
	 })
	 /**
	 *验证表单非空
	 */
	 $(document).on('click',"#button",function(){
	 	//验证分类名称
	 	var cat_name=$('#cat_name').val()
	 	if (cat_name=="") {
	 		$('#cat_name').next().html("<font color='red'>分类名称不能为空</font>")
	 		return false;
	 	}
	 	//验证顶级分类
	 	var userGrade=$('.userGrade').val()
	 	if (userGrade=="") {
	 		$('.userGrade').next().html("<font color='red'>请选择分类</font>")
	 		return false;
	 	}
	 	//验证筛选属性
	 	var changesd=$('.changesd').val()
	 	if (changesd==0) {	
	 		$('.changesd').next().html("<font color='red'>筛选属性不能为空</font>")
	 		return false;
	 	}
	 	//验证排序
	 	var sort=$('#sort').val()
	 	if (sort=="") {
	 		$('#sort').next().html("<font color='red'>排序不能为空</font>")
	 		return false;
	 	}
	 	//验证分类关键字
	 	var cat_keywords=$('#cat_keywords').val()
	 	if (cat_keywords=="") {
	 		$('#cat_keywords').next().html("<font color='red'>分类关键字不能为空</font>")
	 		return false;
	 	}
	 	//验证分类LOGO
	 	var cat_logo=$('input[name="cat_logo"]').val()
	 	if (cat_logo=="") {
	 		$('input[name="cat_logo"]').next().html("<font color='red'>分类LOGO不能为空</font>")
	 		return false;
	 	}
	 })

</script>
</script>
</html>