layui.config({
	base : "js/"
}).use(['form','layer','jquery','layedit','laydate'],function(){
	var form = layui.form(),
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage,
		layedit = layui.layedit,
		laydate = layui.laydate,
		$ = layui.jquery;

	//创建一个编辑器
 	var editIndex = layedit.build('news_content');
 	var typeNewsArray = [],addNews;
 	form.on("submit(typeAdd)",function(data){
 		//是否添加过信息
	 	if(window.sessionStorage.getItem("typeAdd")){
	 		typeNewsArray = JSON.parse(window.sessionStorage.getItem("typeAdd"));
	 	}

 		typeAdd = '{"type_Name":"'+$(".typeName").val()+'",';  //模型名称
 		typeAdd += '"type_content":"'+ $(".type_content").val()+'"}'; //模型详情
 		typeAddArray.unshift(JSON.parse(typeAdd));
 		window.sessionStorage.setItem("typeAdd",JSON.stringify(typeNewsArray));
 		//弹出loading
 		var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        setTimeout(function(){
            top.layer.close(index);
			top.layer.msg("模型添加成功！");
 			layer.closeAll("iframe");
	 		//刷新父页面
	 		parent.location.reload();
        },2000);
 		return false;
 	})
	
})
