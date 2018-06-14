<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\rebate\rebateShow.html";i:1528871822;}*/ ?>
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

  <link href="__ROOT__/assets/css/bootstrap.css" rel="stylesheet" />
</head>
<body class="childrenBody">
        
      
        <div class="layui-form news_list">
      <table class="layui-table">

        <thead>
        <tr>


          <th>返利用户</th>
          <th>返利类型</th>
          <th>返利金额</th>
          <th>所属返利等级</th>
          <th>返利比例</th>
          <th>返利时间</th>
        </tr> 
        </thead>
        <tbody class="news_content">
          <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
               <tr>
                <td><?php echo $vo['rebate_user']; ?></td>
                <?php if($vo['rebate_type'] == 1): ?>
                    <td>卖家</td>
                <?php else: ?> 
                    <td>买家</td>
                <?php endif; ?>
                <td><?php echo $vo['rebate_money']; ?></td>
            <td>
              <?php echo $vo['rebate_level']; ?>
            </td>
            <td>
              <?php echo $vo['rebate_pro']; ?>
            </td>
            <td>
              <?php echo $vo['rebate_time']; ?>
            </td>
               </tr>
                    
                
                        <?php endforeach; endif; else: echo "" ;endif; ?>

        </tbody>
        <tr>
          
                  <td colspan="7">
                  
                  
      
                  </td>
                 </tr>
    </table>
  </div>  

  
  
  <script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
  <!-- <script type="text/javascript" src="__JS__/linksList.js"></script> -->
</body>
</html>
<script src="__ROOT__/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
  $(function(){
          $(".search_input").change(function(){
              var type_id=$(this).find("option:selected").val();
              $.ajax({
                  url:"<?php echo url('Attribute/search'); ?>",
                  type:"post",
                  data:{
                    "type_id":type_id
                  },
                  dataType:"json",
                  success:function(data){
                    if (data.status==1) {
                        $(".news_content").html(join(data.contents));
                        $("#sum").html(data.sum)
                        $("#pagesum").html(data.pagesum)
                        $("#pagenow").html(1)
                    }else{
                        $(".news_content").html("暂时无数据");
                        $("#sum").html(0)
                        $("#pagesum").html(1)
                        $("#pagenow").html(0)
                    }
                  }

          })
        })
          //多条数据删除
           $(".delAll").click(function(){
                var attr_id=[];
                var type_id=$(".search_input").find("option:selected").val();
                var pagenow=$("#pagenow").html(); 

                var che=$(".layui-form-checked")
                   che.each(function(){
                    // alert(123)
                       attr_id.push($(this).prev().val());
                   })
                // }
                var attr_id=attr_id.toString();
             
                // if (type_id.length==0) {
                //    var che=$(".layui-form-checked")
                //    che.each(function(){
                //        type_id.push($(this).prev().val());
                //    })
                // }
                // var attr_id=attr_id.toString();
                // alert(type_id);
                $.ajax({
                  url:"<?php echo url('Attribute/attrDele'); ?>",
                  type:"post",
                  data:{
                    "type_id":type_id,
                    "pagenow":pagenow,
                    "attr_id":attr_id
                  },
                  dataType:"json",
                  success:function(data){
                         if (data.status==1) {
                            alert("删除成功")
                            $(".news_content").html(join(data.contents));
                            $("#sum").html(data.sum)
                            $("#pagesum").html(data.pagesum)
           
                         }else{
                          alert("删除失败")
                         }
                  }
                 })
                
           })




           //单条数据删除
           $(document).on("click",".dele",function(){
                 var attr_id=$(this).prev().val();
                 var type_id=$(".search_input").find("option:selected").val();
                 var pagenow=$("#pagenow").html();
                 // alert(attr_id);
                 $.ajax({
                  url:"<?php echo url('Attribute/attrDele'); ?>",
                  type:"post",
                  data:{
                    "attr_id":attr_id,
                    "pagenow":pagenow,
                    "type_id":type_id
                  },
                  dataType:"json",
                  success:function(data){
                         if (data.status==1) {
                            alert("删除成功")
                            $(".news_content").html(join(data.contents));
                            $("#sum").html(data.sum)
                            $("#pagesum").html(data.pagesum)
           
                         }else{
                          alert("删除失败")
                         }
                  }
                 })
                 // alert(type_id);
           })

           //分页功能实现
           $(".page").click(function(){
                var page=$(this).html();
                var pagesum=parseInt($("#pagesum").html());
                var pagenow=parseInt($("#pagenow").html());
                var type_id=$(".layui-input option:selected").val();
                // alert(type_id)
                // p=1;
                // var search_input=$(".search_input").val();
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
                    "type_id":type_id
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
                      $("#pagesum").html(data.num)
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
                html+= '<tr><td><input type="checkbox" name="" lay-skin="primary" value="'+v.attr_id+'" lay-filter="allChoose" id="allChoose"><div class="layui-unselect layui-form-checkbox"  lay-skin=""><i class="layui-icon"></i></div></td><td>'+v.attr_id+'</td><td>'+v.attr_name+'</td><td>'+v.type_name+'</td>';
                  if (v.attr_input_type==1) {
                    html+='<td>手工录入</td>'
                  }else{
                    html+='<td>未启用</td>'
                  }
                  html+='<td>'+v.attr_values+'</td>'
                  html+='<td><a style="color:blue" href="<?php echo url('Attribute/attrUpdate'); ?>?attr_id='+v.attr_id+'">编辑</a>&nbsp;|<input type="hidden" id="type_id" value="'+v.attr_id+'"><a style="color:blue" href="javascript:void(0)" class="dele">删除</a></td></tr>';
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
