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
var id="<?php echo ($info['id']?$info['id']:''); ?>" || 0;//获取id		
	$(function(){
		$("#form1").submit(function (){
			if($('#pid').val() == 1){
				alert('请选择文章分类');
				$("#pid").focus();
				return false;
			}
			if($("#title").val() == ''){
				alert('请填写文章标题');
				$("#title").focus();
				return false;
			}				
		});
	});
</script>
<body>
 	<div class="subTit">
        
<div class="query">
</div>
    	
        <div class="tit">
            <a href="javascript:;">文章</a>&gt;<a href="javascript:;"><?php echo ($title_type); ?>文章</a>
        </div>
    </div>
    <div class="content">
        <div class="formMod">
            <div class="tit"><?php echo ($title_type); ?>文章</div>
            <form name="form1" id="form1" enctype="multipart/form-data" method="post" action="">
                <ul>
                    <li>
                        <label>文章ID:</label>
                        <div class="item_cont">
                            <input type="text" readonly class="txt" name="id" style="" value="<?php echo ($info["id"]); ?>" />
                            <?php if(strpos($info['id'],",")){ ?>
                                空白:<input type="checkbox" value="1" id="pdid" name="pdid" title="所见即所得"/>
                            <?php }?>
                        </div>
                        <div class="clear2"></div>
                    </li>
                    <li>
                        <?php if($info["pid"] != 0 or $single != 1): ?><label>文章类别：</label>
                        <div class="item_cont">
                             <select name="pid" id="pid">
                                <?php if(strpos($info['id'],",")){ ?>
                                    <option value="" "selected"}>------选择分类------</option>
                                    <?php if(is_array($category)): foreach($category as $key=>$vo): ?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                                <?php }else{ ?>
                                    <?php if(is_array($category)): foreach($category as $key=>$vo): ?><option value="<?php echo ($key); ?>" <?php echo ($key==$selected?"selected":''); ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                                <?php }?>
                            </select>
                            <span>(pid)</span>
                        </div>
                        <?php else: ?>
                            <input type="hidden" id="category" name="category" value="0" /><?php endif; ?>
                        <div class="clear2"></div>
                    </li>
                    <li>
                        <label>文章标题：</label>
                        <div class="item_cont">
                            <input type="text" class="txt required" id="title" name="title" style="width:637px;" value="<?php echo ($info["title"]); ?>" />
                            <span>(title)</span>
                        </div>
                        <div class="clear2"></div>
                    </li>
                    <?php if(!strpos($info['id'],",")){ ?>
                    <li>
                        <label>文章图片：</label>
                        <div class="item_cont">
                            <input type="file" class="txt" id="img" name="img" size="35"/>
                            <?php if($info["img"] != ""): ?><img src="__ROOT__/__UPLOAD__/in_<?php echo ($info["img"]); ?>" style="width: 65px;"><input type="button" value="删除图片" data-img="<?php echo ($info["img"]); ?>" id="del-img"><?php endif; ?>
                            <span>(img)</span>
                        </div>
                        <div class="clear2"></div>
                    </li>
                    <?php }?>
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
                            <input type="text" class="txt" id='www' name="www" style="width:637px;" value="<?php echo ($info["www"]); ?>" />
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
                        <label>文章内容：</label>
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
                            <input type="number" id="order" name="order"  min="0" step="1" value="<?php if($info["order"] != ''): echo ($info["order"]); else: ?>255<?php endif; ?>" class="txt"/>
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
        </div><!-- /.formMod -->
    </div><!-- /.content -->
</body>
<script type="text/javascript">
$(function(){
    var $del_img=$("#del-img") || false;
    if($del_img){
        $del_img.click(function(){
            var $this=$(this);
            if(confirm('是否删除')){
                $.ajax({
                    type: "POST",
                    url: "__GROUP__/Article/ajax_article_del",
                    data: {'id':id,'img':$this.data("img")}
                }).done(function( msg ) {
                    if(msg['code']){
                        $this.parent().find('img').remove();
                        $this.remove();
                    }else{
                        alert(msg['data']['name']);
                    }
                });
            }
        });
    }
})
    
</script>
</html>