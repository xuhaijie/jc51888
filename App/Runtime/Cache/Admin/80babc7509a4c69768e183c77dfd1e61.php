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
		$("#form1").submit(function (){
			if($("#name").val() == ''){
				alert('请填写分类名称');
				$("#name").focus();
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
                    <a href="javascript:;"><?php echo ($column); ?></a>&gt;<a href="javascript:;"><?php echo ($title); ?></a>
                </div>
            </div>
            <div class="content">
                <div class="formMod">
                    <div class="tit"><?php echo ($title); ?></div>
                    <form action="" method="post" id="form1" enctype="multipart/form-data">
                        <ul>
                            <li>
                                <label for="parent">父级分类：</label>
                                <div class="item_cont">
                                	<select id="parent" name="parent" onchange="" ondblclick="" class="txt" ><?php  foreach($parent as $key=>$val) { if(!empty($sele) && ($sele == $key || in_array($key,$sele))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
                                </div>
                            </li>
                            <li>
                                <label for="name">分类名称：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt" id="name" name="name" size="35" value="<?php echo ($info["name"]); ?>" />
                                    <?php if(!$_GET[id]): ?><input type="checkbox" name='m' value="1" title="开启批量增加!各分类用,分开!" style="margin-left:5px;" /><?php endif; ?>
                                </div>
                            </li>
                            
                            <li>
                                <label >分类图片：</label>
                                <div class="item_cont">
                                    <input type="file" id="img" name="img" size="35" class="txt"/>
                                    <?php if($info["img"] != ""): ?><img src="__ROOT__/__UPLOAD__/in_<?php echo ($info["img"]); ?>" style="width: 65px;"><input type="button" value="删除图片" data-img="<?php echo ($info["img"]); ?>" id="del-img"><?php endif; ?>
                                    <span>(img)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>

                            <li>
                                <label for="order">排序：</label>
                                <div class="item_cont">
                                    <input type="number" id="order" name="order"  min="0" max="255" step="1" value="<?php if($info["order"] != ''): echo ($info["order"]); else: ?>255<?php endif; ?>" class="txt"/>                                    
                                </div>
                            </li>

                            <li>
                                <label for="aid">对应ID：</label>
                                <div class="item_cont">
                                    <input type="text" name="aid" class="txt" value="<?php echo ($info["aid"]); ?>" title="自助ID或者单页ID" />                                   
                                </div>
                            </li>

                            <li>
                                <label for="tid">其他用途：</label>
                                <div class="item_cont">
                                    <input type="text" name="sur" class="txt" value="<?php echo ($info["sur"]); ?>" title="分类ID 多个用,隔开" />
                                </div>
                            </li>

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