<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"E:\phpstudy\WWW\ppgongshe\public/../application/index\view\opinion\show.html";i:1529031330;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>意见列表--layui后台管理模板</title>
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
	
	<div class="layui-form links_list">
	  	<table class="layui-table">
		   
		    <thead>
				<tr>
					<th style="text-align:left;">意见标题</th>
					<th>意见内容</th>
					<th>意见人</th>
					<th>详细信息</th>
				</tr> 
		    </thead>
		    <tbody class="links_content">
		    	<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
		    		<tr>
		    			<td><?php echo $v['o_title']; ?></td>
		    			<td><?php echo $v['o_content']; ?></td>
		    			<td><?php echo $v['user_name']; ?></td>
		    			<td>
		    				<div class="layui-inline">
								
							</div>
							<a class="layui-btn layui-btn-danger" href="<?php echo url('opinion/details'); ?>?id=<?php echo $v['o_id']; ?>">查看图片</a>
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
			        页，每页 <input type="text" size="6" id="pageSize" value="6" onkeypress="return listTable.changePageSize(event)">
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
    /*
	分页
    */
    $(".show").click(function() {
        var total = parseInt($("#totalPages").html())
        
        var pageNow = parseInt($("#pageCurrent").html())
       
        var goods_id=$(".layui-input").val()
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
            data: {p: p},
            dataType:'json',
            success:function(e) {
            	
            	  $.each(e,function(i,obj){
                    
                    str+="<tr>",
                   
                    str+="<td>"+obj.o_title+"</td>",
                    str+="<td>"+obj.o_content+"</td>",
                    str+="<td>"+obj.user_name+"</td>",
                    str+="<td>",
                   
                    str+="<div class='layui-inline'>",
                     //alert(obj.l_status);
                    // if(statu == 0){

                    //   str+="<a class='layui-btn layui-btn-danger'>处理中</a>"

                    // }else if(statu == 1){

                    //    str+="<a class='layui-btn layui-btn-danger'>处理中</a>"

                    // }else{

                    // 	str+="<a class='layui-btn layui-btn-danger'>已完成</a>"

                    // },

                    str+="<a class='layui-btn layui-btn-danger' href='<?php echo url('opinion/details'); ?>?id="+obj.o_id+"'>查看</a>",
                    str+="</div>",
                   
                    str+="</td>",
                    str+="</tr>"
                });
                
               // alert(str);
                $(".links_content").html(str)
                
                $("#pageCurrent").html(p)
            	
            
                
            },

         
            
        })
    })
</script>



               