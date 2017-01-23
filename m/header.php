<?php 
include('inc/public.inc.php');
//获取网站配置
$sql="SELECT `key`,`value` FROM #@__config";
$db->Query('info_q',$sql);
while($info_a=$db->GetArray("info_q")){
	$info[$info_a['key']]=$info_a['value'];
}
$scriptname = basename($_SERVER['SCRIPT_NAME'],'.php');
$Agent = new Browser();
// if($Agent->Browser() == 'Windows'){
//   @header("Location:http://".$_SERVER['HTTP_HOST'].str_replace('/m','',$_SERVER['REQUEST_URI'])."");
// }
//$flash=$db->GetOne("SELECT * FROM #@__flash ORDER BY RAND() Limit 1");
?>
<!DOCTYPE html>
<html manifest='cache.manifest'><head>
<title><?php echo $info['web_name'];?></title>
<meta name="keywords" content="<?php echo $info['web_keywords']?>">
<meta name="description" content="<?php echo $info['web_description']?>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"  href="css/jquery.mobile.css"  />
<script src="js/jquery-1.8.2.min.js"></script>
<script src="js/jquery.mobile.js"></script>
<style type="text/css">
.mcontent img {
	width:100%;
}
.ui-icon-myapp-tel {
	background:url('images/tel.png') no-repeat;
	height:24px;
	width:24px;
}
.ui-icon-myapp-sms {
	background:url('images/sms.png') no-repeat;
	height:24px;
	width:24px
}
.ui-icon-myapp-msg {
	background:url('images/msg.png') no-repeat;
	height:24px;
	width:24px;
}
.ui-icon-myapp-contact {
	background:url('images/contact.png') no-repeat;
	height:24px;
	width:24px;
}
.jq_footer li a span {
	-webkit-box-shadow: none /*{global-icon-shadow}*/;
	box-shadow: none /*{global-icon-shadow}*/;
}
#container ul li{
	color:#575757;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 23px;
}
.p_name {
	color: #CC5522 !important;
	font-size: 20px;
	font-weight: bold;
	padding: 5px;
}
/*--------flash:GO--------------*/
    .flash { position: relative;}/*定位方式*/
    .flash img{width: 100%;}
    .flash ul {padding: 0; margin: 0; }
    .flash ul li {background-repeat:no-repeat;-o-background-size: 100% 100%;list-style: none; padding: 0; margin: 0;
-ms-background-size: 100% 100%;
-moz-background-size: 100% 100%;}
    .flash ul li img{width: 100%;}
    .flash ol{ position: absolute;bottom: 0px; width: 100%;text-align: center; background:rgba(0,0,0,0.5);height: 30px;padding:0;margin: 0;}
    .flash ol li{display: inline-block;background: #ccc;font-size: 0px;line-height: 16px;border-radius: 10px;height: 10px;width: 10px;margin: 10px 5px 10px; overflow: 0.8;}
    .flash .active{background: #fff;}
/*--------flash:END--------------*/
img{width: 100%;}
</style>
<script type="text/ecmascript">
	$("document").ready(function (){
		if(window.navigator.offline){
			alert('网络不在线，确定离线阅读？ ');	
		}
		})
function checkMobile(mobie,tel){ 
    var sMobile = mobie;
    if(!(/^1[3|5][0-9]\d{8}$/.test(sMobile))){ 
        if(confirm('短信功能暂不能使用，要打电话吗？')){
			window.location.href="tel:"+tel;		
		}
		return false;
    } 
}
function checkPhone(phone){  
	if (phone==""){    
		alert("电话号码不能为空！");     
		return false;    
	}    
return true;    
}   
</script>
<script type="text/javascript" src="./js/unslider.min.js"></script>
<script type="text/javascript">
$(function() {
   var slidey = $(".flash").unslider({
    dots: true,
    fluid: true
   }).css("height","auto"),
    data = slidey.data('unslider');
    var slides = $(".flash");
        slides.on('swipeleft', function(e) {
          data.next();
        })
        .on('swiperight', function(e) {
          data.prev();
        })
        .on('movestart', function(e) {
            if ((e.distX > e.distY && e.distX < -e.distY) ||
              (e.distX < e.distY && e.distX > -e.distY)) {
                e.preventDefault();
            }
        });
});
</script>
</head>
<body>
<div data-role="page">
<div data-role="header" data-theme="c">
	<h1><?php echo $info['web_name'];?></h1>
<!-- <a href="#morenav" class="ui-btn-right" data-icon="bars" data-iconpos="notext">更多</a> -->
	<?php if($info['logo']) {?><div><a href="index.php" data-ajax="false"><img src="./uploads/<?php echo $info['logo'];?>" width="100%" style="margin-bottom:5px;" /></a></div><?php }?>
	<div data-role="navbar">
		<ul>
		  <li><a href="index.php" <?php if($scriptname == 'index' || $scriptname=='') echo "class=\"ui-btn-active ui-state-persist\"";?> data-transition="none" data-ajax="false"><?php echo $nav[0];?></a></li>
		  <li><a href="companyInfo.php" <?php if($scriptname == 'companyInfo') echo "class=\"ui-btn-active ui-state-persist\"";?> data-transition="none" data-ajax="false"><?php echo $nav[1];?></a></li>
		  <li><a href="products.php" <?php if($scriptname == 'products' || $scriptname=='productInfo') echo "class=\"ui-btn-active ui-state-persist\"";?> data-transition="none" data-ajax="false"><?php echo $nav[2];?></a></li>
		  <li><a href="contact.php" data-ajax="false" <?php if($scriptname == 'contact') echo "class=\"ui-btn-active ui-state-persist\"";?> data-transition="none" data-ajax="false"><?php echo $nav[3];?></a></li>
		  </ul>
	</div>
<!--banner start-->
<?php if($scriptname == 'index' || $scriptname==''): ?>
<div class="flash">
	<ul>
    	<?php 
	$sql="SELECT * FROM `#@__flash` WHERE  `open`=1 LIMIT 2";
	$db->Query('banner',$sql);
	while($row=$db->GetArray("banner")) {
	?>
		<li><div><img src="./uploads/<?php echo $row['img']?>"></div></li>
	<?php } ?>
	</ul>
 </div>
<?php endif ?>
<!--banner stop -->
</div>
<!-- /header -->