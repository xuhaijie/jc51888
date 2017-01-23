//公用js函数库 需要jQuery支持
$(function(){

    $("#lay_menu").find(".item_cont").hide()
    function layout(){
        var reset = function(){
            var htmlHeight = $("html").height();
            var docHeight = document.documentElement.clientHeight;
            
            var iframe = $("#iframe");
            var sideHeight = $("#lay_sidebar").height();
            var topMenuHeight = $("#topMenu").height();
            var logoHeight = $("#logo").height();
            var lay_menuHeight = $("#lay_menu").height();
            var copyright = $("#copyright");
            var copyrightHeight = copyright.height();
            
            
            // 如果logo+左侧菜单的高度大于窗口高度
            if((copyrightHeight + logoHeight + lay_menuHeight) > docHeight){
                copyright.css({position:"relative"})
                iframe.stop().animate({height:logoHeight + lay_menuHeight + copyright.height() - topMenuHeight},100)
            }else{
                copyright.css({position:"absolute"})
                iframe.stop().animate({height:docHeight - topMenuHeight - 2},100)
            }
        }

        reset()
        $(window).resize( function(){
            setTimeout(reset,100)
        });
    }
    layout()


    var f = false;
    $("#side_show").click(function(){
        if(f){
            $(this).removeClass("show_side")
            $("#lay_main").css({"margin-left":"233px"})
            $("#lay_sidebar").show();
            f = false;
        }else{
            $(this).addClass("show_side")
            $("#lay_main").css({"margin-left":"0px"})
            $("#lay_sidebar").hide();
            f = true;
        }
    
    })

    $("#lay_menu").find(">dt.item_tit").on("click",function(){
    	var $this=$(this);
    	$this.toggleClass("on")
    	$this.next("dd").slideToggle(400)
    	//console.log($this.next("+dd.item_cont"))
    })

    // $("#lay_menu").find(".item_tit").each(function(){
    //     $(this).bind("click",function(i){
    //     	$(".item_cont").slideUp('normal');
    //         if( !$(this).hasClass("on") ){
    //         	$(".item_tit").removeClass("on");
    //             $(this).addClass("on");
    //             $(this).next().slideDown('normal');
    //         }else{
    //         	$(".item_tit").removeClass("on");
    //             $(this).next().slideUp('normal');
    //         }
    //     })
    // })

    $("#lay_menu").find("dd.item_cont a").click(function(){
        $("#lay_menu").find("dd.item_cont a").removeClass("on");
        $(this).addClass("on")
    
    })
    
    //登录框输入框默认选择
    $("#username").focus(); 
    
	$(".tableMod table tr").hover(
		function () {
			$(this).addClass("hover");
		},
		function () {
			$(this).removeClass("hover");
		}
	);
	
	//$("#web_watermark").parent().parent().hide();
	var s = $('input:radio[name="switch_watermark"]:checked').val();
	if(s == '0')
	{
		$("#web_watermark").parent().parent().hide();
	}
	$('input:radio[name="switch_watermark"]').click(function(){
		if($(this).val() == '0')
		{
			$("#web_watermark").parent().parent().hide();
		}else
		{
			$("#web_watermark").parent().parent().show();
		}
	});
	
	//点击修改排序
	$("#example").on("click","td.order",function(){
		var $this=$(this).find("span").length?$(this).find("span"):$(this),
			order_var = $this.html(),
			$order_ajax=$("<input type='text' data-zid='"+$this.data("zid")+"' id='order_ajax' class='txt'  size='2' value="+$this.html()+" />");
			if(!$this.find("*").length){
				$this.html($order_ajax);
				$order_ajax.focus(); 
				$order_ajax.select();
				$order_ajax.on("blur",function(){
					var $this=$(this),
					order_var = $this.val(),
					id = $this.data("zid");
					$this.parent().html(order_var);
					$.getJSON(url+"/Admin/"+type+"/ajax/t/order/id/"+id+"/value/"+order_var, function(data){
						//alert(data.data);//提示信息
					});
				})
			}
			
	});
});
/**
 * 
 */
function logout(url){

    //后台退出使用
    if(confirm('是否确认安全退出？'))
    {
    	window.location.href=url;
    	return true;
    }else
    {
    	return false;
    }
}
/**
 * 开发测试使用
 * @param n
 */
function returnHeight(n){
	alert(n)
}

/**
 * 验证码刷新
 * @author wangyong
 */
function refreshVerify(url)
{
	timestamp=new Date().getTime();
	$('#verifyImg').attr('src',url+timestamp);
}

/**
 * 全选checkbox,注意：标识checkbox id固定为为check_box
 * @param string name 列表check名称,如 uid[]
 */
function selectall(name) {
	if ($("#check_box").attr("checked")) {
		$("input[name='"+name+"']").attr("checked",true);
	} else {
		$("input[name='"+name+"']").attr("checked",false);
	}
}
/**
 * 
 * 批量删除
 * @param e
 * @param type
 * @returns {Boolean}
 */
function batch_del(e,type,b)
{
	var ids = '',
	$checked=$("#example").find("input.checkbox-1:checked").slice(0,100);
	$checked.each(function(){ //由于复选框一般选中的是多个,所以可以循环输出 
		ids += $(this).val()+","; 
	});
	ids=ids.substring(0,ids.length-1);
	if(ids == '')
	{
		if(!b){alert('请选择要删除的栏目！')}else{location.reload()};
	}else{
		if(b?b:confirm('是否确认删除！'))
		{		
			$.getJSON(url+"/Admin/"+type+"/ajax/t/batch_del/ids/"+ids, function(data){
				if(data.status == '1')
				{
					$checked.parent().parent().remove();
					batch_del(e,type,true);
				}
			})
		}
	}
}

/**
 * 
 * 批量恢复
 * @param e
 * @param type
 * @returns {Boolean}
 */
function batch_recover(e,type,b)
{
	var ids = '',
	$checked=$("#example").find("input.checkbox-1:checked").slice(0,100);
	$checked.each(function(){ //由于复选框一般选中的是多个,所以可以循环输出 
		ids += $(this).val()+","; 
	});
	ids=ids.substring(0,ids.length-1);
	if(ids == '')
	{
		if(!b){alert('请选择要恢复的栏目！')}else{location.reload()};
	}else{
		if(b?b:confirm('是否确认恢复！'))
		{		
			$.getJSON(url+"/Admin/"+type+"/ajax/t/batch_recover/ids/"+ids, function(data){

				//alert(data.data);//提示信息
				if(data.status == '1')
				{
					
					$checked.parent().parent().remove();
					batch_recover(e,type,true);
				}
			})
		}
	}
}

/**
 * 
 * 批量隐藏
 * @param e
 * @param type
 * @returns {Boolean}
 */
function batch_hid(e,type,b)
{
	var ids = '',
	$checked=$("#example").find("input.checkbox-1:checked").slice(0,100);
	$checked.each(function(){ //由于复选框一般选中的是多个,所以可以循环输出 
			ids += $(this).val()+","; 
	});
	ids=ids.substring(0,ids.length-1);
	if(ids == '')
	{
		if(!b){alert('请选择要删除的栏目！')}else{location.reload()};

	}else{
		if(b?b:confirm('是否确认删除！'))
		{		
			$.getJSON(url+"/Admin/"+type+"/ajax/t/batch_hid/ids/"+ids, function(data){

				if(data.status == '1')
				{
					$checked.parent().parent().remove();
					batch_hid(e,type,true)
				}
			})
		}
	}
}
/**
 * 删除
 * @param type
 * @param id
 */
function del(e,type, id)
{
	if(confirm('是否确认删除！删除后不可恢复！'))
	{
		$.getJSON(url+"/Admin/"+type+"/ajax/t/del/id/"+id, function(data){

			//alert(data.data);//提示信息
			if(data.status == '1')
			{
				$(e).parent().parent().remove();
			}
		})
	}
}
/**
 * 
 * 恢复
 * @param e
 * @param type
 * @param id
 */
function recover(e,type, id)
{
	if(confirm('是否确认恢复！'))
	{
		$.getJSON(url+"/Admin/"+type+"/ajax/t/recover/id/"+id, function(data){
			//alert(data.data);//提示信息
			if(data.status == '1')
			{
				$(e).parent().parent().remove();
			}
		})
	}
}
/**
 * 隐藏
 * @param type
 * @param id
 */
function hid(e,type, id)
{
	if(confirm('是否确认删除！'))
	{
		$.getJSON(url+"/Admin/"+type+"/ajax/t/hid/id/"+id, function(data){

			//alert(data.data);//提示信息
			if(data.status == '1')
			{
				$(e).parent().parent().remove();
			}
		})
	}
}

/**
 * 完成 订单状态1
 * @param type
 * @param id
 */
function compelet(e,type, id)
{
	if(confirm('是否确认完成！'))
	{
		$.getJSON(url+"/Admin/"+type+"/ajax/t/compete/id/"+id, function(data){

			//alert(data.data);//提示信息
			if(data.status == '1')
			{
				$(e).parent().parent().html('');
			}
		})
	}
}


/**
 * 用户禁用启用
 * 
 */
function user_show(e,type, id){
	if(confirm('确认修改?')){
		
		if(type==1){
			var jurl=url+"/Admin/User/ajax/t/user_show/id/"+id;
		}else{
			var jurl=url+"/Admin/User/ajax/t/user_hidden/id/"+id;
		}
		$.getJSON(jurl, function(data){
			if(data.status == '1')
			{	
				if(type==1){
					$(e).parent().html('<a href="javascript:;" onclick="user_show(this,0,'+id+')"><i class="icon icon_edit"></i>启用</a>');
				}else{
					$(e).parent().html('<a href="javascript:;" onclick="user_show(this,1,'+id+')"><i class="icon icon_x"></i>禁用</a>');
				}
				alert(data.data);
			}
		});
	}
}

/**
 * 前台显示
 * @param type
 * @param id
 */
function add_show(e,type, id)
{
	if(confirm('是否显示！'))
	{
		$.getJSON(url+"/Admin/"+type+"/ajax/t/add_show/id/"+id, function(data){

			//alert(data.data);//提示信息
			if(data.status == '1')
			{	
				alert(data.data);
			}
		})
	}
}

/**
 * 前台取消显示
 * @param type
 * @param id
 */
function quit_show(e,type, id)
{
	if(confirm('是否取消显示！'))
	{
		$.getJSON(url+"/Admin/"+type+"/ajax/t/quit_show/id/"+id, function(data){

			//alert(data.data);//提示信息
			if(data.status == '1')
			{
				alert(data.data);
			}
		})
	}
}

/**
 * smart 数据库表优化修复
 * @param e
 * @param type
 * @param names
 */
function optimization(type,names)
{
	if(names == '')
	{
		var ids = '';
		$("input[type=checkbox]").each(function(){ //由于复选框一般选中的是多个,所以可以循环输出 
			if($(this).attr("checked") == 'checked')
			{
				ids += $(this).val()+","; 
			}
		});
		ids=ids.substring(0,ids.length-1);
		if(ids == '')
		{
			alert('请先选择需要处理的表！');
			return false;
		}
		names = ids;
	}
	$.getJSON(url+"/Admin/Smart/ajax/t/"+type+"/name/"+names, function(data){
	
		//alert(data.data);//提示信息
		if(data.status == '1')
		{
			alert(data.data);
		}
	})
}
/**
 * 图标旋转
 * @param type
 * @param id
 */
$(document).ready(function(){
    $(".item_tit").hover(
			function(){$(this).find('i').addClass('rotate')},
			function(){$(this).find('i').removeClass('rotate')}
	);	
});
/**
 * 修改信息
 * @param type
 * @param id
 */
function edit(type, id)
{
	
}

function filter($str)
{
	return trim($str);
}

function jump()
{

}