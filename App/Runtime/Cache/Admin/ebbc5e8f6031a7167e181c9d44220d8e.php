<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
	<title>青峰网络智美云网站系统</title>
   <link rel="stylesheet" type="text/css" href="../Public/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="../Public/css/base.css" />
	<script type="text/javascript" src="../Public/js/jquery.js"></script>
	<script type="text/javascript" src="../Public/js/common.js"></script>
	<script type="text/javascript" src="../Public/js/sprintf.js"></script>
	<!--[if IE 6]>
	<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
	<?php if($ie < 9): ?><link rel="stylesheet" type="text/css" href="../Public/css/skk.css" />
	<?php else: ?>
		<link rel="stylesheet/less" type="text/css" href="../Public/css/skk.less">
		<script type="text/javascript" src="../Public/css/less.js"></script><?php endif; ?>
	<script type="text/javascript" src="../Public/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="../Public/js/fancybox/jquery.fancybox-1.3.4.css" />
<script>
var url = "__ROOT__";
var type = "<?php echo (MODULE_NAME); ?>";
window.UEDITOR_HOME_URL="__PUBLIC__/ueditor/";
</script>
</head>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&ak=7a54f3352a3e48988b60b2a87bee1920&services=true"></script>
<body class="main">
 	<div class="subTit">
                <div class="tit">
                    <a href="javascript:;">系统</a>&gt;<a href="javascript:;">系统设置</a>
                </div>
            </div>
            <div class="content">
                <div class="formMod">
                     <div class="tit"><a href="__GROUP__/System/Index/t/1" >基础设置 </a><a href="__GROUP__/System/Index/t/4">高级设置</a><a href="__GROUP__/System/Index/t/3" class='current'>地图设置</a></div>
                    <form action="" method="post"  enctype="multipart/form-data">
                        <ul>
                            <li>
                                <div class="item_cont">
                                <div style="width:700px;height:450px;border:#ccc solid 1px;" id="TerenceMap"></div>	
			<script type="text/javascript">
			var map = new BMap.Map("TerenceMap"); 
			var Xpoint=<?php echo ($Xpoint); ?>;
	        var Ypoint=<?php echo ($Ypoint); ?>;
			var point = new BMap.Point(Xpoint, Ypoint);
			map.centerAndZoom(point, 14);  
			map.addControl(new BMap.NavigationControl());
			map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
	        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
	        map.disableDoubleClickZoom(); 
	        map.enableKeyboard();//启用键盘上下左右键移动地图
	        var marker = new BMap.Marker(point); 
	        map.addOverlay(marker);
			map.addEventListener("click", function(e){
				document.getElementById("x").value = e.point.lng;
				document.getElementById("y").value = e.point.lat;
	            map.removeOverlay(marker);
	            marker = new BMap.Marker(new BMap.Point(e.point.lng,e.point.lat));
	            map.addOverlay(marker);
			}); 
			</script>
                                <div style="color:red; margin-top:20px;">注意：1.单击地图获取新坐标点 2.支持图滚轮放大缩小</div>
                                </div>
                            </li>
                            <li>
                                <label for="title">百度X坐标：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt required" id="x" name="baidu_map_x" size="35" value="<?php echo ($Xpoint); ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="title">百度Y坐标：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt required" id="y" name="baidu_map_y" size="35" value="<?php echo ($Ypoint); ?>" />
                                </div>
                            </li>
                            <li class="push">
                                <div class="item_cont">
                                    <input type="submit" class="submit" value="提&nbsp;交" />
                                    <input type="reset" class="reset" value="重&nbsp;置" />
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
</body>
</html>