<?php 
include('inc/public.inc.php');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0'/> 
<meta http-equiv='cleartype' content='on'>
<meta name='format-detection' content='telephone=no'>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
</head>
<script type="text/javascript" src="js/iscroll.js"></script>

<script type="text/javascript">
var myScroll;

function loaded() {
	myScroll = new iScroll('wrapper', {
		snap: true,
		momentum: false,
		hScrollbar: false,
		onScrollEnd: function () {
			document.querySelector('#indicator > li.active').className = '';
			document.querySelector('#indicator > li:nth-child(' + (this.currPageX+1) + ')').className = 'active';
		}
	 });
}

document.addEventListener('DOMContentLoaded', loaded, false);
</script>

<style type="text/css" media="all">
body{
	width:100%;
	margin:0;
	padding:0;
}
#wrapper {
	width:300px;
	margin:0 auto;
	z-index:1;			/* it seems that recent webkit is less picky and works anyway. */
	overflow:hidden;
	-webkit-border-radius:10px;
	-moz-border-radius:10px;
	-o-border-radius:10px;
	border-radius:10px;
}

#scroller {
	width:600px;
	height:100%;
	float:left;
	margin-bottom:8px;
}

#scroller ul {
	list-style:none;
	width:100%;
	height:100%;
	padding:0;
}

#scroller li {
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	-o-box-sizing:border-box;
	box-sizing:border-box;
	display:block;
	float:left;
	width:300px; 
	height:160px;
}

#nav{
	width:100%;
	margin:5px auto;
	text-align:center;
}
 #indicator{
	padding-top:5px;
	width:100%;
	margin-left:33%;
 }
 #indicator li {
	float:left;
	list-style:none;
	text-indent:-9999em;
	width:8px; 
	height:8px;	
	background:#FFF;
	overflow:hidden;
	margin-right:4px;
}
#indicator > li.active {
	background:#888;
}
#indicator > li:last-child {
	margin:0;
}

</style>
</head>
<body>
<div id="wrapper">
	<div id="scroller">
		<ul id="thelist">
			<?php 
				$sql="SELECT * FROM `#@__flash` LIMIT 2";
				$db->Query('banner',$sql);
				while($row=$db->GetArray("banner")) {
			?>
			<li><div style='background:url(./uploads/<?php echo $row['img']?>) center no-repeat;background-size: cover;height:100%;'></div>
</li>
			<?php
				}
			 ?>
		</ul>
	</div>
	<div id="nav">
		<ul id="indicator">
			<li class="active">1</li>
			<li>2</li>
		</ul>
	</div>
</div>
</body>
</html>