/*
	作者：sky
	版本号：1.3
	Data:2015.3.27
*/
(function($){
	$.extend({
		"productgundong":function(picUL,picture,picle,picri,picxianshi){
			var piclen = picUL.find(picture).length;
			var picwidth = picture.width();
			var picindex = 0 ;
			picUL.css("width",picwidth*piclen);	
			picUL.css("position","relative");
			picle.click(function(){
				picindex --
				if (picindex<1) {
					picindex=piclen-picxianshi
					piczhi(picindex)
				}else{
					piczhi(picindex)
				}
			})
			picri.click(function(){
				picindex ++
				if (picindex>piclen-picxianshi) {
					picindex=0
					piczhi(picindex)
				}else{
					piczhi(picindex)
				}
			})
			function piczhi(picindex){
				var picsum = -picindex * picwidth
				picUL.stop(true,false).animate({
					"left":picsum
				},"slow")
			}
			picUL.hover(function(){
				clearInterval(time);
			},function(){
				time = setInterval(function(){
					picindex++;
					if(picindex>piclen-picxianshi){picindex = 0;}
					piczhi(picindex);
					},3000);	//此3000代表自动播放的间隔，单位：毫秒
				});
			picUL.trigger("mouseleave");	//触发mouseleave事件
		},
		"tab":function(tab_title,tab_text,tab_css){
			var tab_title_li = tab_title.find("li");
			var tab_text_li = tab_text.find("li");
			tab_title.each(function(){
				$(this).find("li").eq(0).addClass(tab_css);
				
			})
			tab_text.each(function(){
				$(this).find("li").eq(0).show();
			})
			tab_title_li.hover(function(){
				$(this).addClass(tab_css).siblings().removeClass(tab_css)
				var tabnum=tab_title_li.index(this);
				tab_text_li.eq(tabnum).show().siblings().hide();
			})
		},
		"newsgundong":function(){
			
		},
		"productyuandi":function(yuandiqiehuan,qiehuansudu){
			var qiehuanli = yuandiqiehuan.find("li")
			var qiehuanlen = qiehuanli.length;
			qiehuanindex=1;
			qiehuanli.css({"z-index":"0","display":"none","position":"absolute"});
			qiehuanli.eq(0).css({"z-index":"1","display":"block"});
			setInterval(showtime,qiehuansudu);
			function showtime(){
				if(qiehuanindex == qiehuanlen ){
					qiehuanindex = 0;
				}
				if (qiehuanindex == 0) {
					qiehuanli.eq(qiehuanlen-1).css({"z-index":"0"}).fadeOut();
				}else{
					qiehuanli.eq(qiehuanindex-1).css({"z-index":"0"}).fadeOut();
				}
					qiehuanli.eq(qiehuanindex).css({"z-index":"1"}).fadeIn();
				qiehuanindex++;
			}
		}
	})
})(jQuery);