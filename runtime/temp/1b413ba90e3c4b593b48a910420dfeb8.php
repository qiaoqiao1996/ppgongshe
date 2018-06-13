<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"E:\web\WWW\shixun1\ppgongshe\ppgongshe\public/../application/index\view\type\typeList.html";i:1528541788;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>商品模型</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="__CSS__/font_eolqem241z66flxr.css" media="all" />
	<link rel="stylesheet" href="__CSS__/news.css" media="all" />
  
    <link href="__ROOT__/assets/css/bootstrap.css" rel="stylesheet" />


</head>
<body class="childrenBody">
	<blockquote class="layui-elem-quote news_search">
		<div class="layui-inline">
		    <div class="layui-input-inline">
		    	<input type="text" value="" placeholder="请输入关键字" class="layui-input search_input">
		    </div>
		    <a class="layui-btn search">查询</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-normal" href="<?php echo url('type/typeAdd'); ?>">添加模型</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-danger delAll">批量删除</a>
		</div>
		<div class="layui-inline">
			<div class="layui-form-mid layui-word-aux"></div>
		</div>
	</blockquote>
	<div class="layui-form news_list">
	  	<table class="layui-table">
	
		    <thead>
				<tr>
					<th><input type="checkbox" class="check"></th>
					<th>模型编号</th>
					<th>商品模型名称</th>
					<th>模型详情</th>
					<th>状态</th>
					<!-- <th>审核状态</th>
					<th>浏览权限</th>
					<th>是否展示</th>
					<th>发布时间</th> -->
					<th>操作</th>
				</tr> 
		    </thead>
		    <tbody class="news_content">

		    	 <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                   <tr>
                   	  <td><input type="checkbox" class="check" value="<?php echo $vo['type_id']; ?>"><div class="layui-unselect layui-form-checkbox" value="<?php echo $vo['type_id']; ?>" lay-skin=""><i class="layui-icon"></i></div></td>
                   	  </td>
                   	  <td><?php echo $vo['type_id']; ?></td>
                   	  <td><?php echo $vo['type_name']; ?></td>
                   	  <td><?php echo $vo['type_content']; ?></td>
                      <?php if($vo['enabled'] == 1): ?>
                         <td>以启用</td>
          						<?php else: ?> 
          						<td>未启用</td>
          						<?php endif; ?>
					  <td>
					  	<a style="color:blue" href="<?php echo url('Attribute/attrList'); ?>?type_id=<?php echo $vo['type_id']; ?>">属性列表</a>&nbsp;|
					  	<a style="color:blue" href="<?php echo url('Type/typeUpdate'); ?>?type_id=<?php echo $vo['type_id']; ?>">编辑</a>&nbsp;|
              <input type="hidden" id="type_id" value="<?php echo $vo['type_id']; ?>">
					  	<a style="color:blue" href="javascript:void(0)" class="dele">删除</a>
					  </td>	
                   </tr>
                 <?php endforeach; endif; else: echo "" ;endif; ?>
                 

		    </tbody>
		    <tr>
                 	<td colspan="6">
                 	
                  
              <ul class="pagination">
                   <b style="float: left;font-size: 16px">总计<span id="sum"><?php echo $sum; ?></span>条数据分为<span id="pagesum"><?php echo $pagesum; ?></span>页当前第<span id="pagenow">1</span>页</b>
              <li><a href="javascript:void(0)" class="page">首页</a></li>
							<li><a href="javascript:void(0)" class="page">上一页</a></li>
							<li><a href="javascript:void(0)" class="page">下一页</a></li>
							<li><a href="javascript:void(0)" class="page">尾页</a></li>
						</ul>
                 	</td>
                 </tr>
		</table>
	</div>
	<div id="page"></div>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/newsList.js"></script>
</body>
</html>


    


      <!-- Bootstrap Js -->
    <script src="__ROOT__/assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="__ROOT__/assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="__ROOT__/assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="__ROOT__/assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
        </script>
         <!-- Custom Js -->
    <script src="__ROOT__/assets/js/custom-scripts.js"></script>
<script src="__ROOT__/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
	$(function(){
           //多条数据删除
           $(".delAll").click(function(){
            // alert(2)
                var type_id=[];
                var search_input=$(".search_input").val();
                var pagenow=$("#pagenow").html();

                // $(".check").each(function(){
                //     if ($(this).is(":checked")) {
                //         type_id.push($(this).val());
                //       }
                // })
                
                // if (type_id.length==0) {
                   var che=$(".layui-form-checked")
                   che.each(function(){
                    // alert(123)
                       type_id.push($(this).prev().val());
                   })
                // }
                var type_id=type_id.toString();
                // alert(type_id);
                // return
                var boo=confirm("删除分类后 分类下的属性也会删除");
                if (boo) {
                     $.ajax({
                      url:"<?php echo url('Type/typeDele'); ?>",
                      type:"post",
                      data:{
                        "type_id":type_id,
                        "pagenow":pagenow,
                        "search_input":search_input
                      },
                      dataType:"json",
                      success:function(data){
                             if (data.status==1) {
                                alert("删除成功")
                                $(".news_content").html(join(data.contents));
                             }else{
                              alert("删除失败")
                             }
                      }
                     })
                }else{
                  return
                }
               
                
           })




           //单条数据删除
           $(document).on("click",".dele",function(){
            // alert(2)
           	     var type_id=$(this).prev().val();
                 var search_input=$(".search_input").val();
                 var pagenow=$("#pagenow").html();
                 // alert(type_id);
                 var boo=confirm("删除分类后 分类下的属性也会删除");
                 if (boo) {
                    $.ajax({
                      url:"<?php echo url('Type/typeDele'); ?>",
                      type:"post",
                      data:{
                        "type_id":type_id,
                        "pagenow":pagenow,
                        "search_input":search_input
                      },
                      dataType:"json",
                      success:function(data){
                             if (data.status==1) {
                                alert("删除成功")
                                $(".news_content").html(join(data.contents));
                             }else{
                              alert("删除失败")
                             }
                      }
                     })
                
           	    }
           	     // alert(type_id);
           })

           //分页功能实现
           $(".page").click(function(){
                var page=$(this).html();
                var pagesum=parseInt($("#pagesum").html());
                var pagenow=parseInt($("#pagenow").html());
                var search_input=$(".search_input").val();
                if (page=="首页") {
                   p=1
                }else if(page=="上一页"){
                   p=pagenow-1;
                }else if(page=="下一页"){
                   p=pagenow+1;
                }else{
                   p=pagesum;
                }
              if (p<1||p>pagesum) {
                   return false;
                }
                $.ajax({
                  type:"get",
                  url:"page",
                  data:{
                    "p":p,
                    "search_input":search_input
                  },
                  dataType:"json",
                  success:function(data){
                      if (data.status==1) {
                          $(".news_content").html(join(data.contents));
                          $("#sum").html(data.sum);
                          $("#pagenow").html(p);
                          $("#pagesum").html(data.pagesum);
                      }else{
                          $(".news_content").html("没有相关数据");
                          $("#sum").html(0);
                          $("#pagenow").html(1);
                          $("#pagesum").html(0);
                      }
                  }
                })

           })
                


           //搜索功能实现
           $(".search").click(function(){
           	     var search_input=$(".search_input").val();
           	     $.ajax({
           	     	url:"search",
           	     	type:"get",
           	     	data:{
           	     		"search_input":search_input
           	     	},
           	     	dataType:"json",
           	     	success:function(data){
           	     		if (data.status==1) {
           	     			$(".news_content").html(join(data.contents))
							        $("#sum").html(data.sum)
                      $("#pagesum").html(data.pagesum)
                      $("#pagenow").html(1);
           	     		}else{
           	     			$(".news_content").html("没有相关数据")
                      $("#sum").html(0);
                      $("#pagenow").html(1);
                      $("#pagesum").html(0);
           	     		}
                          
           	     	}
           	     })
           	    })
           


           function join(data) {
           	  var html='';

           	  $.each(data,function(k,v){
                html+= '<tr><td><input type="checkbox" class="check" value="'+v.type_id+'"><div class="layui-unselect layui-form-checkbox" value="'+v.type_id+'" lay-skin=""><i class="layui-icon"></i></div></td>';
                //alert(html);return;
                //console.log(html);return;
                  html+='<td>'+v.type_id+'</td><td>'+v.type_name+'</td><td>'+v.type_content+'</td>';
                  if (v.enabled==1) {
                  	html+='<td>以启用</td>'
                  }else{
                  	html+='<td>未启用</td>'
                  }
                  html+='<td><a style="color:blue" href="<?php echo url('Attribute/attrList'); ?>?type_id='+v.type_id+'">属性列表</a>&nbsp;|'
                  html+='<a style="color:blue" href="<?php echo url('Type/typeUpdate'); ?>?type_id='+v.type_id+'">编辑</a>&nbsp;|<input type="hidden" id="type_id" value="'+v.type_id+'"><a style="color:blue" href="javascript:void(0)" class="dele">删除</a></td></tr>';
           	  })
           	  return html;
           }

           $(document).on("click",".layui-unselect",function(){
                  if($(this).hasClass("layui-form-checked")){
                       // $(this).prev().prop("checked","checked")
                       $(this).removeClass("layui-form-checked")
                       
                  }else{
                       $(this).addClass("layui-form-checked");
                  }
           })
	})
</script>