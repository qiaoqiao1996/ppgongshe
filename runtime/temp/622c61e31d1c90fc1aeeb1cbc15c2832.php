<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpStudy\WWW\1\ppgongshe\public/../application/index\view\buurt\comm_type.html";i:1527822812;}*/ ?>
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
  <link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all" />
  <style type="text/css">
    .layui-form-item .layui-inline{ width:33.333%; float:left; margin-right:0; }
    @media(max-width:1240px){
      .layui-form-item .layui-inline{ width:100%; float:none; }
    }
  </style>
</head>
<body class="childrenBody">
  <form class="layui-form" action="comm_type_exec" style="width:80%;" method="post" enctype="multipart/form-data">
    <div class="layui-form-item">
      <label class="layui-form-label">分类名称</label>
      <div class="layui-input-block">
        <input type="text" class="layui-input userName" name="comm_name" lay-verify="required" placeholder="请输入名称">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">分类LOGO</label>
      <div class="layui-input-block" >
        <input type="file"  name="comm_logo">
      </div>
    </div>


    <div class="layui-form-item">
      <div class="layui-input-block">
        <input type="submit" class="layui-btn" lay-submit=""  value="立即提交">
        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
  </form>
  <script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
  <script type="text/javascript" src="__JS__/addUser.js"></script>
</body>
</html>