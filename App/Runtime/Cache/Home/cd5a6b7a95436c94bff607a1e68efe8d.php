<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<!--
            __     __
           /  \~~~/  \                                                                       |      金华激石信息技术有限公司      |
     ,----(     ..    )
    /      \__     __/
   /|         (\  |(
  ^ \   /___\  /\ |
     |__|   |__|-"
-->
<html>
<head>
	
<meta charset="UTF-8">
	<title><?php echo ($title); ?></title>
<base href="__APP__/">
	<meta name="keywords" content="<?php echo ($web_keywords); ?>">
	<meta name="description" content="<?php echo ($web_description); ?>">
	<meta http-equiv="x-ua-compatible" content="ie-edge,chrome=1"><!--//低版本IE支持CSS3属性-->
	<?php if($config["switch_mbaidu"] == '1'): ?><link rel="alternate" type="application/vnd.wap.xhtml+xml" media="handheld" href="http://<?php echo ($config["web_url"]); ?>/m/"/><?php endif; ?>
	<script src="__TMPL__Public/js/jquery1.8.js"></script>
	<script src="__TMPL__Public/js/pic.js"></script>
	<link rel="stylesheet/less" type="text/css" href="__TMPL__Public/css/style.css">
	<link rel="stylesheet/less" type="text/css" href="__TMPL__Public/css/animate.min.css">
	<!--[if lte IE 7]><script src="__TMPL__Public/css/lte-ie7.js"></script><![endif]-->
	<!-- <link rel="stylesheet" href="__TMPL__Public/Css/skrles.css?v=<?php echo time(); ?>"> -->
	<link rel="stylesheet/less" type="text/css" href="__TMPL__Public/css/skrles.less">
	<script src="__TMPL__Public/css/less.js" type="text/javascript"></script>
	<script src="__TMPL__Public/js/sky.js" type="text/javascript"></script>
    <script src="__TMPL__Public/js/wow.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="__TMPL__Public/js/selectivizr.js"></script><!--//低版本IE支持CSS3属性-->
<script type="text/javascript" src="__TMPL__Public/js/superslide.2.1.js"></script><!--//大图效果-->
<script>
	document.createElement("section");
	document.createElement("article");
	document.createElement("footer");
	document.createElement("header");
	document.createElement("hgroup");
	document.createElement("nav");
	document.createElement("menu");
</script>
<script>
    if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
        new WOW().init();
    };
</script>


	<script>
		$(function() {
			var $nav=$("#Nav-1"),
				$lido=$(".<?php echo ($lid['name']); echo ($lid['id2']); ?>"),
				$sfl=$("#S-fl");
				$yido=$("#Nav-1").find('>li').eq(<?php echo ($yid); ?>);
			$yido.addClass("lon");
			gezong($yido,$nav);

			if($lido){
				$lido.addClass("lon");
				gezong($lido,$sfl);
			}
			
			function gezong ($a,$b) {
				$b.find(">li").hover(function(){
					var $this=$(this);
						$a.removeClass("lon");
						$this.addClass("lon");
				},function(){
					var $this=$(this);
						$this.removeClass("lon");
						$a.addClass("lon");
				});
			}
		});
	</script>
<?php echo ($config["code_head"]); ?>



</head>
<body>

<div class="header">
	<div class="top">
			<a href="__ROOT__/" titile="<?php echo ($config['name']); ?>">
				<img  src="__ROOT__/__UPLOAD__/<?php echo ($config['logo']); ?>" alt="Logo" class="logo wow zoomInLeft">
			</a>
		<img src="../Public/images/tel.png" style="float: right;margin-top: 28px;">
	</div>
	<div class="header_nav_k">
		<div class="header_nav">
			<ul class="nav" id="Nav-1">
				<?php function scnav($str,$a=1) { $att=""; if($str['cun']){ $att=$a>1?'<ul style="top:-7px;left:106px;" class="dropdown-menu">':'<ul class="dropdown-menu">'; foreach ($str['cun'] as $k => $v) { $hlz=scnav($v,$a+1); $att.=sprintf('<li id="%s" class="dropdown"><a href="__ROOT__/%s">%s</a>',$v['tid'],$v['url'],$hlz?$v['name']:$v['name']); $att.=$hlz; $att.='</li>'; } $att.='</ul>'; } return $att; } $att=''; foreach ($fnav as $k => $v) { $nav_arr= explode(',',$v['name']) ; $hlz=scnav($v); $att.=sprintf('<li id="%s" class="dropdown"><a href="__ROOT__/%s">%s<br /><font class="en">%s</font></a>',$v['tid'],$v['url'],$nav_arr[0],$nav_arr[1]); $att.=$hlz; $att.='</li>'; } echo($att); ?>
			</ul>
		</div>
	</div>
</div>
<div class="clear2"></div>

<div class="banner">
    <div id="KinSlideshow" >
        <ul>
            <?php if(is_array($flash)): $i = 0; $__LIST__ = $flash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="background:url('__ROOT__/__UPLOAD__/<?php echo ($vo["img"]); ?>') no-repeat 50% 0;"><a href="<?php echo ($vo["link"]); ?>"  alt="<?php echo ($vo["title"]); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>





<div class="search_bg">
	<div class="main">
		<div class="search">
        <span><strong>关键词：</strong>顶级奢华甲级别墅大门系列、2017新款别墅大门、精品不锈钢门
</span>
			<form id="form1" name="form1" method="get" action="__ROOT__/product/sousuo">
				<input name="key" value="" placeholder="请输入关键词" class="text">
				<input type="submit" name="Submit" value="" class="anan" />
			</form>
		</div>
	</div>
</div>

<div class="youshi">
	<div class="main">
		<div class="youshi-dh"></div>
		<div class="youshi-nr">
			<div class="youshi1 youshi0 wow fadeInUp" >
				<p class="wow bounceInRight" >公司现有生产员工217名,管理人员35名;</p>
				<p class="wow bounceInRight" data-wow-delay=".2s">	凯雷德人一步一个脚印，稳步前进；</p>
				<p class="wow bounceInRight" data-wow-delay=".4s">	加盟门店众多;</p>
				<p class="wow bounceInRight" data-wow-delay=".6s">	已达到年产不锈钢门3万樘，锌钛合金门5万樘的规模；</p>
			</div>
			<div class="youshi2 youshi0 wow fadeInLeft">
				<p class="wow bounceInUp">引进先进的生产管理技术;</p>
				<p class="wow bounceInUp" data-wow-delay=".2s">	先进的加工设备和激光焊接设备;</p>
				<p class="wow bounceInUp" data-wow-delay=".4s">	共占地2万余平方米，资产6700多万;</p>
				<p class="wow bounceInUp" data-wow-delay=".6s">	在制造工艺上博采众长、自主创新；</p>
			</div>
			<div class="youshi3 youshi0 wow fadeInRight">
				<p class="wow bounceInRight">公司获得多项国家专利;</p>
				<p class="wow bounceInRight" data-wow-delay=".2s">在同行业中率先通过了ISO9001:2000质量认证；</p>
				<p class="wow bounceInRight" data-wow-delay=".4s">	公司先后获得中国驰名商标；</p>
				<p class="wow bounceInRight" data-wow-delay=".6s">中国门业十大品牌等荣誉；</p>
			</div>
		</div>
	</div>
</div>
<div class="tab">
	<div class="main">
		<ul class="tab-dh">
			<li class="btn-1">
				<p>01</p>
				<span>密码锁加猫眼</span>
			</li>
			<li class="btn-1">
				<p>02</p>
				<span>凯雷德甲级钢印</span>
			</li>
			<li class="btn-1">
				<p>03</p>
				<span>超级四维霸王金刚锁</span>
			</li>
			<li class="btn-1">
				<p>04</p>
				<span>独特防爆工艺铰链</span>
			</li>
			<li class="btn-1">
				<p>05</p>
				<span>独特工艺包装</span>
			</li>
			<li class="btn-1">
				<p>06</p>
				<span>人性化照明钥匙</span>
			</li>
		</ul>
		<div class="tab-nr">
			<ul>
				<li class="t1"></li>
				<li class="t2"></li>
				<li class="t3"></li>
				<li class="t4"></li>
				<li class="t5"></li>
				<li class="t6"></li>
			</ul>
		</div>
	</div>
</div>
<div class="product">
	<div class="product-dh"></div>
	<div class="main">
		<div class="class wow bounceInLeft">
			<ul>
				<li class="btn-span-14-1 btn-span-20" ><span data-hover="精钢甲级别墅大门">精钢甲级别墅大门</span><i>&gt;</i></li>
				<li class="btn-span-14-1 btn-span-20" ><span data-hover="精品304不锈钢大门">精品304不锈钢大门</span><i>&gt;</i></li>
				<li class="btn-span-14-1 btn-span-20" ><span data-hover="国标甲级防盗门">国标甲级防盗门</span><i>&gt;</i></li>
				<li class="btn-span-14-1 btn-span-20" ><span data-hover="豪华纳米铜门">豪华纳米铜门</span><i>&gt;</i></li>
			</ul>
		</div>
		<div class="product-nr wow bounceInRight">
			<ul>
				<li>
					<?php if(is_array($jingpin)): $i = 0; $__LIST__ = array_slice($jingpin,0,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="picture">
							<div class="picture1">
								<a href="__APP__/product/<?php echo ($vo["id"]); ?>" target="_blank"><img src="__ROOT__/__UPLOAD__/im_<?php echo ($vo["img"]); ?>" alt="<?php echo ($vo["title"]); ?>" onload="AXImg(this,295,295)"/></a>
							</div>
							<div class="picture2">
								<a href="__APP__/product/<?php echo ($vo["id"]); ?>" target="_blank"><?php echo (mb_substr($vo["title"],0,20,'utf-8')); ?></a>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</li>
				<li>
					<?php if(is_array($buxiugang)): $i = 0; $__LIST__ = array_slice($buxiugang,0,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="picture">
							<div class="picture1">
								<a href="__APP__/product/<?php echo ($vo["id"]); ?>" target="_blank"><img src="__ROOT__/__UPLOAD__/im_<?php echo ($vo["img"]); ?>" alt="<?php echo ($vo["title"]); ?>" onload="AXImg(this,295,295)"/></a>
							</div>
							<div class="picture2">
								<a href="__APP__/product/<?php echo ($vo["id"]); ?>" target="_blank"><?php echo (mb_substr($vo["title"],0,20,'utf-8')); ?></a>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</li>
				<li>
					<?php if(is_array($guobiao)): $i = 0; $__LIST__ = array_slice($guobiao,0,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="picture">
							<div class="picture1">
								<a href="__APP__/product/<?php echo ($vo["id"]); ?>" target="_blank"><img src="__ROOT__/__UPLOAD__/im_<?php echo ($vo["img"]); ?>" alt="<?php echo ($vo["title"]); ?>" onload="AXImg(this,295,295)"/></a>
							</div>
							<div class="picture2">
								<a href="__APP__/product/<?php echo ($vo["id"]); ?>" target="_blank"><?php echo (mb_substr($vo["title"],0,20,'utf-8')); ?></a>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</li>
				<li>
					<?php if(is_array($haohua)): $i = 0; $__LIST__ = array_slice($haohua,0,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="picture">
							<div class="picture1">
								<a href="__APP__/product/<?php echo ($vo["id"]); ?>" target="_blank"><img src="__ROOT__/__UPLOAD__/im_<?php echo ($vo["img"]); ?>" alt="<?php echo ($vo["title"]); ?>" onload="AXImg(this,295,295)"/></a>
							</div>
							<div class="picture2">
								<a href="__APP__/product/<?php echo ($vo["id"]); ?>" target="_blank"><?php echo (mb_substr($vo["title"],0,20,'utf-8')); ?></a>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</li>
			</ul>
		</div>
		<div class="clear2"></div>
		<a href="product/type/6" class="more btn-span-20"><span data-hover="了解更多">了解更多</span></a>
	</div>
</div>
<div class="main">
	<div class="about">
		<div class="about-dh"></div>
		<div class="about-nr wow fadeIn" data-wow-delay=".4s">
			<img src="__ROOT__/__UPLOAD__/<?php echo ($intro[img]); ?>"/>
			<p><?php echo (msubstr($intro['description'],0,200,'utf-8',true)); ?></p>
			<a href="company" class="more btn-span-20"><span data-hover="了解更多">了解更多</span></a>
		</div>
	</div>
</div>
<div class="honor wow fadeInUp" data-wow-delay=".4s">
	<div class="main">
		<div class="honor-dh">
			<p><?php echo ($config['standby1']); ?></p>
		</div>
		<div class="case_nr">
			<div class="bodyCon08"><!--学员-->
				<div class="students">
					<div id="four_flash">
						<div class="flashBg">
							<ul class="mobile">
								<?php if(is_array($honor)): $i = 0; $__LIST__ = array_slice($honor,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
										<div class="picc">
											<div class="picc1"><a href="__APP__/product/<?php echo ($vo["id"]); ?>" target="_blank"><img src="__ROOT__/__UPLOAD__/in_<?php echo ($vo["img"]); ?>" alt="<?php echo ($vo["title"]); ?>" onload="AXImg(this,202,202)"/></a></div>
										</div>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
						<div class="but_right"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="main">
	<div class="factory">
		<div class="factory-dh"></div>
		<div class="factory-nr">
			<div id="dem" style=" width:100%; overflow:hidden;">
				<table align=left cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td id="dem1" valign=top ><div style="width:2440px; ">
							<?php if(is_array($factory)): $i = 0; $__LIST__ = array_slice($factory,0,8,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="picture">
									<div class="picture"> <a href="__APP__/product/<?php echo ($vo["id"]); ?>" target="_blank"><img src="__ROOT__/__UPLOAD__/in_<?php echo ($vo["img"]); ?>" alt="<?php echo ($vo["title"]); ?>" onload="AXImg(this,295,295)"/></a></div>
									</div><?php endforeach; endif; else: echo "" ;endif; ?></div>
						</td>
						<td id="dem2" valign=top></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<a href="product/type/27" class="more btn-span-20"><span data-hover="了解更多">了解更多</span></a>
</div>

<div class="news">
	<div class="main">
		<div class="news-dh"></div>
		<div class="news-nr wow fadeInUp" data-wow-delay=".4s">
			<div class="news-left">
				<?php if(is_array($news)): $i = 0; $__LIST__ = array_slice($news,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><img src="../Public/images/news-img.jpg">
					<a href="__APP__/news/<?php echo ($vo["id"]); ?>">
						<p><?php echo ($vo["title"]); ?></p>
						<span><?php echo (mb_substr($vo["description"],0,80,'utf-8')); ?>...</span>
					</a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="new-right">
				<?php if(is_array($news)): $i = 0; $__LIST__ = array_slice($news,1,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="__APP__/news/<?php echo ($vo["id"]); ?>">
						<div class="time">
							<div><?php echo (mb_substr($vo["time"],8,2,'utf-8')); ?></div>
							<span><?php echo (mb_substr($vo["time"],0,4,'utf-8')); ?>/<?php echo (mb_substr($vo["time"],5,2,'utf-8')); ?></span>
						</div>
						<p><?php echo ($vo["title"]); ?></p>
					</a><?php endforeach; endif; else: echo "" ;endif; ?>
				<a href="news/type/4" class="more1"></a>
			</div>
			<div class="clear2"></div>
		</div>
	</div>
</div>

<div class="footer">
    <div class="dibu1">
        <div class="dibu1-k">
            <?php if(is_array($link)): $i = 0; $__LIST__ = array_slice($link,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["www"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="dibu1-x">
            <div class="dibu1-xl"></div>
            <div class="dibu1-xz">
                联系人：<?php echo ($config['linkman']); ?>　  电话：<?php echo ($config['tel']); ?>    400 :<?php echo ($config['standby1']); ?>　<br/>
                销售顾问：<?php echo ($config['mobile']); ?>    　传真：<?php echo ($config['fax']); ?><br/>
                地址：<?php echo ($config['address']); ?>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        版权所有：<?php echo ($config['web_name']); ?>
        网页设计：<a href="http://www.jishicn.com/" target="_blank">激石信息技术</a>　<a href="__ROOT__/Sitemap">网站地图</a>　<a href="__ROOT__/admin" target="_blank">【后台管理】</a><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1261170246'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1261170246%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
    </div>
</div>
<script type="text/javascript" src="__TMPL__Public/js/unslider/unslider.min.js"></script><!--大图滚动效果-->
<script type="text/javascript" src="__TMPL__Public/js/Marquee/Marquee.js"></script><!--大图滚动效果-->
<script type="text/javascript" src="__TMPL__Public/js/js.js"></script>

<!--图标左右切换效果- <i class = "btn-i-1"></i>----->
<script>
    $(function(){
        $(".btn-i-1").each(function(){
            $(this).wrap("<div class='btn1'><div class='btn2'></div></div>");
            var btnI = $(this).clone();
            $(this).parent().append(btnI);
            var btnMarginTop = $(this).css("margin-top");
            var btnWidth = $(this).width();
            var btnHeight = $(this).height();
            $(this).css({display:"block",position:"absolute",left:0,margin:0,padding:0,});
            $(this).next(".btn-i-1").css({display:"block",position:"absolute",margin:0,padding:0,left:btnWidth});
            $(this).parents(".btn1").css({width:btnWidth,height:btnHeight,overflow:"hidden",margin:"0 auto",marginTop:btnMarginTop});
            $(this).parent(".btn2").css({position: "relative",left:0});
            $(this).parents(".btn1").hover(function() {
                $(this).find(".btn2").stop().animate({left: -btnWidth});
            },function(){
                $(this).find(".btn2").stop().animate({left:0});
            })
        })
    })
</script><?php echo ($liuliangbao); ?>




</body>
</html>
<script>
	$(function(){
		$(".tab-dh li").click(function(){
			var num =$(this).index();
			var goLeft =num*1200+"px";
			$(".tab-nr ul").animate({left:"-"+ goLeft})
		});
	})
</script>
<script>
	$(function(){
		$(".class li").click(function(){
			var num =$(this).index();
			var goLeft =num*610+"px";
			$(".product-nr ul").animate({top:"-"+ goLeft})
		});
	})
</script>

<script type="text/javascript">
	//学员
	var _index5=0;
	$("#four_flash .but_right").click(function(){
		_index5++;
		var len=$(".flashBg ul.mobile li").length;
		if(_index5+5>len){
			$("#four_flash .flashBg ul.mobile").stop().append($("ul.mobile").html());
		}
		$("#four_flash .flashBg ul.mobile").stop().animate({left:-_index5*212},1000);
	});
</script>

<script language="javascript">
	var speed=30;
	var dem=document.getElementById('dem');
	var dem1=document.getElementById('dem1');
	var dem2=document.getElementById('dem2');
	dem2.innerHTML=dem1.innerHTML;
	function Marquee(){
		if(dem2.offsetWidth-dem.scrollLeft<=0)
		{
			dem.scrollLeft-=dem1.offsetWidth;
		}
		else
		{dem.scrollLeft++;}
	}
	var MyMar=setInterval(Marquee,speed);
	dem.onmouseover=function(){
		clearInterval(MyMar)
	}
	dem.onmouseout=function(){
		MyMar=setInterval(Marquee,speed)
	}

</script>