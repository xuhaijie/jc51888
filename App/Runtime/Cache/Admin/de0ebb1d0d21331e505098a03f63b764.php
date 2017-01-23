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
<body class="main">
  <div class="subTit">
                
<div class="query">
</div>
    	
                <div class="tit">
                    <a href="javascript:;">招聘</a>&gt;<a href="javascript:;">招聘列表</a>
                </div>
            </div>
              <div class="content">
                <div class="tableMod">
                    <div class="tit">
                        <a href="__GROUP__/Category/jobs"><i class="icon icon_txt"></i>管理分类</a>
                        <a href="__GROUP__/Jobs/add"><i class="icon icon_add"></i>添加招聘</a>
                        <a href="javascript:;" onclick="batch_del(this, 'Jobs')"><i class="icon icon_del"></i>删除选中项</a>
                    </div>
                    <table id="example">
                        <thead>
                            <tr>
                                <th><input type="checkbox" value="" id="check_box" onclick="selectall('id[]');"></th>
                                <th>ID</th>
                                <th>招聘类别</th>
                                <th>招聘岗位</th>
                                <th>人数</th>
                                <th>结束日期</th>
                                <th>工资待遇</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td align="center"><input class="checkbox-1" type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id[]"></td>
                                <td align="center"><span class="col_ccc"><?php echo ($vo["id"]); ?></span></td>
                                <td align="center"><?php echo ($vo["cate_name"]); ?></td>
                                <td><a href="__ROOT__/jobs/<?php echo ($vo["id"]); ?>"  target="_blank"><?php echo ($vo["job"]); ?></a></td>
                                <td align="center"><?php echo ($vo["num"]); ?></td>
                                <td align="center"><?php echo ($vo["end_time"]); ?></td>
                                <td align="center"><span class="col_ccc"><?php echo ($vo["salary"]); ?></span></td>
                                <td align="center" class="op">
                                	<a href="__GROUP__/Jobs/edit/id/<?php echo ($vo["id"]); ?>"><i class="icon icon_edit"></i>修改</a>
                                    <a href="javascript:;" onclick="del(this,'Jobs',<?php echo ($vo["id"]); ?>)";><i class="icon icon_x"></i>删除</a>
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