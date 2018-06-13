<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"E:\web\WWW\shixun1\ppgongshe\ppgongshe\public/../application/index\view\attr\attr_add.html";i:1527900283;}*/ ?>
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
	<link rel="stylesheet" href="__JS__/vue.js" media="all" />
</head>
<body class="childrenBody">
	<form method="post" action="__URL__/attrAdd"  enctype="multipart/form-data">
			<input type="hidden" name="goods_id" value="<?php echo $goods_id; ?>">
			<div class="layui-form-item">
			<label class="layui-form-label">商品类型</label>
			<select class="layui-input search_input e" name="type_id">
		    		<option value="">请选择类型</option>
		    		<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
				        <option value="<?php echo $v['type_id']; ?>"><?php echo $v['type_name']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
		    	</select>
			</div>			
			<div class="layui-inline-e">		
					
			</div>
			
			<br>
			<br>
			<div class="layui-inline"  style="margin-left: 40px; ">
				<button class="layui-btn linksAdd_btn btn" type="submit" style="background-color:#5FB878" value='添加规格参数'>添加规格参数</button>
			</div>
		
		
		

	
	</form>
	
	
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<!-- <script type="text/javascript" src="__JS__/linksList.js"></script> -->
</body>
</html>
<script type="text/javascript" src="__JS__/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
	
	 //搜索
    $(document).on("change",".e",function(){
        var type_id=$(".e").val()
        $('.layui-inline-e').empty()
        var str=""
        $.ajax({
            type: "post",
            url: "__URL__/attrSele",
            data: {type_id:type_id},
            dataType:'json',
            success:function(e) {
           
            	$.each(e,function(i,obj){
                    if(obj.attr_type==1){
                    	str+="<div class='layui-form-item'>"
                    	
                    	str+="<label class='layui-form-label'>"+obj.attr_name+"</label><br>"
                    	str+="<div class='layui-input-block'>"
                        str+="<input type='text' name='attr_value[]' class='layui-input newsAuthor aa' lay-verify='required' style=''><input name='attr_price[]' type='hidden' class='layui-input newsAuthor' value='0' lay-verify='required'><input type='hidden' name='attr_img[]' value=''>"
                        str+="<input type='hidden' name='attr_id[]' value='"+obj.attr_id+"'>"
                        str+="</div>"
                         str+="</div><br>"
                    }else{
                    	str+="<div class='layui-form-item'>"
                    	str+="<label class='layui-form-label'><span class='add'>[+]</span>"+obj.attr_name+"</label><br>"
                        str+="<div class='layui-input-block'><input name='attr_value[]' type='text' class='layui-input newsAuthor aa' lay-verify='required'><label class='layui-form-label' style='margin-right:0px;'>属性价格</label><input name='attr_price[]' type='text' class='layui-input newsAuthor bb' lay-verify='required'>添加图片<input type='file' name='attr_img[]' class='file'><input type='hidden' name='attr_id[]' value='"+obj.attr_id+"'>"
                        str+="</div>"
                        str+="</div>"
                        
                        
                    }
                })
                $(".layui-inline-e").html(str)
            },
        })
 	})
 	$(document).on("click",".add",function(){
		if($(this).html()=="[+]")
		{
			$(this).html("[-]")
			var div=$(this).parent().parent().clone()
			$(this).html("[+]")
			$(this).parent().parent().parent().append(div)
		}
		else
		{
			$(this).parent().parent().remove()
		}
		
	})


 	$(document).on("click",".btn",function(){
 		var result = false;
 		var aa=$('.aa').each(function(){
 			if($(this).val()==''){
 				alert('请添加属性')
 				  
                return result;  
	 		}else{
	 			result=true;
	 		}
 		})
 		 if (result==false) {
 		 	return false; 
 		 } else{
 		 	
 		 	   var bb=$('.bb').each(function(){
		 			if($(this).val()==''){
		 				alert('请添加价格')
		 				  result=false
		                return result;  
			 		}else{
			 			result=true;
			 		}
		 		})
		 		 if (result==false) {
		 		 	return false; 
		 		 } else{
		 		 	var file=$('.file').each(function(){
		 			if($(this).val()==''){
		 				alert('请添加图片')
		 				  result=false
		                return result;  
				 		}else{
				 			result=true;
				 		}
			 		})
			 		 if (result==false) {
			 		 	return false; 
			 		 } else{
		 		 	
		 		 	} 
		 		 } 
 		 }

 		 

 	})



</script>
