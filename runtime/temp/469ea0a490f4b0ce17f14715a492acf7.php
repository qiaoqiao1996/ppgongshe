<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"E:\phpstudy\WWW\ppgongshe\public/../application/index\view\mobilecard\card_list.html";i:1528978627;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>手机号列表--layui后台管理模板</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="__CSS__/font_eolqem241z66flxr.css" media="all" />
	
</head>
<body class="childrenBody">
	<blockquote class="layui-elem-quote">
		<div class="layui-input-inline ">
			<select name="type_id" class="card_type layui-select" id="card_type" lay-filter="typeLook">
		        <option value="0" type_id='0'>运营商筛选</option>
		        <option value="1" type_id='1'>移动</option>
		        <option value="2" type_id='2'>联通</option>
		        <option value="3" type_id='3'>电信</option>
		   </select> 
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-normal cardAdd_btn">添加手机号</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-danger batchDel">批量删除</a>
		</div>
		<div class="layui-inline">
			<div class="layui-form-mid layui-word-aux">本页面刷新后除新添加的手机号外所有操作无效，关闭页面所有数据重置</div>
		</div>
	</blockquote>
	<div class="layui-form card_list">
	  	<table class="layui-table">
		    <colgroup>
				<col width="15">
				<col>
				<col width="10%">
				<col width="40%">
				<col width="10%">
				<col width="25%">
		    </colgroup>
		    
		    <thead>
				<tr>
					<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>
					<th style="text-align:left;">手机号</th>
					<th>运营商</th>
					<th>套餐</th>
					<th>状态</th>
					<th>操作</th>
				</tr> 
		    </thead>
		    <tbody class="card_content"></tbody>
		</table>
	</div>
	<div id="page"></div>
	<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
	<script type="text/javascript" src="__JS__/cardList.js"></script>
</body>
</html>