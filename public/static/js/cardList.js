layui.config({
	base : "js/"
}).use(['form','layer','jquery','laypage'],function(){
	var form = layui.form(),
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage,
		$ = layui.jquery;

	//加载页面数据
	var newsData = '';
	$.get("cardData", function(data){
	  	//正常加载信息
		cardData = data;
		if(window.sessionStorage.getItem("addCard")){
			var addCard = window.sessionStorage.getItem("addCard");
			cardData = JSON.parse(addCard).concat(cardData);
		}
		//执行加载数据的方法
		cardList();
	})
//	筛选
	$('.card_type').on('change', function(data){
		var type_id = $(this).val()
		$.ajax({
			url:'getTypeNum',
			data:{type_id:type_id},
			type:'post',
			success:function(data){
				var nums = 10;
				var data = JSON.parse(data)
				laypage({
					cont : "page",
					pages : Math.ceil(data.length/nums),
					jump : function(obj){
						$(".card_content").html(cardata(data,obj.curr));
						$('.card_list thead input[type="checkbox"]').prop("checked",false);
				    	form.render();
					}
				})
				function cardata(data,curr){
					var dataHtml = '';
					data = data.concat().splice(curr*nums-nums, nums);
					if(data.length == 0){
						dataHtml = '<tr><td colspan="8" align="center">暂无数据</td></tr>';
					}else{
						$.each(data, function(k,v) {
							dataHtml += '<tr>'
					    	+'<td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose" card_id="'+v.card_id+'"></td>'
					    	+'<td align="left">'+v.card_number+'</td>'
					    	+'<td>'+v.type_name+'</td>';
					    	
					    	dataHtml += '<td>'+v.d_name+'</td>';
					    	if(v.card_status == 0){
					    		dataHtml += '<td>未开通</td>';
					    	}else{
					    		dataHtml += '<td>已开通</td>';
					    	}
					    	dataHtml += '<td>'
							+  '<a class="layui-btn layui-btn-danger layui-btn-mini card_del" card_id="'+v.card_id+'"><i class="layui-icon">&#xe640;</i> 删除</a>'
					        +'</td>'
					    	+'</tr>';
						});
					}
	    			return dataHtml;
				}
			}
		}) 
	});
	
	//添加手机号
	$(".cardAdd_btn").click(function(){
		var index = layui.layer.open({
			title : "添加手机号",
			type : 2,
			content : "cardAdd",
			success : function(layero, index){
				layui.layer.tips('点击此处返回手机卡列表', '.layui-layer-setwin .layui-layer-close', {
					tips: 3
				});
			}
		})
		//改变窗口大小时，重置弹窗的高度，防止超出可视区域（如F12调出debug的操作）
		$(window).resize(function(){
			layui.layer.full(index);
		})
		layui.layer.full(index);
	})

	//批量删除
	$(".batchDel").click(function(){
		var $checkbox = $('.card_list tbody input[type="checkbox"][name="checked"]');
		var $checked = $('.card_list tbody input[type="checkbox"][name="checked"]:checked');
		var arr = Array();
		$.each($checked, function(k,v) {
			arr[k] = $(v).attr('card_id')
		});
		console.log(arr)
		if($checkbox.is(":checked")){
			layer.confirm('确定删除选中的信息？',{icon:3, title:'提示信息'},function(index){
				var index = layer.msg('删除中，请稍候',{icon: 16,time:false,shade:0.8});
	            $.ajax({
					type:"post",
					url:"cardDel",
					data:{card_id:arr},
					success:function(e){
						$.each($checked, function(k,v) {
							$(v).parents("tr").remove()
						});
						
					}
				});
            	//删除数据
                layer.close(index);
				layer.msg("删除成功");
	            
	        })
		}else{
			layer.msg("请选择需要删除的文章");
		}
	})

	//全选
	form.on('checkbox(allChoose)', function(data){
		var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
		child.each(function(index, item){
			item.checked = data.elem.checked;
		});
		form.render('checkbox');
	});

	//通过判断文章是否全部选中来确定全选按钮是否选中
	form.on("checkbox(choose)",function(data){
		var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
		var childChecked = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"]):checked')
		if(childChecked.length == child.length){
			$(data.elem).parents('table').find('thead input#allChoose').get(0).checked = true;
		}else{
			$(data.elem).parents('table').find('thead input#allChoose').get(0).checked = false;
		}
		form.render('checkbox');
	})
 
	//操作
	//删除
	$("body").on("click",".card_del",function(){  
		var _this = $(this);
		var card_id = $(this).attr('card_id')
		layer.confirm('确定删除此号码？',{icon:3, title:'提示信息'},function(index){
			$.ajax({
				type:"post",
				url:"cardDel",
				data:{card_id:card_id},
				success:function(e){
					_this.parents("tr").remove();
				}
			});
			layer.close(index);
		});
	})
	
	function cardList(that){
		//渲染数据
		function renderDate(data,curr){
			var dataHtml = '';
			if(!that){
				currData = cardData.concat().splice(curr*nums-nums, nums);
			}else{
				currData = that.concat().splice(curr*nums-nums, nums);
			}
			if(currData.length != 0){
				for(var i=0;i<currData.length;i++){
					dataHtml += '<tr>'
			    	+'<td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose" card_id="'+currData[i].card_id+'"></td>'
			    	+'<td align="left">'+currData[i].card_number+'</td>'
			    	+'<td>'+currData[i].type_name+'</td>';
			    	
			    	dataHtml += '<td>'+currData[i].d_name+'</td>';
			    	if(currData[i].card_status == 0){
			    		dataHtml += '<td>未开通</td>';
			    	}else{
			    		dataHtml += '<td>已开通</td>';
			    	}
			    	dataHtml += '<td>'
					+  '<a class="layui-btn layui-btn-danger layui-btn-mini card_del" card_id="'+currData[i].card_id+'"><i class="layui-icon">&#xe640;</i> 删除</a>'
			        +'</td>'
			    	+'</tr>';
				}
			}else{
				dataHtml = '<tr><td colspan="8">暂无数据</td></tr>';
			}
		    return dataHtml;
		}

		//分页
		var nums = 10; //每页出现的数据量
		if(that){
			cardData = that;
		}
		laypage({
			cont : "page",
			pages : Math.ceil(cardData.length/nums),
			jump : function(obj){
				$(".card_content").html(renderDate(cardData,obj.curr));
				$('.news_list thead input[type="checkbox"]').prop("checked",false);
		    	form.render();
			}
		})
	}
})
