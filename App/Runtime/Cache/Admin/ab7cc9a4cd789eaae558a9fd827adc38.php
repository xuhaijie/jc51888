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
              <div class="content">
                <div class="tableMod">
                    <div class="tit">
                        <a href="__GROUP__/Flash/add"><i class="icon icon_add"></i>添加轮换图片</a>
                        <a href="javascript:;" onclick="batch_del(this, 'Flash')"><i class="icon icon_del"></i>删除选中项</a>
                    </div>
                    <table id="example">
                        <thead>
                            <tr>
                                <th width="6%"><input type="checkbox" value="" id="check_box" onclick="selectall('id[]');"></th>
                                <th width="30%">标题</th>
                                <th>图片</th>
                                <th>链接</th>
                                <th>排序</th>
                                <th>开关</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td align="center"><input  class="checkbox-1" type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id[]"></td>
                                <td align="center"><span class="col_ccc"><?php echo ($vo["title"]); ?></span></td>
                                <td><a href="__GROUP__/Flash/edit/id/<?php echo ($vo["id"]); ?>"><img src="__ROOT__/<?php echo C('UPLOAD_DIR'); echo ($vo["img"]); ?>" height="50" /></a></td>
                                <td align="center"><?php echo ($vo["link"]); ?></td>
                                <td align="center"  class="order"><span data-zid="<?php echo ($vo["id"]); ?>"><?php echo ($vo["order"]); ?></span></td>
                                <td align="center"><input type="checkbox" name="open" value="<?php echo ($vo["id"]); ?>" <?php if($vo["open"] == 1): ?>checked<?php endif; ?> ></td>
                                <td align="center" class="op">
                                    <a href="__GROUP__/Flash/edit/id/<?php echo ($vo["id"]); ?>"  target="main"><i class="icon icon_edit"></i>修改</a>
                                    <a href="javascript:;" onclick="del(this,'Flash',<?php echo ($vo["id"]); ?>)";><i class="icon icon_x"></i>删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- End tableMod -->       
    </div>
    <script type="text/javascript">
    $(function() {
        $("#example").find('tbody').on('change','input[type="checkbox"]',function(){
            var $this=$(this),data={};
            // alert($this.val());
            data['id']=$this.val();

            if($this.attr('checked')){
                data['open']=1;
            }else{
                data['open']=0;
            }
            $.ajax({
                type: "POST",
                url: '__GROUP__/flash/ajax_flash',
                data: data
            })
        })
        
    });
    </script>
</body>
</html>