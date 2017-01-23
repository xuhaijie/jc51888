"use strict;"
$(document).ready(function(e) {	
	//二级
	$("#Nav-1").find(".dropdown").hover(function(){
		var $this=$(this);
		$this.find(">.dropdown-menu").slideDown(100,function(){
			var $this=$(this);
			$this.css({"overflow":"visible"});
			$this.find('>li').css({"overflow":"visible"});
			$this.find('.nav-div').css({"height":$this.height()+"px"})
		});
	},function(){
		var $this=$(this);
		$this.find(">.dropdown-menu").stop().slideUp();
	});
	// $("#Nav-1").find('.nav-li').hover(function(){
	// 	var $this=$(this);
	// 	$this.find(">.nav-div").slideDown();
	// },function(){
	// 	var $this=$(this);
	// 	$this.find(">.nav-div").stop().slideUp();
	// });

	//首页滚动
    (function($) {
        //$("#Area2 ul,#Area3 ul").simplyScroll({speed:1,frameRate:24,direction:"forwards"});
        //$('').kxbdSuperMarquee({time:1});
        $('#demo-f').kxbdSuperMarquee({
            distance:1,
            time:(24/1000),
            isEqual:false,
            btnGo:{left:'#goL',right:'#goR'},
            direction:'left'
        });
    })(jQuery);
	//大图轮播
	// speed: 500,               //  滚动速度
	// delay: 3000,              //  动画延迟
	// complete: function() {},  //  动画完成的回调函数
	// keys: true,               //  启动键盘导航
	// dots: true,               //  显示点导航
	// fluid: false              //  支持响应式设计
	(function($) {
		$('#KinSlideshow').unslider({
			dots: true,
			delay: 5000, 
			fluid: true
		});
	})(jQuery);
})
//设为首页
function SetHome(obj,url){
    try{
        obj.style.behavior='url(#default#homepage)';
       obj.setHomePage(url);
   }catch(e){
       if(window.netscape){
          try{
              netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
         }catch(e){
              alert("抱歉，此操作被浏览器拒绝！\n\n请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为'true'");
          }
       }else{
        alert("抱歉，您所使用的浏览器无法完成此操作。\n\n您需要手动将【"+url+"】设置为首页。");
       }
  }
}
		 
//收藏本站 
function AddFavorite(title, url) {
  try {
      window.external.addFavorite(url, title);
  }
catch (e) {
     try {
       window.sidebar.addPanel(title, url, "");
    }
     catch (e) {
         alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加");
     }
  }
}

$(function() {
    if($("#pjax").length>0){
        var scrollTop = $("#pjax").offset().top;
        $("body,html").animate({scrollTop:scrollTop},1500);
    }else{
        return false;
    }
});