<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\img\img_show.html";i:1527900344;}*/ ?>
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
		    	<select class="layui-input search_input">
		    		<option value="">请选择</option>
		    		<?php if(is_array($date) || $date instanceof \think\Collection || $date instanceof \think\Paginator): if( count($date)==0 ) : echo "" ;else: foreach($date as $key=>$v): ?>
				        <option value="<?php echo $v['goods_id']; ?>"><?php echo $v['goods_name']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
		    	</select>
		    </div>
		    <a class="layui-btn search_btn">查询</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn linksAdd_btn" style="background-color:#5FB878" href="__URL__/imgAdd">添加图片</a>
		</div>
		
	</blockquote>
	<div class="layui-form links_list">
	  	<table class="layui-table">
		   
		    <thead>
				<tr>
					<th style="text-align:left;">商品名称</th>
					<th>图片</th>
					<th>操作</th>
				</tr> 
		    </thead>
		    <tbody class="links_content">
		    	<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
		    		<tr>
		    			<td><?php echo $v['goods_name']; ?></td>
		    			<td><img src="../../../../uploads/<?php echo $v['img_path']; ?>" style="width: 60px;"></td>
		    			<td>
		    				<div class="layui-inline">
								<a class="layui-btn layui-btn-danger" href="<?php echo url('img/imgDel'); ?>?id=<?php echo $v['img_id']; ?>">删除</a>
							</div>
		    			</td>

		    		</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
		    </tbody>
		    <tr>
					<td align="right" nowrap="true" colspan="6">
			            <div id="turn-page">
						总计  <span id="totalRecords"></span>
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
	
	 //搜索
    $(document).on("change",".layui-input",function(){
        var goods_id=$(this).val()
        
        var str=""
       // alert(goods_id)

        $.ajax({
            type:"post",
            url:"__URL__/sea",
            data:{goods_id:goods_id},
            dataType:"json",
            success:function(e) {
            	// alert(e)
            	// return false
                $.each(e['data'],function(i,obj){
                    str+="<tr>",
                   
                    str+="<td>"+obj.goods_name+"</td>",
                    str+="<td><img src='../../../../uploads/"+obj.img_path+"' style='width: 60px;'></td>",
                    str+="<td>",
                 
                    str+="<div class='layui-inline'><a class='layui-btn layui-btn-danger' href='<?php echo url('img/imgDel'); ?>?id="+obj.img_id+"'>删除</a></div>"
                   
                    str+="</td>",
                    str+="</tr>";
                })
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
            data: {p: p,goods_id:goods_id},
            dataType:'json',
            success:function(e) {
            	
            	// return false
                $.each(e,function(i,obj){
                    str+="<tr>",
                   
                    str+="<td>"+obj.goods_name+"</td>",
                    str+="<td><img src='../../../../uploads/"+obj.img_path+"' style='width: 60px;'></td>",
                    str+="<td>",
                 
                    str+="<div class='layui-inline'><a class='layui-btn layui-btn-danger' href='<?php echo url('img/imgDel'); ?>?id="+obj.img_id+"'>删除</a></div>"
                   
                    str+="</td>",
                    str+="</tr>";
                })

                $(".links_content").html(str)
                
                $("#pageCurrent").html(p)
            
                
            },
            
        })
    })
</script>