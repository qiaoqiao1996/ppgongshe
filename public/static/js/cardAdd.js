layui.config({
	base : "js/"
}).use(['form','layer','jquery','layedit','laydate'],function(){
	var form = layui.form(),
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage,
		layedit = layui.layedit,
		laydate = layui.laydate,
		$ = layui.jquery;

	form.on('select(browseLook)', function(data){
		var type_id = '';
		var type = $(this).text()
		if(type == '移动'){
			type_id = 1
		}else if(type == '联通'){
			type_id = 2
		}else if(type == '电信'){
			type_id = 3
		}
		$.ajax({
			url:'getdeta',
			data:{type_id:type_id},
			type:'post',
			success:function(e){	
				$('#meal').empty()
				var op = '<option value="0">请选择套餐</option>'
				data = JSON.parse(e)
				
				$.each(data, function(k,v) {
					op += '<option value="'+v.details_id+'">'+v.d_name+'</option>'
				});
				$('#meal').append(op)
				form.render('select','browseLook1');
			}
		})
	
  		 
	});
	
	
})
