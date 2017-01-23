<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<style type="text/css">
		body {
			background: url("../Public/images/error_bg.jpg") repeat-x scroll 0 0 #67ACE4;
		}
		#container {
			margin: 0 auto;
			padding-top: 50px;
			text-align: center;
			width: 560px;
		}
		#container img {
			border: medium none;
			margin-bottom: 50px;
		}
		#container .error {
			height: 200px;
			position: relative;
		}
		#container .error img {
			bottom: -50px;
			position: absolute;
			right: -50px;
		}
		#container .msg {
			margin-bottom: 65px;
		}
		#cloud {
			background: url("../Public/images/error_cloud.png") repeat-x scroll 0 0 transparent;
			bottom: 0;
			height: 170px;
			position: absolute;
			width: 100%;
		}
		.ppp{text-align: center;margin: 0 auto;}
	</style>
<body>

<div id="container">
	<img class="png" src="../Public/images/404.png"/>
	<img class="png msg" src="../Public/images/404_msg.png" />
	<p><a href="index"><img class="png" src="../Public/images/404_to_index.png" onclick="goBack();"/></a> </p>
</div>

<div id="cloud" class="png"></div>
<p class="ppp">
	<b id="second1">5</b>秒后回到主页
</p>

</body>
</html>


<script language="JavaScript">
	var sec = document.getElementById("second1");
	var i = 5;
	var timer = setInterval(function(){
		i--;
		sec.innerHTML = i;
		if(i==1){
			window.location.href="index"
		}
	},1000)

	function goBack(){
		window.location.href="index"
	}
</script>