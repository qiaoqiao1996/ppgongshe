<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\comm\community.html";i:1528511416;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>会员添加--layui后台管理模板</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
    <link rel="icon" href="favicon.ico">
	<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="__CSS__/font_eolqem241z66flxr.css" media="all" />
	<link rel="stylesheet" href="__CSS__/main.css" media="all" />

	<!--调百度地图-->
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
	#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
	</style>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=kyahB77oe42mCFBvvy209xW8RPMtzYvO"></script> 
    </style> 
	<!---->
</head>
<body class="childrenBody">
	<form class="layui-form" style="width:50%;" accept="<?php echo url('comm/community'); ?>" method="post">

		<div class="layui-form-item">

			<label class="layui-form-label">小区登录名</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input userName"  lay-verify="name" placeholder="请输入登录名" name="com_name" id="name">
			</div>
		</div>
		
		
		    <div class="layui-form-item">
			    <label class="layui-form-label">经度</label>
				<div class="layui-input-block">
					<input type="text" class="layui-input userName" lay-verify="xy" placeholder="请点击显示地图获取" name="com_x" id="lng" >
				</div>
				<label class="layui-form-label">纬度</label>
				<div class="layui-input-block">
					<input type="text" class="layui-input userName" lay-verify="xy" placeholder="请点击地图获取" name="com_y" id="lat" >
				</div>
				<label class="layui-form-label">地址</label>
				<div class="layui-input-block">
					<input type="text" class="layui-input userName" lay-verify="zw" placeholder="请输入地址" name="com_adress" id='sever_add' ><input type='button' value='点击显示地图获取地址经纬度' id='open'>
				</div>
		    </div>
		</div>
		
         <div class="layui-inline">
			    <label class="layui-form-label">社区类型</label>
				<div class="layui-input-block">
					<?php foreach($data as $k=>$v): ?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $v['comm_name']; ?><input type="checkbox" lay-skin="primary" name="comm_id[]" checked="checked" value="<?php echo $v['comm_id']; ?>">
					 <?php endforeach; ?>
					
				</div>
		    </div>

		<div class="layui-form-item">
			<div class="layui-input-block">
				<input type="submit" class="layui-btn" value="立即提交"  lay-submit="index/qqq">
				<!-- <button class="layui-btn" lay-submit="" lay-filter="addUser">立即提交</button> -->
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/addUser.js"></script>
</body>
<div id="allmap" style=" width: 1000px; height: 400px; display: none;" ></div>
</html>
<script type="text/javascript">  
    function validate() {  
        var sever_add = document.getElementsByName('sever_add')[0].value;  
        if (isNull(sever_add)) {  
            alert('请选择地址');  
            return false;  
        }  
        return true;  
    }  
  
    //判断是否是空  
    function isNull(a) {  
        return (a == '' || typeof(a) == 'undefined' || a == null) ? true : false;  
    }  
  
    document.getElementById('open').onclick = function () {  
        if (document.getElementById('allmap').style.display == 'none') {  
            document.getElementById('allmap').style.display = 'block';  
        } else {  
            document.getElementById('allmap').style.display = 'none';  
        }  
    }  
  
    var map = new BMap.Map("allmap");  
    var geoc = new BMap.Geocoder();   //地址解析对象  
    var markersArray = [];  
    var geolocation = new BMap.Geolocation();  
  
     var point = new BMap.Point(116.308402,39.972907);
    map.centerAndZoom(point, 12); // 中心点  
    geolocation.getCurrentPosition(function (r) {  
        if (this.getStatus() == BMAP_STATUS_SUCCESS) {   
            var mk = new BMap.Marker(r.point);  
            map.addOverlay(mk);  
            map.panTo(r.point);  
            map.enableScrollWheelZoom(true);  
        }  
        else {  
            -alert('failed' + this.getStatus());  
        }  
    }, {enableHighAccuracy: true})  
    map.addEventListener("click", showInfo);  
  
  
    //清除标识  
    function clearOverlays() {  
        if (markersArray) {  
            for (i in markersArray) {  
                map.removeOverlay(markersArray[i])  
            }  
        }  
    }  
    //地图上标注  
    function addMarker(point) {  
        var marker = new BMap.Marker(point);  
        markersArray.push(marker);  
        clearOverlays();  
        map.addOverlay(marker);  
    }  
    //点击地图时间处理  
    function showInfo(e) {  
        document.getElementById('lng').value = e.point.lng;  
        document.getElementById('lat').value =  e.point.lat;  
        geoc.getLocation(e.point, function (rs) {  
            var addComp = rs.addressComponents;  
            var address = addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber;  
            if (confirm("确定要地址是" + address + "?")) {  
                document.getElementById('allmap').style.display = 'none';  
                document.getElementById('sever_add').value = address;  
            }  
        });  
        addMarker(e.point);  
    }  
</script>  
<!-- <script type="text/javascript" src="__ROOT__/jquery-1.8.3.js"></script>
<script type="text/javascript">
	$(document).on('blur','#name',function(){
		var name = $(this).val();
		// alert(name)
	})
</script> -->
