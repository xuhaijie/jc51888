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
<script>
function dlgroup(id,e){
	//发送请求
	$.getJSON("__APP__"+"/Admin/User/ajax/t/delgroup/id/"+id, function(data){
			if(data.status == '1')
			{	
				$(e).parent().parent('tr').hide('slow');
			}else{
				alert('该组下账号不为空,删除失败.');
			}
	})
}	
</script>
<body class="main">
  <div class="subTit">
                <div class="tit">
                    <a href="javascript:;">用户组中心</a>
                </div>
            </div>
              <div class="content">
               <br>
               <a href="__APP__/admin/user/groupeditor">添加用户组</a>
                <div class="tableMod">
                    <table id="example">
                        <thead>
                            <tr>
                                <th width="6%"><input type="checkbox" value="" id="check_box" onClick="selectall('id[]');"></th>
                                <th width="5%">ID</th>
                                <th width="9%">用户组名</th>
                                <th width="10%">折扣</th>
                                <th width="10%">账号数</th>  
                                <th width="20%">用户组介绍</th>     
                                <th width="14%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($ugoups)): $i = 0; $__LIST__ = $ugoups;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td align="center"><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id[]"></td>
                                <td align="center"><?php echo ($vo["id"]); ?></td>
                                <td align="center"><?php echo ($vo["name"]); ?></td>
                                <td align="center"><?php echo ($vo["faver"]); ?>折</td>
                                <td align="center"><?php echo ($vo["num"]); ?></td>
                                <td align="center"><?php echo ($vo["description"]); ?></td>
                                <td align="center" class="op">
                                <a href="__APP__/admin/user/groupeditor/t/<?php echo ($vo["id"]); ?>"><i class="icon icon_edit"></i>修改</a>
                                <a onClick="dlgroup(<?php echo ($vo["id"]); ?>,this)" style="cursor: pointer;"><i class="icon icon_x"></i>删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                        </tbody>
                    </table>
                </div>
	</div>
<?php if($users != ''): ?><script type="text/javascript">
                    $(function() {
                    	$(".mesmore").fancybox();
                        $('#example').dataTable({
                        	"aoColumns": [
                        			    	{ "asSorting": [] ,"bSearchable": false},
                        			      null,
                        			      null,
                        			      null,
                        			      null,
                        			      null,
                        			      { "asSorting": [] ,"bSearchable": false}
                        			    ],
                            "bStateSave": true,
                            "bPaginate": true,
                            "iDisplayLength":100,
                            "aLengthMenu": [[100,200,300,500,1000,-1], [100,200,300,500,1000,"全部"]],
                            "sDom": '<"top"flip<"clear" and >>rt<"bottom"<"clear" and >><"clear">',
                            "sPaginationType": "full_numbers",
                            "oLanguage": {
                            "sLengthMenu": "每页显示 _MENU_ 条记录",
                            "sZeroRecords": "抱歉， 没有找到",
                            "sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
                            "sInfoEmpty": "没有数据",
                            "sInfoFiltered": "(从 _MAX_ 条数据中检索)",
                            "sSearch":"筛选(多个关键字用空格隔开):",
                            "oPaginate": {
                            "sFirst": "首页",
                            "sPrevious": "前一页",
                            "sNext": "后一页",
                            "sLast": "尾页"
                            },
                            "sZeroRecords": "没有检索到数据",
                            }
                        });
                    }());
                </script><?php endif; ?> 
</body>
</html>