<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:103:"E:\web\WWW\shixun1\ppgongshe\ppgongshe\public/../application/index\view\goodscategory\categoryShow.html";i:1527846392;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>文章列表--layui后台管理模板</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="__CSS__/font_eolqem241z66flxr.css" media="all" />
	<link rel="stylesheet" href="__CSS__/news.css" media="all" />
</head>
<body class="childrenBody">
	<blockquote class="layui-elem-quote news_search">
		<div class="layui-inline">
		    <div class="layui-input-inline">
		    	<input type="text" value="" placeholder="请输入关键字" class="layui-input search_input" id="keyword">
		    </div>
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-normal newsAdd_btn" href="<?php echo url('categoryAdd'); ?>">添加文章</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-danger batchDel" id="delAll">批量删除</a>
		</div>
		<div class="layui-inline">
			<div class="layui-form-mid layui-word-aux">本页面刷新后除新添加的文章外所有操作无效，关闭页面所有数据重置</div>
		</div>
	</blockquote>
	<div class="layui-form news_list">
	  	<table class="layui-table">
		    <colgroup>
				<col width="50">
				<col>
				<col width="9%">
				<col width="9%">
				<col width="9%">
				<col width="9%">
				<col width="9%">
				<col width="15%">
		    </colgroup>
		    <thead>
				<tr>
					<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>
					<th>ID</th>
					<th style="text-align:left;">分类名称</th>
					<th>分类描述</th>
					<th>排序</th>
					<th>上级分类</th>
					<th>筛选属性</th>
					<th>是否显示</th>
					<th>是否显示在导航栏</th>
					<th>关键字</th>
					<th>分类LOGO</th>
					<th>操作</th>
				</tr> 
		    </thead>
		    <tbody class="news_content">
		    	<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
		    	<tr cat_id="<?php echo $v['cat_id']; ?>">
		    		<td><input type="checkbox" class="check" lay-skin="primary" value="<?php echo $v['cat_id']; ?>"></td>
		    		<td><?php echo $v['cat_id']; ?></td>
		    		<td><?php echo $v['cat_name']; ?></td>
		    		<td><?php echo $v['cat_desc']; ?></td>
		    		<td><?php echo $v['sort']; ?></td>
		    		<td><?php echo $v['parent_id']; ?></td>
		    		<td><?php echo $v['filter_attr']; ?></td>
		    		<td class="changeShow"><?php if($v['is_show'] == 0): ?><font style="color:green;font-size:20px;" is_show=<?php echo $v['is_show']; ?> >√</font> <?php else: ?><font style="color:red;font-size:30px;" is_show=<?php echo $v['is_show']; ?>>×</font><?php endif; ?> </td>
		    		<td class="changeNav"><?php if($v['is_nav'] == 0): ?><font style="color:green;font-size:20px;" is_nav=<?php echo $v['is_nav']; ?>>√</font><?php else: ?><font style="color:red;font-size:30px;" is_nav=<?php echo $v['is_nav']; ?>>×</font><?php endif; ?></td>
		    		<td><?php echo $v['cat_keywords']; ?></td>
		    		<td><img src="../../../../uploads/<?php echo $v['cat_logo']; ?>" width="50" alt="" height="50"></td>
		    		<td><a href="javascript:void(0)" class="cateDel">删除</a></td>
		    	</tr>
		    	<?php endforeach; endif; else: echo "" ;endif; ?>
		    </tbody>
		</table>
			<tr>
			<td align="right">
				当前第<span id="pagenow">1</span>页 
				共<span id="pagetotal"><?php echo $total; ?></span>页
				<a href="javascript:void(0)" class="page">首页</a>
				<a href="javascript:void(0)" class="page">上一页</a>
				<a href="javascript:void(0)" class="page">下一页</a>
				<a href="javascript:void(0)" class="page">尾页</a>
				
			</td>
		</tr>
	</div>
	<div id="page"></div>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/newsList.js"></script>
</body>
<script src="__ROOT__/jquery-1.8.2.min.js"></script>
<script>
	/**
	*删除
	*/
	$(document).on('click','.cateDel',function(){
		var page=parseInt($('#pagenow').html());
		var cat_id=$(this).parent().parent().attr('cat_id')
		$.ajax({
			data:{page:page,cat_id:cat_id},
			url:"__URL__/cateDel",
			type:"post",
			dataType:"json",
			success:function(e){
			 $('.news_content').empty()
             $.each(e,function(i,obj){
              var  tr=$('<tr cat_id="'+obj.cat_id+'"></tr>');
              tr.append('<td><input type="checkbox" class="check" lay-skin="primary" value="'+obj.cat_id+'"></td>');
              tr.append('<td>'+obj.cat_id+'</td>');
              tr.append('<td>'+obj.cat_name+'</td>');
              tr.append('<td>'+obj.cat_desc+'</td>');
              tr.append('<td>'+obj.sort+'</td>');
              tr.append('<td>'+obj.parent_id+'</td>');
              tr.append('<td>'+obj.filter_attr+'</td>');
              if (obj.is_show==0) {
              	tr.append('<td class="changeShow"><font style="color:green;font-size:20px;" is_show="'+obj.is_show+'">√</font></td>')
              }else{
              	  tr.append('<td class="changeShow"><font style="color:red;font-size:30px;" is_show="'+obj.is_show+'" >×</font></td>')
              }
               if (obj.is_nav==0) {
              	tr.append('<td class="changeNav"><font style="color:green;font-size:20px;"  is_nav="'+obj.is_nav+'">√</font></td>')
              }else{
              	  tr.append('<td class="changeNav"><font style="color:red;font-size:30px;" is_nav="'+obj.is_nav+'" >×</font></td>')
              }
              tr.append('<td>'+obj.cat_keywords+'</td>');
              tr.append('<td><img src="../../../../uploads/'+obj.cat_logo+'" width="50" alt="" height="50"></td>');
              tr.append('<td><a href="javascript:void(0)" class="cateDel">删除</a></td>');
               $('.news_content').append(tr);
             })
              
			}
		})
	})
	/**
	*分页
	*/
	$('.page').on('click',function(){
   var page=parseInt($('#pagenow').html());
   var pagetotal=parseInt($('#pagetotal').html());
   	var keyword=$('#keyword').val();
   // alert($(this).html())
   if ($(this).html()=="首页") {
   	pagenow=1
   }
   if ($(this).html()=="上一页") {
   	pagenow=page-1
   }
   if ($(this).html()=="下一页") {
   	pagenow=page+1
   }
  if ($(this).html()=="尾页") {
  pagenow=pagetotal
  }
  if (pagenow <= 0 || pagenow > pagetotal) {
  	return false
  }
   $.ajax({
   	data:{pagenow:pagenow,keyword:keyword},
   	type:"post",
   	url:"__URL__/catPage",
   	dataType:"json",
   	success:function(e){
     $('.news_content').empty()
     $.each(e.data,function(i,obj){
      var  tr=$('<tr cat_id="'+obj.cat_id+'"></tr>');
              tr.append('<td><input type="checkbox" class="check" lay-skin="primary" value="'+obj.cat_id+'"></td>');
              tr.append('<td>'+obj.cat_id+'</td>');
              tr.append('<td>'+obj.cat_name+'</td>');
              tr.append('<td>'+obj.cat_desc+'</td>');
              tr.append('<td>'+obj.sort+'</td>');
              tr.append('<td>'+obj.parent_id+'</td>');
              tr.append('<td>'+obj.filter_attr+'</td>');
              if (obj.is_show==0) {
              	tr.append('<td class="changeShow"><font style="color:green;font-size:20px;" is_show="'+obj.is_show+'">√</font></td>')
              }else{
              	  tr.append('<td class="changeShow"><font style="color:red;font-size:30px;" is_show="'+obj.is_show+'">×</font></td>')
              }
               if (obj.is_nav==0) {
              	tr.append('<td class="changeNav"><font style="color:green;font-size:20px;" is_nav="'+obj.is_nav+'">√</font></td>')
              }else{
              	  tr.append('<td class="changeNav"><font style="color:red;font-size:30px;" is_nav="'+obj.is_nav+'">×</font></td>')
              }
              tr.append('<td>'+obj.cat_keywords+'</td>');
              tr.append('<td><img src="../../../../uploads/'+obj.cat_logo+'" width="50" alt="" height="50"></td>');
              tr.append('<td><a href="javascript:void(0)" class="cateDel">删除</a></td>');
               $('.news_content').append(tr);	
     })
     $('#pagenow').html(pagenow)
     $('#pagetotal').html(e.total)
   	}
   })

	})

	/**
	*修改是否显示的状态
	*/
	$(document).on('click',".changeShow",function(){
		var is_show=$(this).children().attr('is_show');
	    var cat_id=$(this).parent().attr('cat_id')
	    var  _this=$(this)
		$.ajax({
			data:{is_show:is_show,cat_id:cat_id},
			type:"post",
			url:"__URL__/changeIsshow",
			success:function(e){
             if (e==1) {
               if (is_show==0) {
               _this.children().attr('is_show',1)
                _this.children().html('×').css('color','red') 
               }else{
               	_this.children().attr('is_show',0)
                _this.children().html('√').css('color','green')
               }
             }
			}

		})
	})
	/**
	*修改是否显示在导航栏的状态
	*/
	$(document).on('click','.changeNav',function(){
		var is_nav=$(this).children().attr('is_nav');
	    var cat_id=$(this).parent().attr('cat_id')
	    var  _this=$(this)
		$.ajax({
			data:{is_nav:is_nav,cat_id:cat_id},
			type:"post",
			url:"__URL__/changeNav",
			success:function(e){
             if (e==1) {
               if (is_nav==0) {
               _this.children().attr('is_nav',1)
                _this.children().html('×').css('color','red') 
               }else{
               	_this.children().attr('is_nav',0)
                _this.children().html('√').css('color','green')
               }
             }
			}

		})
	})
	/**
	*批量删除
	*/
	$(document).on('click','.batchDel',function(){
		var cat_id=[];
		var page=parseInt($('#pagenow').html());
	    var keyword=$('#keyword').val();
	    $('.check').each(function(){
	    if ($(this).is(':checked')) {
           cat_id.push($(this).val());
	    }	
	    })
	    var cat_id=cat_id.toString();
	    if (cat_id=="") {
	    	alert('请选择')
	    	return false;
	    }
	    $.ajax({
	    	data:{cat_id:cat_id,page:page,keyword:keyword},
	    	url:"__URL__/delAll",
	    	type:"post",
	    	success:function(e){
      $('.news_content').empty()
     $.each(e.data,function(i,obj){
      var  tr=$('<tr cat_id="'+obj.cat_id+'"></tr>');
              tr.append('<td><input type="checkbox" class="check" lay-skin="primary" value="'+obj.cat_id+'"></td>');
              tr.append('<td>'+obj.cat_id+'</td>');
              tr.append('<td>'+obj.cat_name+'</td>');
              tr.append('<td>'+obj.cat_desc+'</td>');
              tr.append('<td>'+obj.sort+'</td>');
              tr.append('<td>'+obj.parent_id+'</td>');
              tr.append('<td>'+obj.filter_attr+'</td>');
              if (obj.is_show==0) {
              	tr.append('<td><font style="color:green;font-size:20px;" >√</font></td>')
              }else{
              	  tr.append('<font style="color:red;font-size:30px;" >×</font></td>')
              }
               if (obj.is_nav==0) {
              	tr.append('<td><font style="color:green;font-size:20px;" >√</font></td>')
              }else{
              	  tr.append('<font style="color:red;font-size:30px;" >×</font></td>')
              }
              tr.append('<td>'+obj.cat_keywords+'</td>');
              tr.append('<td><img src="../../../../uploads/'+obj.cat_logo+'" width="50" alt="" height="50"></td>');
              tr.append('<td><a href="javascript:void(0)" class="cateDel">删除</a></td>');
               $('.news_content').append(tr);	
     })
     $('#pagetotal').html(e.total)
   	}
   })
	    

	})
</script>
</html>