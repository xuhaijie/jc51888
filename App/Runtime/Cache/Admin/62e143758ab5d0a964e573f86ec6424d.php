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
<script>
	$(function(){
		$("#form1").submit(function (){
			if($("#title").val() == ''){
				alert('请填写标题');
				$("#title").focus();
				return false;
			}
			<?php if($info["id"] == ''): ?>if($("#img").attr('value') == ''){
				alert('请添加图片');
				$("#img").focus();
				return false;
			}<?php endif; ?>
		})
	
	})
</script>
<body class="main">
            <div class="content">
                <div class="formMod">
                    <div class="tit"><?php echo ($title_type); ?>轮换图片</div>
                    <form action="" method="post" enctype="multipart/form-data" id="form1">
                        <ul>
                            <li>
                                <label for="newsSort">标题：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt" id="title" name="title" size="35" value="<?php echo ($info["title"]); ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="newsSort">链接：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt" id="link" name="link" size="88" value="<?php echo ($info["link"]); ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="newsSort">图片：</label>
                                <div class="item_cont">
                                    <input type="file" class="txt" id="img" name="img" size="35" value="<?php echo ($info["img"]); ?>"  />
									<?php if($info["img"] != ""): ?><a href="__ROOT__/<?php echo C('UPLOAD_DIR'); echo ($info["img"]); ?>" target="_black">查看</a><?php endif; ?>
                                </div>
                            </li>
                            <li>
                                <label for="newsSort">排序：</label>
                                <div class="item_cont">
                                    <input type="number" id="order" name="order"  min="0" max="255" step="1" value="<?php if($info["order"] != ''): echo ($info["order"]); else: ?>255<?php endif; ?>" class="txt"/>
                                </div>
                            </li>
                            <li>
                                <label for="newsSort">开关：</label>
                                <div class="item_cont">
                                	<label><input type="radio" name="open" value="1" <?php if($info["open"] == 1): ?>checked<?php endif; ?> > 开启</label>
                                	<label><input type="radio" name="open" value="0" <?php if($info["open"] == 0): ?>checked<?php endif; ?> > 关闭</label>
                                </div>
                            </li>
                            <li class="push">
                                <div class="item_cont">
                                 <?php if($info["id"] != ''): ?><input type="hidden" id="id" name="id" value="<?php echo ($info["id"]); ?>" /><?php endif; ?>
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