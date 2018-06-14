<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\buurt\comm_type_show.html";i:1528977680;}*/ ?>
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
		    	<input type="text" value="" placeholder="请输入关键字" class="layui-input search_input">
		    </div>
		    <a class="layui-btn search_btn">查询</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-normal newsAdd_btn">添加文章</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn recommend" style="background-color:#5FB878">推荐文章</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn audit_btn">审核文章</a>
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
					<th>编号</th>
					<th>分类名称</th>
					<th>分类LOGO</th>
					<th>操作</th>
				</tr> 
		    </thead>
		    <tbody class="news_content">
	    	<?php foreach($list as $k=>$v){ ?>
    			<tr>
					<th><?php echo $v['comm_id']?></th>
					<th value='<?php echo $v['comm_id']?>'><span class="name"><?php echo $v['comm_name']?></span></th>
					<th><img style="width: 80px;height: 80px" src="../../../../uploads/<?php echo $v['comm_logo']?>"></th>
					<th><a class="layui-btn" href="comm_type_del?id=<?php echo $v['comm_id']?>">删除</a></th>
				</tr> 
			<?php }?>
		    </tbody>
		</table>
	</div>

<?php echo $list->render(); ?>

	<div id="page"></div>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/newsList.js"></script>
</body>
</html>
<script src="__JS__/jquery-1.8.2.min.js"></script>
<script>
	$(document).on('click','.name',function(){
		old_val = $(this).html();
		$(this).parent().html("<input type='text' value='"+old_val+"'>");
		$(document).on('blur','input',function(){
			var obj = $(this);//定义一个$(this)
			var id = $(this).parent().attr('value');
			var val = $(this).val();
			$.ajax({
				type:'post',
				url:'update_type',
				data:{id:id,val:val},
				success:function(msg){
					if (msg==1) 
					{
						obj.parent().html("<span class='name'>"+val+"</span>")
					}else{      
                    obj.parent().html("<span class='name'>"+old_val+"</span>")      
                }   
				}
			})
		})
	})
</script>
