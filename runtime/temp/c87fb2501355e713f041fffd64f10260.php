<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\showtitle\titleShow.html";i:1527265112;}*/ ?>
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
			<a class="layui-btn layui-btn-normal newsAdd_btn" href="<?php echo url('titleAdd'); ?>">添加标题</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-danger batchDel">批量删除</a>
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
					<th style="text-align:left;">标题名称</th>
					<th>操作</th>
				</tr> 
		    </thead>
		    <tbody class="news_content">
		    	<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
		    	<tr title_id="<?php echo $v['title_id']; ?>">
		    		<td><input type="checkbox" name="" id=""></td>
		    		<td><?php echo $v['title_id']; ?></td>
		    		<td><span class="title_name"><?php echo $v['title_name']; ?></span></td>
		    		<td><a href="javascript:void(0)" class="delTitle">删除</a></td>
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
	$(document).on('click','.delTitle',function(){
		var page=parseInt($('#pagenow').html());
		var title_id=$(this).parent().parent().attr('title_id')
		$.ajax({
			data:{page:page,title_id:title_id},
			url:"__URL__/titleDel",
			type:"post",
			dataType:"json",
			success:function(e){
			 $('.news_content').empty()
             $.each(e,function(i,obj){
              var  tr=$('<tr title_id="'+obj.title_id+'"></tr>');
              tr.append('<td><input type="checkbox" name="" id=""></td>');
              tr.append('<td>'+obj.title_id+'</td>');
              tr.append('<td><span class="title_name">'+obj.title_name+'</span></td>');
              tr.append('<td><a href="javascript:void(0)" class="delTitle">删除</a></td>');
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
   	url:"__URL__/titlePage",
   	dataType:"json",
   	success:function(e){
     $('.news_content').empty()
     $.each(e.data,function(i,obj){
      var  tr=$('<tr title_id="'+obj.title_id+'"></tr>');
              tr.append('<td><input type="checkbox" name="" id=""></td>');
              tr.append('<td>'+obj.title_id+'</td>');
              tr.append('<td><span class="title_name">'+obj.title_name+'</span></td>');
              tr.append('<td><a href="javascript:void(0)" class="delTitle">删除</a></td>');
              $('.news_content').append(tr);	
     })
     $('#pagenow').html(pagenow)
     $('#pagetotal').html(e.total)
   	}
   })

	})
	/**
	*修改标题
	*/
	$(document).on('click','.title_name',function(){
		var title_name=$(this).html();
		$(this).parent().html('<span id="title_name"><input type="text" class="titlenames" value="'+title_name+'"></span>')
		 $('.titlenames').focus();
	})
	$(document).on('blur','.titlenames',function(){
            var new_title=$('.titlenames').val();
            var title_name=$('.title_name').html();
            var title_id=$(this).parent().parent().parent().attr('title_id')
            $.ajax({
            	data:{title_id:title_id,new_title:new_title},
            	type:"post",
            	url:"__URL__/changeTitle",
            	success:function(e){
                 if (e==1) {
                 	$('#title_name').parent().html('<span class="title_name">'+new_title+'</span>')
                 }else{
                 	$('#title_name').parent().html('<span class="title_name">'+title_name+'</span>')
                 }
            	}

	})
        })
	
</script>

</html>