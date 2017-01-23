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
<body class="main">
 	<div class="subTit">
      <div class="tit">
          <a href="javascript:;">系统</a>&gt;<a href="javascript:;">系统设置</a>
      </div>
      </div>
      <div class="content">
          <div class="formMod">
              <div class="tit"><a href="__GROUP__/System/Index/t/1" <?php if($group == '1'): ?>class="current"<?php endif; ?>>基础设置 </a><a href="__GROUP__/System/Index/t/4" <?php if($group == '4'): ?>class="current"<?php endif; ?>>高级设置</a><a href="__GROUP__/System/Index/t/3">地图设置</a></div>
              <form action="" method="post"  enctype="multipart/form-data">
                  <ul>
                   <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                           <label for="name"><?php echo ($vo["name"]); ?>：</label>
                           <div class="item_cont" style="display: table;">
                           	<?php echo ($vo["input"]); ?>
                           </div>
                           <span class="remark"><?php echo ($vo["remark"]); ?></span>
                       </li><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                   <li class="push">
                       <div class="item_cont">
                       <?php if($info["id"] != ''): ?><input type="hidden" id="id" name="id" value="<?php echo ($info["id"]); ?>" />
                       	<input type="hidden" id="type" name="type" value="<?php echo ($info["type"]); ?>" /><?php endif; ?>
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