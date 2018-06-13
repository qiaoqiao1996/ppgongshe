<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\attr\products_add.html";i:1528769916;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>添加库存--layui后台管理模板</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" />
	<style type="text/css">
		.layui-form-item .layui-inline{ width:33.333%; float:left; margin-right:0; }
		@media(max-width:1240px){
			.layui-form-item .layui-inline{ width:100%; float:none; }
		}
    select{

    background-color: #ffffff;
    background-image: none !important;
    filter: none !important;
    border: 1px solid #e5e5e5;
    outline: none;
    height: 30px !important;
    line-height: 25px;
}

	</style>
</head>
<body class="childrenBody">
	<form action="__URL__/products" method="post"> 
    <div>
      <table width="100%" cellpadding="3" cellspacing="1" id="table_list">
    <tbody>
    <tr style="height: 40px;">
      <!-- start for specifications -->
     <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$value): ?>
         <td scope="col" style="background-color: rgb(255, 255, 255);width: 400px">
             <div>
                 <strong>
                     <?php echo $value['attr_name']; ?>
                 </strong>
             </div></td>
     <?php endforeach; endif; else: echo "" ;endif; ?>


        <input type="hidden" name="goods_id" value="<?php echo $goods_id; ?>"/>
     
       <!-- end for specifications -->
     
      <td class="label_2" style="background-color: rgb(255, 255, 255);">库存</td>
      <td class="label_2" style="background-color: rgb(255, 255, 255);">&nbsp;</td>
    </tr>

     
    <tr id="attr_row">
    <!-- start for specifications_value -->
    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$val): ?>


            <td>
              <select name="attr_value[<?php echo $key; ?>][]" style="width: 200px;">
            
            <?php if(is_array($val['value']) || $val['value'] instanceof \think\Collection || $val['value'] instanceof \think\Paginator): if( count($val['value'])==0 ) : echo "" ;else: foreach($val['value'] as $key=>$vo): ?>
                <option value="<?php echo $key; ?>"><?php echo $vo; ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>

            </td>

    <?php endforeach; endif; else: echo "" ;endif; ?>




      
      <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_number[]" value="1" size="10" style="width: 200px;height: 25px;"></td>
      <td style="background-color: rgb(255, 255, 255);"><input type="button" class="button jia" value=" + " style="width: 25px;height: 25px;"></td>
    </tr>

    <tr>
      <td align="center" colspan="5" style="background-color: rgb(255, 255, 255);">
        <input type="submit" class="button" value=" 保存 ">
      </td>
    </tr>
  </tbody>
  </div>
  </table>
  </div>
  </form>
	
	<div id="page"></div>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/linksList.js"></script>
</body>
</html>
<script src="__JS__/jquery-1.8.2.min.js"></script>
<script language=javascript>
    $(function(){
        $(document).on('click','.jia',function(){
            var curl = $(this).parent().parent().clone();
            $(this).parent().parent().after(curl);
            var length = $(this).parent().parent().index();
            $('tr').eq(length+1).find('input[type=button]').val(' - ');
            $('tr').eq(length+1).find('input[type=button]').attr('class','button jian');
        //alert(aa);
        });
        $(document).on('click','.jian',function(){
            $(this).parent().parent().remove();
        });

        $(document).on('click','.layui-input',function(){
        	$(this).parent().parent().addClass('layui-form-selected')
        	$(this).parent().next().children('dd').addClass('dd')
        })

        $(document).on('click','.dd',function(){
          
          $(this).siblings().removeClass('layui-this')
          $(this).addClass('layui-this')
          var html=$(this).html()
          $('.layui-input').removeClass('aa')
          $(this).parent().prev().children('input').addClass('aa')
          $('.aa').val(html)


        })




    });
</script>