<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <style>
	.z_tips{
	    padding:40px 0 40px 0;
	    color:#666;
	    font-size:18px;
	    text-align:center;
	    line-height:1em;
	    border:1px solid #e5e5e5;
	    background-color:#fbfbfb;
		margin:20px 20px  auto;
	}
	.z_tips p{font-size:14px;}
	.z_tips span{
	    display:inline-block;
	    *zoom:1;
	    *display:inline;
	    font-size:18px;
	    padding-left:43px;
	    padding:7px 0 10px 43px;
	}
	.z_tips p span{
	    font-size:16px;
	    padding:0 5px;
	}
	.z_tips .false{
	    background:url(../image/icon.gif) -103px -133px no-repeat;
	}
	.z_tips .true{
	    background:url(../image/icon.gif) -103px -172px no-repeat;
	}
	.z_tips .red{
	    font-family:microsoft Yahei;
	    color:#f00;
	}
	.z_tips .blue{
	    color:#1f7ac4;
	}
	.z_tips .detail{
		padding:15px;
	}
	</style>
</head>
<body>
<div class="z_tips ">
<?php if(isset($message)): ?><span class="true red"><?php echo ($message); ?></span>
<?php else: ?>
        <span class="false red">操作失败 : <?php echo($error); ?> <?php echo($message); ?></span><?php endif; ?>
<p class="detail"></p>
<p>将在<span class="red" id="wait"><?php echo($waitSecond); ?></span>秒钟后自动跳转页面 如果不想等待请点击  <a id="href" href="<?php echo($jumpUrl); ?>">这里</a> 返回</p>
    </div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>