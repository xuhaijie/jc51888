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
<script type="text/javascript">
		$(function(){
			//表单验证
			$("#form1").submit(function (){
				if($("#title").val() == ''){
					alert('请填写单页标题');
					$("#title").focus();
					return false;
				}	
			})
		})
		
</script>
<body class="main">
 	<div class="subTit">
               
<div class="query">
</div>
    	
                <div class="tit">
                    <a href="javascript:;">单页</a>&gt;<a href="javascript:;"><?php echo ($title_type); ?>单页</a>
                </div>
            </div>
            <div class="content">
                <div class="formMod">
                    <div class="tit"><?php echo ($title_type); ?>单页</div>
                    <form name="form1" id="form1" enctype="multipart/form-data" method="post" action="">
                        <ul>
                            <li>
                                <label>单页标题：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt" id="title" name="title" style="width:637px;" value="<?php echo ($info["title"]); ?>" <?php if($info["system"] == '1'): ?>readonly<?php endif; ?> />
                                    <span>(title)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>
                            <li>
                                <label>图片：</label>
                                <div class="item_cont">
                                    <input type="file" class="txt" id="img" name="img" size="35"/>
                                     <?php if($info["img"] != ""): ?><a href="__ROOT__/<?php echo C('UPLOAD_DIR'); echo ($info["img"]); ?>" target="_black">查看图片</a><?php endif; ?>
                                     <span>(img)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>
                            <li>
                                <label>关键字：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt" id='keywords' name="keywords" style="width:637px;" value="<?php echo ($info["keywords"]); ?>" />
                                    <span>(keywords)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>
                            <li>
                                <label>载入页面：</label>
                                <div class="item_cont">
                                    <input type="text" name="www" class="txt" value="<?php echo ($info["www"]); ?>" style="width:637px;" title="单页载入的页面放入Custom目录下" />
                                    <span>(www)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>

                            <li>
                                <label>简介：</label>
                                <div class="item_cont">
                                    <textarea name="description" id="description" style="width:637px;" rows="10" class="txt"  ><?php echo ($info["description"]); ?></textarea>
                                    <span>(description)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>
                            <li>
                                <label>单页内容：</label>
                                <div class="item_cont">
                                     
<script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.parse.js"></script>
<script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.all.min.js"></script>
<style type="text/css">
    #content{width: 60%;min-height:300px;}
</style>
<script type="text/javascript">
;$(function(){
	var ue = UE.getEditor('content');
});
</script>
<script type="text/plain" id="content" name="content">
  <?php echo ($info["content"]); ?>
</script>

                                     <span>(content)</span>
                                </div>
                                 
                                 <div class="clear2"></div>
                            </li>
                             <li>
                                <label>排序：</label>
                                <div class="item_cont">
                                    <input type="number" id="order" name="order"  min="0" max="255" step="1" value="<?php if($info["order"] != ''): echo ($info["order"]); else: ?>255<?php endif; ?>" class="txt"/>
                                    <span>(order)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>
                            <li class="push">
                                <div class="item_cont">
                                 <?php if($info["id"] != ''): ?><input type="hidden" id="id" name="id" value="<?php echo ($info["id"]); ?>" />
                                 	<input type="hidden" id="img" name="img" value="<?php echo ($info["img"]); ?>" />
                                 	<input type="hidden" id="time" name="time" value="<?php echo ($info["time"]); ?>" />
                                 	<input type="hidden" id="click" name="click" value="<?php echo ($info["click"]); ?>" /><?php endif; ?>
                                    <input type="submit" class="submit" value="提&nbsp;交" />
                                    <input type="reset" class="reset" value="重&nbsp;置" />
                                </div>
                                <div class="clear2"></div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
</body>
</html>