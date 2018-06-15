<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"E:\phpstudy\WWW\ppgongshe\public/../application/index\view\goods\goods_show.html";i:1528978627;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>商品列表--layui后台管理模板</title>
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
		    	<input type="text" value="" placeholder="请输入关键字" class="layui-input search_input goods_name">
		    </div>
		    <button class="layui-btn search_btn button">查询</button>
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-normal newsAdd_btn" href="__URL__/goodsAdd">添加新商品</a>
		</div>
		
		
		<div class="layui-inline">
			<div class="layui-form-mid layui-word-aux">本页面刷新后除新添加的商品外所有操作无效，关闭页面所有数据重置</div>
		</div>
	</blockquote>
	<div class="layui-form news_list">
	  	<table class="layui-table">
		   
		    <thead>
				<tr>
					
					<th style="text-align:left;">商品名称</th>
					<th>商品货号</th>
					<th>商品数量</th>
					<th>本店出售价格</th>
					<th>操作</th>
				</tr> 
		    </thead>
		    <tbody class="news_content">
		    	<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
		    		<tr>
		    			
		    			<td><?php echo $v['goods_name']; ?></td>
		    			<td><?php echo $v['goods_sn']; ?></td>
		    			<td><?php echo $v['goods_number']; ?></td>
		    			<td><?php echo $v['shop_price']; ?></td>
		    			<td>
		    				<div class="layui-inline">
								<a class="layui-btn layui-btn-danger" href="<?php echo url('goods/goodsDel'); ?>?id=<?php echo $v['goods_id']; ?>">删除</a>
							</div>
							<div class="layui-inline">
								<a class="layui-btn layui-btn-danger" href="<?php echo url('attr/attrAdd'); ?>?id=<?php echo $v['type_id']; ?>&&goods_id=<?php echo $v['goods_id']; ?>">添加属性</a>
							</div>
		    			</td>
		    		</tr>
		    	<?php endforeach; endif; else: echo "" ;endif; ?>
		    	
		    </tbody>
		    <tr>
					<td align="right" nowrap="true" colspan="6">
			            <div id="turn-page">
						总计  
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
	<script type="text/javascript" src="__JS__/newsList.js"></script> -->
</body>
</html>

<script type="text/javascript" src="__JS__/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
	
	 //搜索
    $(document).on("click",".button",function(){
        var goods_name=$(".goods_name").val()
        
        var str=""
        var _this=$(this)

        $.ajax({
            type:"post",
            url:"__URL__/sea",
            data:{goods_name:goods_name},
            dataType:"json",
            success:function(e) {
            	
            	// return false
                $.each(e['data'],function(i,obj){
                    str+="<tr>",
                   
                    str+="<td>"+obj.goods_name+"</td>",
                    str+="<td>"+obj.goods_sn+"</td>",
                    str+="<td>"+obj.goods_number+"</td>",
                    str+="<td>"+obj.shop_price+"</td>",
                    str+="<td>",
                 
                    str+="<div class='layui-inline'><a class='layui-btn layui-btn-danger' href='<?php echo url('goods/goodsDel'); ?>?id="+obj.goods_id+"'>删除</a></div>"
                     str+="<div class='layui-inline'><a class='layui-btn layui-btn-danger' href='<?php echo url('attr/attrAdd'); ?>?id="+obj.type_id+"&&goods_id="+obj.goods_id+"'>添加属性</a></div>"
                   
                    str+="</td>",
                    str+="</tr>";
                })
                $("#totalPages").html(e.total)
                $(".news_content").html(str)
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
        var goods_name=$(".goods_name").val()
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
            data: {p: p,goods_name:goods_name},
            dataType:'json',
            success:function(e) {
            	
            	// return false
                $.each(e,function(i,obj){
                    str+="<tr>",
                   
                    str+="<td>"+obj.goods_name+"</td>",
                    str+="<td>"+obj.goods_sn+"</td>",
                    str+="<td>"+obj.goods_number+"</td>",
                    str+="<td>"+obj.shop_price+"</td>",
                    str+="<td>",
                 
                    str+="<div class='layui-inline'><a class='layui-btn layui-btn-danger' href='<?php echo url('goods/goodsDel'); ?>?id="+obj.goods_id+"'>删除</a></div>"
                    str+="<div class='layui-inline'><a class='layui-btn layui-btn-danger' href='<?php echo url('attr/attrAdd'); ?>?id="+obj.type_id+"&&goods_id="+obj.goods_id+"'>添加属性</a></div>"
                   
                    str+="</td>",
                    str+="</tr>";
                })
                $("#totalPages").html(e.total)
                $(".news_content").html(str)
                
                $("#pageCurrent").html(p)
            
                
            },
            
        })
    })
</script>