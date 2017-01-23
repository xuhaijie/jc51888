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
<link rel="stylesheet" type="text/css" href="../Public/js/dataTables/demo_page.css" />
<link rel="stylesheet" type="text/css" href="../Public/js/dataTables/jquery.dataTables.css" />
<script type="text/javascript" src="../Public/js/dataTables/jquery.dataTables.min.js"></script>
<body class="main">
  <div class="subTit">
               
<div class="query">
</div>
    	
                <div class="tit">
                    <a href="javascript:;">产品</a>&gt;<a href="javascript:;">查看订单</a>
                </div>
            </div>
              <div class="content">
                <div class="tableMod">
                    <div class="tit"><a href="javascript:;" onclick="batch_del(this, 'Order')"><i class="icon icon_del"></i>删除选中项</a>
                    <a style="color: red;" onclick="javascript:void(0)">点击订单状态可修改相应订单的状态</a>
                    </div>
                    <table id="example" class="table-css1">
                        <thead>
                            <tr>
                                <th width="6%"><input type="checkbox" value="" id="check_box" onclick="selectall('id[]');"></th>
                                <th>ID</th>
                                <th>联系人</th>
                                <th>电话</th>
                                <th>地址</th>
                                <th>产品名称</th>
								<th>电子邮箱</th>
                                <th>订购时间</th>
                                <th>备注</th>
                                <th>已收款</th>
                                <th>订单状态</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td align="center"><input class="checkbox-1" type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id[]"></td>
                                <td align="center"><span class="col_ccc"><?php echo ($vo["id"]); ?></span></td>
								<td align="center"><?php echo ($vo["name"]); ?></td>
                                <td align="center"><?php echo ($vo["tel"]); ?></td>
                                <td><a href="__GROUP__/Order/moreaddr/id/<?php echo ($vo["id"]); ?>" class="mesmore"><?php echo ($vo["add"]); ?></a></td>
                                <td align="left" style="width: 200px;">
                                <?php if(is_array($vo["info"]["ddxx"])): $i = 0; $__LIST__ = $vo["info"]["ddxx"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><p>产品ID:<span style="color: red;"><?php echo ($vo1["id"]); ?></span><p>
                                <p>产品名:<span style="color: red;"><?php echo ($vo1["name"]); ?></span>&nbsp;&nbsp;数量:<span style="color: red;"><?php echo ($vo1["count"]); ?></span><p>
                                <p>单价:<span style="color: red;"><?php echo ($vo1["price"]); ?></span>
                                </p><br><?php endforeach; endif; else: echo "$empty" ;endif; ?><span style="color: red;"></span>&nbsp;&nbsp;总金额:<span style="color: red;font-size: 18px;"><?php echo ($vo["info"]["price"]); ?></span>元
                                </td>
                                <td align="center"><span class="col_ccc"><?php echo ($vo["email"]); ?></span></td>
                                <td align="center"><span class="col_ccc"><?php echo ($vo["time"]); ?></span></td>
                                <td align="center"><span class="col_ccc"><?php echo ($vo["notes"]); ?></span></td>
                                
                                <td align="center">
                                	<span class="col_ccc">
		                                <?php if($vo["paid"] == '1'): ?><font color="red">已收款</font>
		                                <?php else: ?>
											未收款<?php endif; ?>
	                                </span>
                                </td>
                                <td align="center"><span class="col_ccc">
	                                <a href="__GROUP__/Order/more/id/<?php echo ($vo["id"]); ?>" class="mesmore">
		                                <?php if($vo["type"] == ''): ?>收到订单
		                                <?php else: ?>
		                                    <?php echo ($vo["type"]); endif; ?>
		                            </a>
                                </td>
								<td align="center" class="op">
								<!-- <a href="javascript:;" onclick="compelet(this,'Order',<?php echo ($vo["id"]); ?>)";>完成</a>  -->
	                                <a href="javascript:;" onclick="del(this,'Order',<?php echo ($vo["id"]); ?>)";><i class="icon icon_x"></i>删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                    <div class="page"><?php echo ($page); ?></div>
                </div>
                <!-- End tableMod -->       
	</div>
	<script type="text/javascript">
                    $(function() {
                    	$(".mesmore").fancybox();
                    });
    </script>
</body>
</html>