<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"E:\phpstudy\WWW\ppgongshe\public/../application/index\view\repair\show.html";i:1529027318;}*/ ?>
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
			 <a class="layui-btn search_btn">查询</a>
		    <div class="layui-input-inline">
		    	<select class="layui-input search_input" id="o">
		    		<option value="">请选择</option>
		    		<option value="1">已处理</option>
		    		<option value="2">未处理</option>
		    	</select>
		    </div>
		     <div class="layui-input-inline">
		    	<select class="layui-input search_input" id="t">
		    		<option value="">请选择</option>
		    		<?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): if( count($type)==0 ) : echo "" ;else: foreach($type as $key=>$v): ?>
		    		<option value="<?php echo $v['t_id']; ?>"><?php echo $v['t_name']; ?></option>
		    		<?php endforeach; endif; else: echo "" ;endif; ?>
		    	</select>
		    </div>
		   
		</div>
		
		
	</blockquote>
	<div class="layui-form links_list">
	  	<table class="layui-table">
		   
		    <thead>
				<tr>
					<th style="text-align:left;">报修订单</th>
					<th>报修类型</th>
					<th>报修时间</th>
					<th>报修用户</th>
					<th>详细信息</th>
				</tr> 
		    </thead>
		    <tbody class="links_content">
		    	<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
		    		<tr>
		    			<td><?php echo $v['l_numbers']; ?></td>
		    			<td><?php echo $v['t_name']; ?></td>
		    			<td><?php echo $v['l_time']; ?></td>
		    			<td><?php echo $v['l_name']; ?></td>
		    			<td>
		    				<div class="layui-inline">
								
							</div>
                             
							<?php if(($v['l_status'] == 0) OR ($v['l_status'] == 1)): ?>
							 <a class="layui-btn layui-btn-danger">未处理</a>
							<?php else: ?>
                             <a class="layui-btn layui-btn-danger">已处理</a>
							<?php endif; ?>
							<a class="layui-btn layui-btn-danger" href="<?php echo url('repair/xqlist'); ?>?id=<?php echo $v['l_id']; ?>">查看</a>
		    			</td>
		    		</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
		    </tbody>
		     <tr>
					<td align="right" nowrap="true" colspan="6">
			            <div id="turn-page">
						总计  <span id="totalRecords"><?php echo $count; ?></span>
			        个记录分为 <span id="totalPages"><?php echo $total; ?></span>
			        页当前第 <span id="pageCurrent">1</span>
			        页，每页 <span id="size">6</span>
			        <span id="page-link">
			          <a href="javascript:void(0)" class="show">第一页</a>
			          <a href="javascript:void(0)" class="show">上一页</a>
			          <a href="javascript:void(0)" class="show">下一页</a>
			          <a href="javascript:void(0)" class="show">最末页</a>
			        </span>
			      </div>
			      </td>
			    </tr>
		</table>
	</div>
	<div id="page"></div>
<!-- 	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/linksList.js"></script> -->
</body>
</html>
<script type="text/javascript" src="__JS__/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
	
	 //搜索
    $(document).on("change","#o",function(){
        var statu=$(this).val();
        var t_id = $("#t").val();
        
        var str=""
       // alert(goods_id)

        $.ajax({
            type:"post",
            url:"__URL__/sea",
            data:{statu:statu,t_id:t_id},
            dataType:"json",
            success:function(e) {
            	// alert(e)
            	// return false
                 $.each(e['data'],function(i,obj){
            	  	//alert(obj.l_numbers);
            	  
                    str+="<tr>";
                   
                    str+="<td>"+obj.l_numbers+"</td>";
                    str+="<td>"+obj.t_name+"</td>";
                    str+="<td>"+obj.l_time+"</td>";
                    str+="<td>"+obj.l_name+"</td>";
                    str+="<td>";
                   
                    str+="<div class='layui-inline'>";
                     //alert(obj.l_status);
                    if(obj.l_status == 0){

                      str+="<a class='layui-btn layui-btn-danger'>处理中</a>";

                    }else if(obj.l_status == 1){

                       str+="<a class='layui-btn layui-btn-danger'>已催单</a>";

                    }else{

                    	str+="<a class='layui-btn layui-btn-danger'>已处理</a>";

                    };

                    str+="<a class='layui-btn layui-btn-danger' href='<?php echo url('repair/xqlist'); ?>?id="+obj.l_id+"'>查看</a>";
                    str+="</div>";
                   
                    str+="</td>";
                    str+="</tr>";
                });
                $("#totalRecords").html(e.count);
                $("#totalPages").html(e.total)
                $(".links_content").html(str)
                $("#pageCurrent").html(1)
            }
         })
    })
    
     //搜索
    $(document).on("change","#t",function(){
        var t_id=$(this).val()
        var statu = $("#o").val();
       
        var str=""
       // alert(goods_id)

        $.ajax({
            type:"post",
            url:"__URL__/sea",
            data:{t_id:t_id,statu:statu},
            dataType:"json",
            success:function(e) {
            	// alert(e)
            	// return false
                 $.each(e['data'],function(i,obj){
            	  	//alert(obj.l_numbers);
            	  	
                    str+="<tr>";
                   
                    str+="<td>"+obj.l_numbers+"</td>";
                    str+="<td>"+obj.t_name+"</td>";
                    str+="<td>"+obj.l_time+"</td>";
                    str+="<td>"+obj.l_name+"</td>";
                    str+="<td>";
                   
                    str+="<div class='layui-inline'>";
                     //alert(obj.l_status);
                    if(obj.l_status == 0){

                      str+="<a class='layui-btn layui-btn-danger'>处理中</a>"

                    }else if(obj.l_status == 1){

                       str+="<a class='layui-btn layui-btn-danger'>已催单</a>"

                    }else{

                    	str+="<a class='layui-btn layui-btn-danger'>已处理</a>"

                    };

                    str+="<a class='layui-btn layui-btn-danger' href='<?php echo url('repair/xqlist'); ?>?id="+obj.l_id+"'>查看</a>";
                    str+="</div>";
                   
                    str+="</td>";
                    str+="</tr>";
                });
                $("#totalRecords").html(e.count);
                $("#totalPages").html(e.total)
                $(".links_content").html(str)
                $("#pageCurrent").html(1)
            }
         })
    })
    
    /*
	分页
    */
    $(".show").click(function() {
        var total = parseInt($("#totalPages").html())
        
        var pageNow = parseInt($("#pageCurrent").html())
       
        var statu=$("#o").val();
        var t_id = $("#t").val();
       
        var str=""
        if ($(this).html() == "第一页") {
            p = 1
        } else if ($(this).html() == "上一页") {
            p = pageNow - 1
        } else if ($(this).html() == "下一页") {
            p = pageNow + 1
        } else {
            p = total
        }
        if (p < 0 || p > total) {
            return false
        }
        
        $.ajax({
            type: "post",
            url: "__URL__/page",
            data: {p: p,statu:statu,t_id:t_id},
            dataType:'json',
            success:function(e) {
            	
            	  $.each(e,function(i,obj){
            	  	//alert(obj.l_numbers);
            	  	var statu = obj.l_status;
                    str+="<tr>";
                   
                    str+="<td>"+obj.l_numbers+"</td>";
                    str+="<td>"+obj.t_name+"</td>";
                    str+="<td>"+obj.l_time+"</td>";
                    str+="<td>"+obj.l_name+"</td>";
                    str+="<td>";
                   
                    str+="<div class='layui-inline'>";
                     //alert();
                    if(obj.l_status == 0){

                      str+="<a class='layui-btn layui-btn-danger'>处理中</a>";

                    }else if(obj.l_status == 1){

                       str+="<a class='layui-btn layui-btn-danger'>已催单</a>";

                    }else{

                    	str+="<a class='layui-btn layui-btn-danger'>已处理</a>";

                    };

                    str+="<a class='layui-btn layui-btn-danger' href='<?php echo url('repair/xqlist'); ?>?id="+obj.l_id+"'>查看</a>";
                    str+="</div>";
                   
                    str+="</td>";
                    str+="</tr>";
                });
                
               // alert(str);
                $(".links_content").html(str)
                
                $("#pageCurrent").html(p)
            	
            
                
            },

         
            
        })
    })
</script>



               