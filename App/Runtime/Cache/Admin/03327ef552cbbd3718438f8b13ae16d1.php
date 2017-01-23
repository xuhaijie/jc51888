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
				if($("#job").val() == ''){
					alert('请填写岗位名称');
					$("#job").focus();
					return false;
				}
				if($("#request").val() == ''){
					alert('请填写招聘内容');
					$("#request").focus();
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
                    <a href="javascript:;">招聘</a>&gt;<a href="javascript:;"><?php echo ($title_type); ?>招聘</a>
                </div>
            </div>
            <div class="content">
                <div class="formMod">
                    <div class="tit"><?php echo ($title_type); ?>招聘</div>
                    <form action="" method="post" id="form1" enctype="multipart/form-data">
                        <ul>
                            <li>
                            	<?php if($info["pid"] != 0 or $single != 1): ?><label for="newsSort">招聘类别：</label>
                                <div class="item_cont">
                                    <select id="pid" name="pid" onchange="" ondblclick="" class="txt" ><?php  foreach($category as $key=>$val) { if(!empty($selected) && ($selected == $key || in_array($key,$selected))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
                                </div>
                                <?php else: ?>
                                	<input type="hidden" id="category" name="category" value="0" /><?php endif; ?>
                            </li>
                            <li>
                                <label for="newsId">岗位名称：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt" id="job" name="job" size="35" value="<?php echo ($info["job"]); ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="newsId">人数：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt" id="num" name="num" size="35" value="<?php echo ($info["num"]); ?>"/>
                                </div>
                            </li>
                            <li>
                                <label for="keywords">结束日期：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt" id='end_time' name="end_time" size="35" value="<?php echo ($info["end_time"]); ?>" onClick="WdatePicker()" />
                                </div>
                            </li>
                            <li>
                                <label for="salary">工资待遇：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt" id="salary" name="salary" size="35" value="<?php echo ($info["salary"]); ?>"/>
                                </div>
                            </li>
                            <li>
                                <label for="newsCont">招聘内容：</label>
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