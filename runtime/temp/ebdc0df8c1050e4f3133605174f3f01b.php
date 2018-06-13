<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\comm\community_show.html";i:1527248036;}*/ ?>
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
			<a class="layui-btn" href="<?php echo url('comm/community'); ?>" style="background-color:#5FB878">添加链接</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-danger" name="box[]" id="all">批量删除</a>
		</div>
		<div class="layui-inline">
			<div class="layui-form-mid layui-word-aux">本页面刷新后除新添加的链接外所有操作无效，关闭页面所有数据重置</div>
		</div>
	</blockquote>
	<div class="layui-form links_list">
	  	<table class="layui-table">
		    <colgroup>
				<!-- <col width="50"> -->
				<!-- <col width="30%"> -->
				<col>
				<col>
				<col>
				<col>
				<col>
				<col width="12%">
		    </colgroup>
		    <thead>
				<tr>
					<th><input type="checkbox"  lay-skin="primary"  id="quan"></th>
					<!-- <th style="text-align:left;">网站名称</th> -->
					<th>小区名称</th>
					<th>小区类型</th>
					<th>小区注册时间</th>
					<th>小区位置</th>
					<th>操作</th>
				</tr> 
		    </thead>
		    <tbody id="tbody">
		    <?php foreach($data as  $k=>$v): ?>
		    <tr>
		    	<td><input type="checkbox"  value="<?php echo $v['com_id']; ?>" lay-skin="primary"   id="allChoose"></td>
		    	<td><?php echo $v['com_name']; ?></td>
		    	<td><?php echo $v['comm_name']; ?></td>
		    	<td><?php echo $v['com_time']; ?></td>
		    	<td><?php echo $v['com_adress']; ?></td>
		    	<td><a href="javascript::" class="layui-btn layui-btn-danger" id="del" name="<?php echo $v['com_id']; ?>">删除</a>
		    		<a href="javascript::" class="layui-btn" id="up" name="<?php echo $v['com_id']; ?>">修改</a></td>
		    </tr>
		    <?php endforeach; ?>
		</tbody>

		</table>
	</div>
	<!-- <div id="page">{page}</div> -->
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/linksList.js"></script>
</body>
<script type="text/javascript" src="__ROOT__/jquery-1.8.3.js"></script>
<script type="text/javascript">
	$(document).on('click','#del',function(){
		var id =$(this).attr('name');
        $.ajax({
        	url:"<?php echo url('comm/del'); ?>",
        	data:{id:id},
        	type:'get',
        	dataType:'json',
        	success:function(r){
        		if (r.ms==1) 
        		{
                  // $('tbody').each(function(k,r.data){
                  // 		$(this).push(r.data);
                  // });
                   $('#tbody').empty().append(r.data);
        		}
        	}
        })
	})

	$(document).on('click','#all',function(){
		 var check=$("input[type='checkbox']:checked").length;
		 if (check==0) 
		 {
		 	alert('请至少选一项')
		 	return
		 }
         if(confirm("确定要删除所选项目？")) {
		var hh =$("index[type='checkbox']:checked");
        var id= [];
       $("[id='allChoose']:checked").append(function(){
       	   id.push($(this).val());
       })
         // alert(id)
		$.ajax({
        	url:"<?php echo url('comm/del'); ?>",
        	data:{id:id},
        	type:'get',
        	dataType:'json',
        	success:function(r){
        		if (r.ms==1) 
        		{
                   $('#tbody').empty().html(r.data);
        		}
        	}
        })
    }
	})
	//全选
	 // $(document).on("click",'#quan',function(){   
	 // alert(1111)        
      // $("[id='allChoose']").prop("checked",this.checked);
        
     // }); 
</script>
</html>