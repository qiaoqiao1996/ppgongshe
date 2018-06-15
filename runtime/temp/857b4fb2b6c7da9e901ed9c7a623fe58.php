<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"E:\phpstudy\WWW\ppgongshe\public/../application/index\view\rebate\rebateAdd.html";i:1528978627;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>属性添加--layui后台管理模板</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="__CSS__/font_eolqem241z66flxr.css" media="all" />

 
    <script src="__ROOT__/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/vue.validator/2.1.6/vue-validator.min.js"></script>
</head>
<body class="childrenBody" id="validForm">
	
	 <table>
    <font size="3">    	（超级管理员）
     (<font color="red">
    0</font>级会员)返利率 <input style="color: red;width: 25px"  type="text" value='<?php echo $data['one']; ?>' name='rebate[]' id = 'id1' onblur='check_aa(1)' style="width:20px" class ='fl' >%
    <span id="s1"></span>
    </span>
    <input type="hidden" value='' name='rebate_id[]'>
    <input type="button" value="确定">
    </font></table>
   <br/>
    
    <table>
    <font size="3">		(会员)买家
	 (<font color="red">
    1</font>级会员)返利率 <input style="color: red;width: 25px"  type="text" value='<?php echo $data['two']; ?>' name='rebate[]' id = 'id2' onblur='check_aa(2)' style="width:20px" class ='fl' >%
    <span id="s2"></span>
    </span>
    <input type="hidden" value='' name='rebate_id[]'>
    <input type="button" value="确定">
    </font></table>
   <br/>
    
    <table>
    <font size="3">		(会员)买家
	 (<font color="red">
    2</font>级会员)返利率 <input style="color: red;width: 25px"  type="text" value='<?php echo $data['three']; ?>' name='rebate[]' id = 'id3' onblur='check_aa(3)' style="width:20px" class ='fl' >%
    <span id="s3"></span>
    </span>
    <input type="hidden" value='' name='rebate_id[]'>
    <input type="button" value="确定">
    </font></table>
   <br/>
    
    <table>
    <font size="3">		(会员)买家
	 (<font color="red">
    3</font>级会员)返利率 <input style="color: red;width: 25px"  type="text" value='<?php echo $data['four']; ?>' name='rebate[]' id = 'id4' onblur='check_aa(4)' style="width:20px" class ='fl' >%
    <span id="s4"></span>
    </span>
    <input type="hidden" value='' name='rebate_id[]'>
    <input type="button" value="确定">
    </font></table>
   <br/>
    
    <table>	
    <font size="3">		(会员)买家
	 (<font color="red">
    4</font>级会员)返利率 <input style="color: red;width: 25px"  type="text" value='<?php echo $data['five']; ?>' name='rebate[]' id = 'id5' onblur='check_aa(5)' style="width:20px" class ='fl' >%
    <span id="s5"></span>
    </span>
    <input type="hidden" value='' name='rebate_id[]'>
    <input type="button" value="确定">
    </font></table>
   <br/>
    
<!--     <table>
    <font size="3">		(商家)卖家
	(<font color="red">
    1</font>级会员)返利率 <input style="color: red;width: 25px"  type="text" value='4' name='rebate[]' id = 'id6' onblur='check_aa(6)' style="width:20px" class ='fl' >%
    <span id="s6"></span>
    </span>
    <input type="hidden" value='' name='rebate_id[]'>
    <input type="button" value="确定">
    </font></table>
   <br/>
    
    <table>
    <font size="3">		(商家)卖家
	(<font color="red">
    2</font>级会员)返利率 <input style="color: red;width: 25px"  type="text" value='3' name='rebate[]' id = 'id7' onblur='check_aa(7)' style="width:20px" class ='fl' >%
    <span id="s7"></span>
    </span>
    <input type="hidden" value='' name='rebate_id[]'>
    <input type="button" value="确定">
    </font></table>
   <br/>
    
    <table>
    <font size="3">		(商家)卖家
	(<font color="red">
    3</font>级会员)返利率 <input style="color: red;width: 25px"  type="text" value='2' name='rebate[]' id = 'id8' onblur='check_aa(8)' style="width:20px" class ='fl' >%
    <span id="s8"></span>
    </span>
    <input type="hidden" value='' name='rebate_id[]'>
    <input type="button" value="确定">
    </font></table>
   <br/>
    
    <table>
    <font size="3">		(商家)卖家
	(<font color="red">
    4</font>级会员)返利率 <input style="color: red;width: 25px"  type="text" value='1' name='rebate[]' id = 'id9' onblur='check_aa(9)' style="width:20px" class ='fl' >%
    <span id="s9"></span>
    </span>
    <input type="hidden" value='' name='rebate_id[]'>
    <input type="button" value="确定">
    </font></table> -->

	
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/attrAdd.js"></script>

</body>
</html>

<script type="text/javascript">
	 new Vue({
	 	el:"#validForm"
	 })

</script>
<script src="__ROOT__/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
		function check_aa(v){
		var val = $("#id"+v).val();
		//alert(val);
		var checkNum = /^[0-9]+$/;
		if(checkNum.test(val)){
		if(v == 1){  
			var he = $("#id2").val()*1+$("#id3").val()*1+$("#id4").val()*1+$("#id5").val()*1;
			
		}else if(v == 2){
			var he = $("#id1").val()*1+$("#id3").val()*1+$("#id4").val()*1+$("#id5").val()*1
		}else if(v == 3){
			var he = $("#id1").val()*1+$("#id2").val()*1+$("#id4").val()*1+$("#id5").val()*1
		}else if(v == 4){
			var he = $("#id1").val()*1+$("#id2").val()*1+$("#id3").val()*1+$("#id5").val()*1
		}else if(v ==5){
			var he = $("#id1").val()*1+$("#id2").val()*1+$("#id3").val()*1+$("#id4").val()*1
		}	
			if(he>100){
				$("#s"+v).html("<span style='color: red'>返利比例不正确</span>");
			}else{
				$("#s"+v).val();
				//alert(v);
				$.ajax({
					url:"<?php echo url('Rebate/rebateAdd'); ?>",
					data:{
						"rebate":val,
						"v":v
					},
					type:'post',
					dataType:"json",
					success:function(msg){
						if (msg.status==1) {
							$("#id"+v).val(val)
						}else{
							alert(msg.num)
							$("#id"+v).val(msg.um)

						}
						
					}
				})
			}
		}else{
			$("#s"+v).html("<span style='color: red'>必须是数字</span>");
		}
	}

</script>