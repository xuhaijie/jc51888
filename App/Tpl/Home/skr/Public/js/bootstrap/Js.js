// JavaScript Document
$(document).ready(function(e) {
	/*<thead>
		<tr>
	      <th>属性</th>
	      <th>默认</th>
	      <th>描述</th>
    	</tr>
  	</thead>
 	<tbody>
        <tr>
        <td>customClass</td><td>'simply-scroll'</td><td>主题</td>
        </tr>
	</tbody>*/
$(window).hashchange( function(){
	scfs(cjs[location.hash])
})

var cjs={
	'#simplyscroll':{
		'name':"simplyscroll",
		'Quote':['<script type="text/javascript" src="__TMPL__Public/Js/simplyscroll/jquery.simplyscroll.min.js"></script>',
		'<link href="__TMPL__Public/Js/simplyscroll/jquery.simplyscroll.css" rel="stylesheet">'
		],
		'Method':'$(this).simplyScroll();',
		'Fhtml':'',
		'Href':'<a href="http://logicbox.net/jquery/simplyscroll/" target="_blank">http://logicbox.net/jquery/simplyscroll/</a>',
		'Property':[	
			["customClass","'simply-scroll'","","主题"],
			["frameRate","24","数值","动作/帧每秒数"],
			["speed","1","数值","每帧移动像素"],
			["orientation","'horizontal'","'horizontal'(水平) or 'vertical'(垂直)","滚动方向"],
			["direction","'forwards'","'forwards'(无限) or 'backwards'(来回)","滚动模式"],
			["auto","true","trur or false","自动滚动，使用虚假的按钮控件"],
			["autoMode","'loop'","auto = true, 'loop' or 'bounce'","汽车=真正的'循环'或'反弹'，（禁用按钮）"],
			["manualMode","'end'","auto = false, 'loop' or 'end'","汽车=假，'循环'或'端'（终端到终端）"],
			["pauseOnHover","true","trur or false","悬停"],
			["pauseOnTouch","true","trur or false","触摸功能的设备（自动）"],
			["pauseButton","false","trur or false","创建一个暂停按钮（自动）"],
			["startOnLoad","false","trur or false","初始化插件window.load（允许图像加载等）"]
			]
	},
	'#KinSlideshow':{
		'name':"KinSlideshow",
		'Quote':['<script type="text/javascript" src="__TMPL__Public/Js/KinSlideshow/jquery.KinSlideshow.js"></script>'],
		'Method':'$("KinSlideshow").KinSlideshow()',
		'Fhtml':[
		'<div id="KinSlideshow" style="visibility:hidden;">',
		'	<a href="" target="_blank"><img src="images/1.jpg" alt="这是标题一" /></a>',
		'	<a href="" target="_blank"><img src="images/2.jpg" alt="这是标题二" /></a>',
		'	<a href="" target="_blank"><img src="images/3.jpg" alt="这是标题三" /></a>',
		'	<a href="" target="_blank"><img src="images/4.jpg" alt="这是标题四" /></a>',
		'	<a href="" target="_blank"><img src="images/5.jpg" alt="这是标题五" /></a>',
		'	<a href="" target="_blank"><img src="images/6.jpg" alt="这是标题六" /></a>',
		'</div>'
		],
		'Href':'<a href="http://js.alixixi.com/demo/652/index.html" target="_blank">http://js.alixixi.com/demo/652/index.html</a>',
		'Property':[
		]
	},
	'#Marquee':{
		'name':"Marquee",
		'Quote':['<script type="text/javascript" src="__TMPL__Public/Js/Marquee/Marquee.js"></script>',
		],
		'Method':'$("#Marquee").kxbdSuperMarquee();',
		'Fhtml':['<div id="marquee">',
	  	'	<ul>',
    	'		<li></li>',
   		'		<li></li>',
   		'	</ul>',
   		'</div>'
   		],
		'Href':'<a href="http://www.kxbd.com/?p=285#comment-119" target="_blank">http://www.kxbd.com/?p=285#comment-119</a>',
		'Property':[]
	},
	'#unslider':{
		'name':"unslider",
		'Quote':['<script type="text/javascript" src="__TMPL__Public/Js/unslider/unslider.min.js"></script>',
		],
		'Method':'$(".banner").unslider();',
		'Fhtml':['<div class="banner">',
		'	<ul>',
		'		<li>This is a slide.</li>',
		'		<li>This is another slide.</li>',
		'		<li>This is a final slide.</li>',
		'	</ul>',
		'</div>'
   		],
		'Href':'<a href="http://www.bootcss.com/p/unslider/" target="_blank">http://www.bootcss.com/p/unslider/</a><br/>'+
		'<a href="http://www.cnblogs.com/lhb25/archive/2013/03/23/responsive-jquery-slider-unslider.html" target="_blank">http://www.cnblogs.com/lhb25/archive/2013/03/23/responsive-jquery-slider-unslider.html<a>',
		'Property':[]
	},
	'#fancybox':{
		'name':"fancybox",
		'Quote':['<script type="text/javascript" src="__TMPL__Public/Js/fancybox/jquery.fancybox.pack.js"></script>',
		'<link href="__TMPL__Public/Js/fancybox/jquery.fancybox.css" rel="stylesheet">'
		],
		'Method':'$("a[rel=group]").fancybox();',
		'Fhtml':['<h4>图片集</h4>',
			'	<p>',
			'		<a rel="group" href="images/b1.jpg" title="图片标题"><img alt="" src="images/s1.gif" /></a>', 
			'		<a rel="group" href="images/b2.jpg" title="图片标题"><img alt="" src="images/s2.gif" /></a>',
			'		<a rel="group" href="images/b3.jpg" title="蓝天白云绿草"><img alt="" src="images/s3.gif" /></a>', 
			'</p>'
   		],
		'Href':'<a href="http://fancyapps.com/fancybox/" target="_blank">http://fancyapps.com/fancybox/</a><br/>'+
		'<a href="http://www.helloweba.com/view-blog-65.html" target="_blank">http://www.helloweba.com/view-blog-65.html<a>',
		'Property':[]
	}
}

	scfs=function(Cname){
		//输出插件名
		$("#Bt").html(Cname.name);
		//输出引用代码
		$("#dz").html(Cname.Href);
		var reg=new RegExp("<","g")
		var reg2=new RegExp(">","g")
		var mk=""
		$.each(Cname.Quote,function(key,value){
			mk+=value.replace(reg,"&lt;").replace(reg2,"&gt;")+'<br>'
		})
		$("#yy").html(mk)
		mk=""
		$.each(Cname.Fhtml,function(key,value){
			mk+=value.replace(reg,"&lt;").replace(reg2,"&gt;")+'<br>'
		})
		$("#gs").html(mk)
		//输出使用方法
		$("#ff").html(Cname.Method)
		//输出属性
		mk=""
		$.each(Cname.Property,function(key, value) {
			mk+="<tr>"
			$.each(value,function(k,v) {
		 	 mk+="<td>"+v+"</td>"
			})
			mk+="</tr>"
		});
		$("#nes").html(mk);
	}
	scfs(cjs['#simplyscroll'])
})