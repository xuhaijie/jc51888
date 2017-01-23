<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
<script type="text/javascript" src="../Public/Js/fancybox/jquery.fancybox-1.3.4.js"></script>
<link rel="stylesheet" type="text/css" href="../Public/Js/fancybox/jquery.fancybox-1.3.4.css" />
<script src="http://cdn.bootcss.com/socket.io/1.3.7/socket.io.js"></script>
<style type="text/css"> 
.text{padding: 10px 50px;font-family: 微软雅黑;text-align: left;}  
.btn{ margin-right: 10px; font-size: 14px; font-weight: bold; color: #333; width: 79px; height: 31px; border: 0 none; background: url(../Public/Image/icon.gif) -60px -60px no-repeat; }
.btn:hover{ color: #1f7ac4; background-position: -60px -100px; } 
.mt15{ margin-top: 15px;}
.link{ text-decoration: underline;color: #1f7ac4;}
.cor{ color: #1f7ac4;}
.user-item{position: relative; width: 640px;margin: 20px auto;padding: 15px 0; border: 1px solid #eee;}
.user-item .unlink{position: absolute;top:15px;right:20px;}
.user-item .unlink{background: url(../Public/Image/unlink.gif) left bottom no-repeat;width: 86px;height: 31px;border: 0;padding-left: 20px;}
.user-item .unlink:hover{color: #1f7ac4;background: url(../Public/Image/unlink.gif) left top no-repeat;}
.user-item img{ width: 76px;border-radius: 38px;border: 1px solid #ddd;}
.user-item dl{overflow: hidden;zoom: 1;}
.user-item dt,.user-item dd{float: left;}
.user-item dt{width: 100px; text-align: right;padding-right: 5px;}
.user-item dd{ text-align: left;padding-left: 5px;}
</style>
<body class="main">
<div class="subTit">
    <div class="tit">
        <a href="javascript:;">留言</a>&gt;<a href="javascript:;">微信互联</a>
    </div>
</div>
<div class="content">
    <div style="background:#fff;padding: 20px;border: 1px solid #e5e5e5;text-align: center;line-height: 25px;font-size: 14px;color:#555;">
        <?php if(($_GET['step']) == "1"): ?><div id="step1">
            <p class="text">在移动互联网快速发展、腾讯微信广范普及的今天，传统的PC式网络营销也发生了巨大的变化，也包括营销型网站的营销型标准。智美云正式升级“<span class="cor">微信互联</span>”功能，在网站后台开启“微信互联”功能后，网站一旦有访客留言信息，<span class="cor">智美云系统自动将留言信息直接发送到企业老板的微信中</span>。开启”微信互联“将进一步提升营销型网站的行动力。</p>
            <p><img src="__GROUP__/Message/qrcode/" width="200" height="200" /></p>
            <p style="color:#1f7ac4;font-weight:bold;">微信扫描此二维码，开启微信互联功能，让您可以在微信中收取您网站上的留言信息</p>
            <p>绑定成功后如果页面没有自动跳转，请点击完成按钮</p>
            <p><input type="button" class="btn mt15" onclick="getWxUser()" value="完成"></p>
        </div>
        <?php else: ?>
        <div>
            <p>您当前网站已经成功开启微信互联功能，每个站点最多绑定三个微信，点击 <a href="__GROUP__/Message/weixin/step/1" class="link">继续绑定</a></p>
            <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="user-item">
                <dl>
                    <dt><img src="<?php echo (($vo["headimgurl"])?($vo["headimgurl"]):'http://mswx.myqingfeng.cn/images/pic.jpg'); ?>" /></dt>
                    <dd>
                        <p>昵称：<span class="cor"><?php echo ($vo["nickname"]); ?></span></p>
                        <p>性别：<?php switch($vo["sex"]): case "1": ?>男<?php break; case "2": ?>女<?php break; default: ?>未知<?php endswitch;?>
                        </p>
                        <p>城市：<?php echo ($vo["province"]); ?>/<?php echo ($vo["city"]); ?></p>
                    </dd>
                </dl>
                <input type="button" class="unlink mt15" onclick="window.location.href='__GROUP__/Message/unlink/id/<?php echo ($vo["openid"]); ?>'" value="取消绑定">
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div><?php endif; ?>
    </div>
</div>
</body>
<script type="text/javascript">
// 连接服务端
var socket = io('http://116.255.221.18:2120');
// 连接后登录
socket.on('connect', function(){
    socket.emit('login', 'wxscan_<?php echo ($wx_code); ?>');
});
// 后端推送来消息时
socket.on('response', function(msg){
    if (msg == 'ok1') {
        getWxUser();
    }    
});
function getWxUser () {
    $.get('__GROUP__/message/wxuser', function(data) {
        if (data == 'ok') {
            window.location.href = '__GROUP__/Message/weixin';
        } else{
            alert(data);
        };
    });
}
</script>
</html>