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
<script type="text/javascript" src="../Public/js/fancybox/jquery.fancybox-1.3.4.js"></script>
<link rel="stylesheet" type="text/css" href="../Public/js/fancybox/jquery.fancybox-1.3.4.css" />
<script>
$(document).ready(function (){
	$(".mesmore").fancybox();

})
</script>
<body class="main">
  <div class="subTit">
                <div class="tit">
                    <a href="javascript:;">留言</a>&gt;<a href="javascript:;">留言列表</a>
                </div>
            </div>
              <div class="content">
                <div class="tableMod">
                    <div class="tit">
                        <a href="javascript:;" onclick="batch_del(this, 'Message')"><i class="icon icon_del"></i>删除选中项</a>  
                    </div>
                     <div class="tit"> <a style="color: red;" onclick="javascript:void(0)">点击用户名称，可对用户留言进行编辑、回复。</a></div>
                    <table id="example">
                        <thead>
                            <tr>
                                <th><input type="checkbox" value="" id="check_box" onclick="selectall('id[]');"></th>
                                <th>ID</th>
                                <th>姓名</th>
                                <th>电话</th>
                                <th>地址</th>
                                <th>电子邮箱</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td align="center"><input class="checkbox-1" type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id[]"></td>
                                <td align="center"><span class="col_ccc"><?php echo ($vo["id"]); ?></span></td>
                                <td align="center"><a href="__GROUP__/Message/more/id/<?php echo ($vo["id"]); ?>" class="mesmore"><?php echo ($vo["name"]); ?></a></td>
                                <td><?php echo ($vo["tel"]); ?></td>
                                <td align="center"><?php echo ($vo["add"]); ?></td>
                                <td align="center"><span class="col_ccc">  <?php echo ($vo["email"]); ?></span></td>
                                <td align="center" class="op">
                                	<!--<a href="__GROUP__/Message/edit/id/<?php echo ($vo["id"]); ?>"><i class="icon icon_edit"></i>查看</a> -->
                                	
                                	<?php if($vo['is_show'] == '1' ): ?><a href="javascript:;" onClick="quit_show(this,'Message',<?php echo ($vo["id"]); ?>);"><i class="icon icon_x"></i>取消显示</a>
                                	<?php else: ?>
                                	<a href="javascript:;" onClick="add_show(this,'Message',<?php echo ($vo["id"]); ?>);"><i class="icon icon_y"></i>首页显示</a><?php endif; ?>  
                                	                       	
                                    <a href="javascript:;" onClick="del(this,'Message',<?php echo ($vo["id"]); ?>);"><i class="icon icon_x"></i>删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                        </tbody>
                    </table>
                    <div class="page"><?php echo ($page); ?></div>
                </div>
                <!-- End tableMod -->       
	</div>
</body>
</html>