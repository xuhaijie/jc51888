<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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





	<div id="pjax">
		<div class="wrap">
				<div class="main">
					<div class="main2">
							<div id="Mleft">
								<div class="container_left">
    <div class="class_neiye">
        <h3>产品类别</h3>
        <div class="class_nr">
            <ul>
                <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(is_array($vo["son"])): $i = 0; $__LIST__ = $vo["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><li class="li2"><a href="__APP__/product/type/<?php echo ($vo1["id"]); ?>"><?php echo ($vo1["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <img src="../Public/images/kefu.jpg" style="margin: 10px auto;display: block;;">
            <h4>联系我们</h4>
            <p class="contact_p"><?php echo ($config['mobile']); ?></p>
        </div>
    </div>
</div>

							</div>
						   <div id="Mright">
						<div class="article">
							<?php switch(MODULE_NAME): case "Company": ?><!-- 关于我们 -->
		<div class="title"><h4>关于我们<span>Company</span></h4><span class="right"><a href="__ROOT__/">首页</a>&nbsp;>&nbsp;关于我们</span></div><?php break;?>

	<?php case "Contact": ?><!-- 联系我们 -->
		<div class="title"><h4>联系我们<span>Contact</span></h4><span class="right f12"><a href="__ROOT__/">首页</a>&nbsp;>&nbsp;联系我们</span></div><?php break;?>
	<?php case "Custom": ?><!-- 单页 -->
		<?php if($category): ?><div class="title"><h4><?php echo ($category); ?><span>About Us</span></h4><span class="right f12"><a href="__ROOT__/">首页</a>&nbsp;>&nbsp;<?php echo ($category); ?></span></div>
		<?php else: ?>
			<div class="title"><h4><?php echo ($article['title']); ?><span>About Us</span></h4><span class="right"><a href="__ROOT__/">首页</a>&nbsp;>&nbsp;<?php echo ($article['title']); ?></span>
			</div><?php endif; break;?>
	<?php case "Jobs": ?><!-- 招聘 -->
		<div class="title"><h4>人才招聘<span>Jobs</span></h4><span class="right f12"><a href="__ROOT__/">首页</a>&nbsp;>&nbsp;人才招聘</span></div><?php break;?>
	<?php case "Message": ?><!-- 在线留言 -->
		<div class="title"><h4>在线留言<span>Message</span></h4><span class="right f12"><a href="__ROOT__/">首页</a>&nbsp;>&nbsp;在线留言</span></div><?php break;?>

	<?php case "News": ?><!-- 新闻 -->
		<?php if($lid.title): ?><div class="title"><h4><?php echo ($list['pid']['name']?$list['pid']['name']:$lid['title']); ?><span>About Us</span></h4><span class="right"><a href="__ROOT__/">首页</a> &gt;<?php echo ($list['pid']['name']?$list['pid']['name']:$lid['title']); ?></span>
			</div>
		<?php else: ?>
			<div class="title"><h4><?php echo ($list['pid']['name']?$list['pid']['name']:$lid['title']); ?><span>News</span></h4><span class="right"><a href="__ROOT__/">首页</a> &gt; <?php echo ($list['pid']['name']?$list['pid']['name']:$lid['title']); ?></span>
			</div><?php endif; break;?>
	<?php case "Order": ?><!-- 订单 -->
		<div class="title"><h4>在线订单<span>Order</span></h4><span class="right"><a href="__ROOT__/">首页</a>&nbsp;>&nbsp;在线订单</span></div><?php break;?>
	<?php case "Cart": ?><!-- 购物车 -->
		<div class="title"><h4>购物车<span>Products</span></h4><span class="right"><a href="__ROOT__/">首页</a>&nbsp;>&nbsp;购物车</span></div><?php break;?>
	<?php case "Product": ?><!-- 产品 -->
		<?php if($lid.title): ?><div class="title"><h4><?php if($lid): echo ($lid["title"]); else: echo ($list['pid']['name']?$list['pid']['name']:$lid['title']); endif; ?><span>Product</span></h4><span class="right"><a href="__ROOT__/">首页</a> &gt; <?php if($lid): echo ($lid["title"]); else: echo ($list['pid']['name']?$list['pid']['name']:$lid['title']); endif; ?></span></div>
		<?php else: ?>
			<div class="title"><h4><?php echo ($list['pid']['name']?$list['pid']['name']:$lid['title']); ?><span>Product</span></h4><span class="right"><a href="__ROOT__/">首页</a> &gt; <?php echo ($list['pid']['name']?$list['pid']['name']:$lid['title']); ?></span></div><?php endif; break;?>
	<?php default: endswitch;?>
							<div class="right_main">
								<?php if($list): ?><ul class="news_list">
										<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span style="float:left"><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a></span><span style="float:right"><?php echo ($vo["time"]); ?> </span>
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
							  <div class="page">
								  <?php echo ($page); ?>
							  </div>
							 <?php else: ?>
										<div class="alert alert-error" style="text-align:center;width: 80%;margin: 0 auto;">暂无新闻...</div><?php endif; ?>
							</div>
						</div>
					</div>
					<div class="clear2"></div>
				</div>
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