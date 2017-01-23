var arr={
		"cr":[//替换或增加
			{cid:3,ord:8,href:'/Skr/upgoods',css:false,name:"批量上传(老版本)",ie:false},

			{cid:8,ord:7,href:'/Skr/utitle',css:false,name:"批量重命名",ie:false},
			//{cid:5,ord:0,href:'/Smart/view',css:false,name:"Smart标签",ie:true}
			//{cid:8,ord:0,href:'/System/advanced',css:false,name:"高级管理",ie:true}
		],
		"bt":[//新增
				{
				"title":'<dt class="item_tit"><a href="javascript:;"><i class="icon icon_join"></i>会员管理</a></dt><dd class="item_cont" style="display:none"><ul></ul></dd>',
				"ie":true,
				"cr":[
						{href:'/User',css:false,name:"查看会员",ie:true},
						{href:'/User/group',css:false,name:"查看用户组",ie:true}
					]
				},
				{
				"title":'<dt class="item_tit"><a href="javascript:;"><i class="icon icon_sys"></i>调用</a></dt><dd class="item_cont" style="display:none"><ul></ul></dd>',
				"ie":false,
				"cr":[
						{href:'/Skr/call',css:false,name:"页面取值",ie:false},
						{href:'/Skr/s_nav',css:false,name:"导航",ie:false}
					]
				}
		],
		"sc":[//删除
			//{cid:3,ord:4}
		]
	}

$(function() {	
	

	var ie=false,
	 	$lay_menu=$("#lay_menu");
	if($.browser.msie){
		ie=$.browser.version;
		(ie<9 && ie)?'':ie=false;
	};

	$.each(arr.sc,function(key,val){
		arr.sc[key].dt=$lay_menu.find("dt:eq("+(val.cid-1)+")");
		arr.sc[key].dd=arr.sc[key].dt.next();
	});
	$.each(arr.sc,function(key,val){
		if(val.ord){
			arr.sc[key].dd.find("ul li:eq("+(val.ord-1)+")").remove();
		}else{
			arr.sc[key].dd.remove();
			arr.sc[key].dt.remove();
		}
	});//删除
	
	$.each(arr.cr,function(key,val){
		if(val.ie || !ie){
			val.css=val.css?val.css:"icon icon_this";
			var add_li='<li><a href="'+location.href+val.href+'" target="main"><i class="'+val.css+'"></i>'+val.name+'</a></li>',
				$dd=$lay_menu.find("dt:eq("+(val.cid-1)+")").next();
			if(val.ord){
				$dd.find("ul li:eq("+(val.ord-1)+")").replaceWith(add_li);
			}else{
				$dd.find("ul").append(add_li);
			}
		}
	});//替换

	$.each(arr.bt,function(key,val){
		if(val.ie || !ie){
			var $title=$(val.title);
			$lay_menu.find("dt.item_end").before($title);
			$.each(val.cr,function(key,val){
				if(val.ie || !ie){
					val.css=val.css?val.css:"icon icon_this";
					var add_li='<li><a href="'+location.href+val.href+'"target="main"><i class="'+val.css+'"></i>'+val.name+'</a></li>';
					$title.find("ul").append(add_li);
				}
			});
		}
	});//新增
	
});