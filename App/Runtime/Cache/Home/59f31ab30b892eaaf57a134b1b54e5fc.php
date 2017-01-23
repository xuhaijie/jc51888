<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
	<title><?php echo ($title); ?></title>
	
	<meta name="keywords" content="<?php echo ($web_keywords); ?>">
	<meta name="description" content="<?php echo ($web_description); ?>">
	<?php if($config["switch_mbaidu"] == '1'): ?><link rel="alternate" type="application/vnd.wap.xhtml+xml" media="handheld" href="http://<?php echo ($config["web_url"]); ?>/m/"/><?php endif; ?>
	<link rel="stylesheet" type="text/css" href="__TMPL__Public/js/bootstrap/css/bootstrap.min.css" />
	<script src="__TMPL__Public/js/jquery.js"></script>
	<script type="text/javascript" src="__TMPL__Public/js/jquery.jslides.js"></script>
	<link rel="stylesheet/less" type="text/css" href="__TMPL__Public/css/style.css">
	<link rel="stylesheet/less" type="text/css" href="__TMPL__Public/css/skrles.less">
	<script src="__TMPL__Public/css/less.js" type="text/javascript"></script>
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
<div class="wrap">
	<!--
<div id="qq_icon"></div>
<div id="cs_online">
    <ul class='qq_context'>
        <li>
        <span class='span_t'>在线客服01：</span>
        <span class='qq_num'></span>
        </li>
        <li>
        <span class='span_t'>在线客服02：</span>
        <span class='qq_num'></span>
        </li>
        <li>
        <span class='span_t'>在线客服03：</span>
        <span class='qq_num'></span>
        </li>
        <li>
        <span class='span_t'>在线客服04：</span>
        <span class='qq_num'></span>
        </li>
        <li>
        <span class='span_t'>在线客服05：</span>
        <span class='qq_num'></span>
        </li>
     </ul>
</div>
<link rel="stylesheet" href="__TMPL__Public/js/qq/css/lrtk.css" type="text/css"/>
<script type="text/javascript" src="__TMPL__Public/js/qq/js/cs_q.js"></script>
<script type="text/javascript">
	myEvent(window,'load',function(){
		dealy('qq_icon',1);						//1秒后显示QQ图标，默认为1秒，可自行设置
		settop('qq_icon','cs_online',150);		//设置在线客服的高度，默认150，可自行设置
		var span_q = getbyClass('cs_online','qq_num');
		setqq(span_q,['<?php echo ($config["kefu_qq"]["0"]["qq"]); ?>','<?php echo ($config["kefu_qq"]["1"]["qq"]); ?>','<?php echo ($config["kefu_qq"]["2"]["qq"]); ?>','<?php echo ($config["kefu_qq"]["2"]["qq"]); ?>','<?php echo ($config["kefu_qq"]["2"]["qq"]); ?>']);		//填写5个QQ号码
		click_fn('qq_icon','cs_online');
	});
</script>-->

<div class="header">
	<div class="tou">
	  <div class="tou-s">
	    <div class="tou-sz">欢迎来到<?php echo ($config['web_name']); ?>参观！</div>
		<div class="tou-sy"><a href="####" onclick="SetHome(this,'http://<?php echo ($_SERVER ['HTTP_HOST']); ?>')">设为首页</a>　｜　<a style="CURSOR: hand" onClick="AddFavorite('<?php echo ($title); ?>',location.href)" title="" href="####">加入收藏</a>　｜　<a href="__ROOT__/contact">联系我们</a></div>
	  </div>
	  <div class="tou-x"></div>
	</div>
		<div class="main">
<ul class="nav" id="Nav-1">
<?php function scnav($str,$a=1) { $att=""; if($str['cun']){ $att=$a>1?'<ul style="top:-7px;left:106px;" class="dropdown-menu">':'<ul class="dropdown-menu">'; foreach ($str['cun'] as $k =>$v) { $v["url"]=curl($v["url"]); $hlz=scnav($v,$a+1); $att.="<li id='$v[tid]' class='dropdown $v[css]'><a $v[url]>$v[name]</a>"; $att.=$hlz; $att.='</li>'; } $att.='</ul>'; } return $att; } function curl($url){ if(stristr($url,"http://")){ return "href='$url' target='_blank'"; }else{ return "href='__ROOT__/$url'"; } } $att=''; foreach ($fnav as $k => $v) { $v["url"]=curl($v["url"]); $hlz=scnav($v); $att.="<li id='$v[tid]' class='dropdown $v[css]'><a $v[url]>$v[name]</a>"; $att.=$hlz; $att.='</li>'; } echo($att); ?>

		
</ul>
	</div> 
	

	<div class="tou-k">
<div id="full-screen-slider">
	<ul id="slides">
	<?php if(is_array($flash)): $i = 0; $__LIST__ = $flash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="background:url('__ROOT__/__UPLOAD__/<?php echo ($vo["img"]); ?>') no-repeat 50% 0;"><a href="<?php echo ($vo["link"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>
	</div>
	<div class="tou-d">
	  <div class="tou-dz"><strong>热门关键词：</strong><?php echo ($config['web_keywords']); ?></div>
	  <div class="tou-dy">
<form action="__ROOT__/product/sousuo" >
  <input type="text" name="key" class="anniu">
  <button type="submit" class="btn">搜索</button>
</form>
	  </div>
	</div>
	<div class="clear2"></div>
</div>
	<div class="main" id="Cpzs">
		<div class="main2">
<script language="JavaScript">					
var flag=false;
function AXImgaa(ximg){
var image=new Image();
var iwidth = 500; //图片宽度
var iheight = 373; //图片高度
image.src=ximg.src;
if(image.width>0 && image.height>0){
flag=true;
if(image.width/image.height>= iwidth/iheight){
if(image.width>iwidth){ 
ximg.width=iwidth;
ximg.height=(image.height*iwidth)/image.width;
}else{
ximg.width=image.width; 
ximg.height=image.height;
}
ximg.alt=image.width+"×"+image.height;
}
else{
if(image.height>iheight){ 
ximg.height=iheight;
ximg.width=(image.width*iheight)/image.height; 
}else{
ximg.width=image.width; 
ximg.height=image.height;
}
ximg.alt=image.width+"×"+image.height;
}
}
}

</script>
		  <div class="neiye">
		    <div class="neiye-z">
			  <div class="neiye-zimg"><a target="_blank" href="__ROOT__/__UPLOAD__/<?php echo ($list['img']); ?>"><img src="__ROOT__/__UPLOAD__/<?php echo ($list['img']); ?>" alt="<?php echo ($list['title']); ?>" onload="AXImgaa(this)"/></a></div>
			</div>
			<div class="neiye-y">
			  <div class="neiye-yt"><span style="font-size:14px;">产品：</span><strong><?php echo ($list['title']); ?></strong></div>
			  <div class="neiye-yk">
			  分类：<?php echo ($list[pid][name]?$list[pid][name]:$lid[title]); ?><br/>
			  联系人：<?php echo ($config['linkman']); ?><br/>
			  联系热线：<?php echo ($config['mobile']); ?>
			  </div>
			  <div class="neiye-yd">
			  <?php if(is_array($config["kefu_qq"])): $i = 0; $__LIST__ = array_slice($config["kefu_qq"],0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($vo["qq"]); ?>&site=qq&menu=yes"><img src="../Public/images/zx.jpg" width="185" height="52" /></a><?php endforeach; endif; else: echo "" ;endif; ?>
			  </div>
			  <div class="neiye-yx"><div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script></div>
			</div>
		  </div>
		  <div class="neiyex">
		    <div id="Mleft">
		    	<div class="zuob">
  <div class="zuobt">产品分类</div>
  <div class="zuobk">
  <?php if(is_array($type[0][son])): $i = 0; $__LIST__ = $type[0][son];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="zuobk-klie"><a href="__ROOT__/product/type/<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
  <div class="zuob1t">联系方式</div>
  <div class="zuob1k">
<?php echo ($config['web_name']); ?><br/>
联系人：<?php echo ($config['linkman']); ?><br/>
手机：<?php echo ($config['mobile']); ?><br/>
电话：<?php echo ($config['tel']); ?><br/>
传真：<?php echo ($config['fax']); ?><br/>
邮箱：<a href="mailto:<?php echo ($config['email']); ?>" target="_blank"><?php echo ($config['email']); ?></a><br/>
地址：<?php echo ($config['address']); ?>
  </div>
</div>
<script type="text/javascript">
  $(function(){
	//$(".category div a:first").addClass("CurrentMenu");  
    $(".zuobk-klie a").each(function(){
		//alert($(this).attr('href'))
		//alert(location.pathname)
		// 
       if(location.pathname==$(this).attr('href'))
       {
       $(".zuobk-klie a").removeClass("currentmenu")
        $(this).addClass("currentmenu")
       }
    });
	 $(".zuobk-klie a").each(function(){
	   //alert($(this).attr('href'))	 
	   if(location.pathname==$(this).attr('href'))
       {
       $(".zuobk-klie a").removeClass("currentmenu")
        $(this).addClass("currentmenu")
       }
	 });
	//$(".category")
  });
</script>
			</div>
		    <div id="Mright">
		       	<div class="article info-1">
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
		<?php if($lid.title): ?><div class="title"><h4><?php echo ($list[pid][name]?$list[pid][name]:$lid[title]); ?><span>About Us</span></h4><span class="right"><a href="__ROOT__/">首页</a> &gt;<?php echo ($list[pid][name]?$list[pid][name]:$lid[title]); ?></span>
			</div>
		<?php else: ?>
			<div class="title"><h4>新闻中心<span>News</span></h4><span class="right"><a href="__ROOT__/">首页</a> &gt; 新闻中心</span>
			</div><?php endif; break;?>
	<?php case "Order": ?><!-- 订单 -->
		<div class="title"><h4>在线订单<span>Order</span></h4><span class="right"><a href="__ROOT__/">首页</a>&nbsp;>&nbsp;在线订单</span></div><?php break;?>
	<?php case "Cart": ?><!-- 购物车 -->
		<div class="title"><h4>购物车<span>Products</span></h4><span class="right"><a href="__ROOT__/">首页</a>&nbsp;>&nbsp;购物车</span></div><?php break;?>
	<?php case "Product": ?><!-- 产品 -->
		<?php if($lid.title): ?><div class="title"><h4><?php if($lid): echo ($list[pid][name]?$list[pid][name]:$lid[title]); else: ?>产品展示<?php endif; ?><span>Product</span></h4><span class="right"><a href="__ROOT__/">首页</a> &gt; <?php if($lid): echo ($list[pid][name]?$list[pid][name]:$lid[title]); else: ?>产品展示<?php endif; ?></span></div>
		<?php else: ?>
			<div class="title"><h4>产品展示<span>Product</span></h4><span class="right"><a href="__ROOT__/">首页</a> &gt; 产品展示</span></div><?php endif; break;?>
	<?php default: endswitch;?>
			        <div class="block-1">
				        <div class="adc">
				            <div class="content"><?php echo ($list['content']); ?></div>
				            <div class="pn alert alert-info">
	<?php if($pre): ?><div class="pn-left">
			<a aria-hidden="true" class="ipage" title="<?php echo ($pre["title"]); ?>" href="__ROOT__/<?php echo MODULE_NAME=='News'?'news':'product'; ?>/<?php echo ($pre["id"]); ?>#Mright" >
				<b data-icon="&#xf489;"></b>
				<span><?php echo ($pre["title"]); ?></span>
			</a>
		</div><?php endif; ?>
	<?php if($next): ?><div class="pn-right"><a aria-hidden="true" class="inext" title="<?php echo ($next["title"]); ?>" href="__ROOT__/<?php echo MODULE_NAME=='News'?'news':'product'; ?>/<?php echo ($next["id"]); ?>#Mright" ><b data-icon="&#xf488;"></b><span><?php echo ($next["title"]); ?></span></a></div><?php endif; ?>
	<div class="clear2"></div>
</div>

				        </div>
			        </div>
			    </div>
	   		</div>
	   		<div class="clear2"></div>
	   	</div>
		<div class="clear2"></div>
		</div>
	</div>
	<div class="footer">
  <div class="dibu">
  <a href="__ROOT__/####">网页首页</a>　｜　<a href="__ROOT__/####">公司简介</a>　｜　<a href="__ROOT__/####">产品中心</a>　｜　<a href="__ROOT__/####">新闻中心</a>　｜　<a href="__ROOT__/####">在线订单</a>　｜　<a href="__ROOT__/####">人才招聘</a>　｜　<a href="__ROOT__/####">销售网络</a>　｜　<a href="__ROOT__/####">在线留言</a>　｜　<a href="__ROOT__/####">联系我们</a><br/>
  版权所有：<?php echo ($config['web_name']); ?>　联系人：<?php echo ($config['linkman']); ?>　手机：<?php echo ($config['mobile']); ?>　地址：<?php echo ($config['address']); ?><br/>
  网页设计：<a href="http://www.jishicn.com/" target="_blank">激石信息技术</a>　<a href="__ROOT__/Sitemap">网站地图</a>　<a href="__ROOT__/admin" target="_blank">【后台管理】</a>
  </div>
</div>
<script type="text/javascript" src="__TMPL__Public/js/unslider/unslider.min.js"></script>
<script type="text/javascript" src="__TMPL__Public/js/Marquee/Marquee.js"></script>
<script type="text/javascript" src="__TMPL__Public/js/js.js"></script>
<?php echo ($liuliangbao); ?>
</div>
</body>

</html>